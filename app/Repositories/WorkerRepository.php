<?php

namespace App\Repositories;

use App\Exceptions\ModelNotFoundException;
use App\Models\Worker;
use App\Models\WorkersExOrderType;
use Illuminate\Database\Eloquent\ModelNotFoundException as EloquentModelNotFoundException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class WorkerRepository implements IWorkerRepository
{
    public function filterByOrderType(array $orderTypeIds, int $start, int $limit): Collection
    {
        if (!$orderTypeIds) {
            return new Collection();
        }

        $uniqueOrderTypeIds = array_unique($orderTypeIds);
        return Worker::query()
            ->select('w.*')
            ->from('workers as w')
            ->leftJoin('workers_ex_order_types as ex', fn($join) => $join
                ->on('w.id', '=', 'ex.worker_id')
                ->whereIn('ex.order_type_id', $uniqueOrderTypeIds))
            ->groupBy('w.id')
            ->havingRaw('COUNT(ex.worker_id) < ?', [count($uniqueOrderTypeIds)])
            ->having('w.id', '>', $start)
            ->orderBy('w.id')
            ->limit($limit)
            ->get();
    }

    public function findOrFail(int $id): Worker
    {
        try {
            return Worker::findOrFail($id);
        } catch (EloquentModelNotFoundException $e) {
            throw new ModelNotFoundException('', 0, $e);
        }
    }

    public function hasExcludedType(int $workerId, int $orderTypeId): bool
    {
        return WorkersExOrderType::query()
            ->where(['order_type_id' => $orderTypeId, 'worker_id' => $workerId])
            ->exists();
    }

    public function exists($id): bool
    {
        return Worker::query()->where(['id' => $id])->exists();
    }
}

<?php

namespace App\Services;

use App\Models\Worker;
use Illuminate\Support\Facades\DB;

class WorkerService implements IWorkerService
{
    public function filterByOrderType(array $orderTypeIds)
    {
        if (!$orderTypeIds) {
            return [];
        }

        $uniqueOrderTypeIds = array_unique($orderTypeIds);
        return Worker::query()
            ->select('w.*', DB::raw('COUNT(ex.worker_id)'))
            ->from('workers as w')
            ->leftJoin('workers_ex_order_types as ex', fn($join) => $join
                ->on('w.id', '=', 'ex.worker_id')
                ->whereIn('ex.order_type_id', $uniqueOrderTypeIds))
            ->groupBy('w.id')
            ->havingRaw('COUNT(ex.worker_id) < ?', [count($uniqueOrderTypeIds)])
            ->get();
    }
}

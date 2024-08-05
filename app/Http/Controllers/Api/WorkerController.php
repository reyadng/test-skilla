<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FilterWorkersRequest;
use App\Repositories\IWorkerRepository;
use Illuminate\Support\Collection;

class WorkerController extends Controller
{
    private IWorkerRepository $workerRepository;

    public function __construct(IWorkerRepository $workerService)
    {
        $this->workerRepository = $workerService;
    }

    public function filterByOrderTypes(FilterWorkersRequest $request): Collection
    {
        $validated = $request->validated();
        $orderTypeIds = $validated['order_type_ids'];

        return $this->workerRepository->filterByOrderType($orderTypeIds);
    }
}

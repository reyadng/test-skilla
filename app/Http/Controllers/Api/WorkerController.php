<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FilterWorkersRequest;
use App\Services\IWorkerService;

class WorkerController extends Controller
{
    private IWorkerService $workerService;

    public function __construct(IWorkerService $workerService)
    {
        $this->workerService = $workerService;
    }

    public function filterByOrderTypes(FilterWorkersRequest $request)
    {
        $validated = $request->validated();
        $orderTypeIds = $validated['order_type_ids'];

        return $this->workerService->filterByOrderType($orderTypeIds);
    }
}

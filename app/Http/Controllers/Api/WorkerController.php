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

    public function filterByOrderTypes(FilterWorkersRequest $request)
    {
        $workers = $this->workerRepository->filterByOrderType(
            $request->input('order_type_ids'),
            $request->input('start', 0),
            $request->input('limit', 5),
        );

        return $this->response(200, $workers);
    }
}

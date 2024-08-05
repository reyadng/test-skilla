<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\OrderAlreadyAssignedToThisWorkerException;
use App\Exceptions\OrderDeclinedException;
use App\Exceptions\OrderNotFoundException;
use App\Exceptions\UserNotHavePartnershipException;
use App\Http\Controllers\Controller;
use App\Http\Requests\AssignWorkerRequest;
use App\Http\Requests\StoreOrderRequest;
use App\Repositories\IOrderRepository;
use App\Services\IOrderService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{

    public function __construct(
        private readonly IOrderService $orderService,
        private readonly IOrderRepository $orderRepository,
    ) {
    }

    public function store(StoreOrderRequest $request): JsonResponse
    {
        $validated = $request->validated();

        try {
            $order = $this->orderService->createOrder(
                auth()->id(),
                $validated['description'],
                $validated['amount'],
                Carbon::create($validated['date']),
                $validated['address'],

                $validated['type_id'],
            );

            return response()->json(['order' => $order], 201);
        } catch (UserNotHavePartnershipException) {
            return response()->json([
                'error' => [
                    'message' => 'User doesn\'t have a partnership',
                ],
            ], 422);
        }
    }

    public function assignWorker(AssignWorkerRequest $request, int $orderId)
    {
        if (!$this->orderRepository->exists($orderId)) {
            abort(404, 'Order not found');
        }

        $validated = $request->validated();

        try {
            $this->orderService->assignWorker(auth()->id(), $orderId, $validated['worker_id'], $validated['amount']);
            return response()->json();
        } catch (UserNotHavePartnershipException) {
            return response()->json([
                'error' => [
                    'message' => 'User doesn\'t have a partnership',
                ],
            ], 422);
        } catch (OrderDeclinedException) {
            abort(403, 'Worker doesn\'t accept orders having such type');
        } catch (OrderNotFoundException) {
            abort(404, 'Order not found');
        } catch (OrderAlreadyAssignedToThisWorkerException) {
            abort(403, 'Order is already assigned to this worker');
        }
    }
}

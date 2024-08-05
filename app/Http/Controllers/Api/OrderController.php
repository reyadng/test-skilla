<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\UserNotHavePartnership;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Services\IOrderService;

class OrderController extends Controller
{
    private IOrderService $orderService;

    public function __construct(IOrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        $validated = $request->validated();

        try {
            $order = $this->orderService->createOrder(
                auth()->id(),
                $validated['description'],
                $validated['amount'],
                $validated['date'],
                $validated['address'],

                $validated['type_id'],
            );

            return response()->json(['order' => $order], 201);
        } catch (UserNotHavePartnership) {
            return response()->json([
                'error' => [
                    'message' => 'User doesn\'t have a partnership',
                ],
            ], 422);
        }
    }
}

<?php

namespace App\Services;

use App\Enums\Status;
use App\Exceptions\ModelNotFoundException;
use App\Exceptions\OrderAlreadyAssignedToThisWorkerException;
use App\Exceptions\OrderDeclinedException;
use App\Exceptions\OrderNotFoundException;
use App\Exceptions\UserNotHavePartnershipException;
use App\Models\Order;
use App\Models\User;
use App\Repositories\IOrderRepository;
use App\Repositories\IUserRepository;
use App\Repositories\IWorkerRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException as EloquentModelNotFoundException;

readonly class OrderService implements IOrderService
{
    public function __construct(
        private IOrderRepository $orderRepository,
        private IWorkerRepository $workerRepository,
        private IUserRepository $userRepository,
    ) {
    }

    /**
     * @throws UserNotHavePartnershipException|ModelNotFoundException
     */
    public function createOrder(
        int $userId,
        string $description,
        int $amount,
        Carbon $date,
        string $address,
        int $typeId
    ): Order {
        $user = $this->getUser($userId);

        return $this->orderRepository->create(
            $user->getPartnershipId(),
            $userId,
            $description,
            $amount,
            $date,
            $address,
            $typeId,
            Status::CREATED,
        );
    }

    /**
     * @throws OrderDeclinedException
     * @throws OrderNotFoundException
     * @throws OrderAlreadyAssignedToThisWorkerException
     * @throws ModelNotFoundException
     * @throws UserNotHavePartnershipException
     */
    public function assignWorker(int $userId, int $orderId, int $workerId, int $amount): void
    {
        $user = $this->getUser($userId);
        $order = $this->orderRepository->findOrFail($orderId);
        $worker = $this->workerRepository->findOrFail($workerId);

        if ($order->getPartnershipId() !== $user->getPartnershipId()) {
            throw new OrderNotFoundException();
        }

        $isAlreadyAssigned = $this->orderRepository->hasWorker($orderId, $worker->getId());
        if ($isAlreadyAssigned) {
            throw new OrderAlreadyAssignedToThisWorkerException();
        }

        $isTypeExcluded = $this->workerRepository->hasExcludedType($workerId, $order->getTypeId());
        if ($isTypeExcluded) {
            throw new OrderDeclinedException();
        }

        $this->orderRepository->attachWorker($order, $worker, $amount);
    }

    /**
     * @throws UserNotHavePartnershipException|ModelNotFoundException
     */
    public function getUser(int $userId): User
    {
        try {
            $user = $this->userRepository->findOrFail($userId);
        } catch (EloquentModelNotFoundException $e) {
            throw new ModelNotFoundException('', 0, $e);
        }
        if (!$user->getPartnershipId()) {
            throw new UserNotHavePartnershipException();
        }

        return $user;
    }
}

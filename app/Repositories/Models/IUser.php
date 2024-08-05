<?php

namespace App\Repositories\Models;

interface IUser
{
    public function getPartnershipId(): int;

    public function setPartnershipId(int $partnershipId): void;
}

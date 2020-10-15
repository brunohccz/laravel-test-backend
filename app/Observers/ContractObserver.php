<?php

namespace App\Observers;

use App\Contract;
use App\Property;

class ContractObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param Contract $contract
     * @return void
     */
    public function created(Contract $contract)
    {
        $contract->property->update([
            'status' => Property::UNAVAILABLE
        ]);
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param Contract $contract
     * @return void
     */
    public function deleted(Contract $contract)
    {
        $contract->property->update([
            'status' => Property::AVAILABLE
        ]);
    }
}

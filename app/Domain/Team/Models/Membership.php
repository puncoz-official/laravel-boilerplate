<?php

namespace App\Domain\Team\Models;

use Laravel\Jetstream\Membership as BaseMembership;

/**
 * Class Membership
 */
class Membership extends BaseMembership
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;
}

<?php

/**
 * @return bool
 */
function isLoggedIn(): bool
{
    return auth()->guest() === false;
}

/**
 * @return \Illuminate\Contracts\Auth\Authenticatable|null|\App\Data\Entities\User\User
 */
function currentUser()
{
    return auth()->user();
}

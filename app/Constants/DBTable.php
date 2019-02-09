<?php

namespace App\Constants;

/**
 * Class DBTable
 * @package App\Constants
 */
class DBTable
{
    const CORE_ACTIVITIES  = 'core_activities';
    const CORE_MIGRATIONS  = 'core_migrations';
    const CORE_JOBS        = 'core_jobs';
    const CORE_JOBS_FAILED = 'core_jobs_failed';
    const CORE_SESSIONS    = 'core_sessions';

    const AUTH_USERS             = 'auth_users';
    const AUTH_ROLES             = 'auth_roles';
    const AUTH_PERMISSIONS       = 'auth_permissions';
    const AUTH_USERS_PERMISSIONS = 'auth_users_permissions';
    const AUTH_USERS_ROLES       = 'auth_users_roles';
    const AUTH_ROLES_PERMISSIONS = 'auth_roles_permissions';
    const AUTH_PASSWORD_RESETS   = 'auth_password_resets';
}

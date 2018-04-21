<?php

namespace App\Constants;

/**
 * Class DBTable
 * @package App\Constants
 */
class DBTable
{
    // System
    const MIGRATIONS      = 'sys_migrations';
    const LOGS_ACTIVITIES = 'sys_activity_logs';

    // Auth
    const AUTH_USERS             = 'auth_users';
    const AUTH_PASSWORD_RESETS   = 'auth_password_resets';
    const AUTH_ROLES             = 'auth_roles';
    const AUTH_USERS_ROLES       = 'auth_users_roles';
    const AUTH_PERMISSIONS       = 'auth_permissions';
    const AUTH_USERS_PERMISSIONS = 'auth_users_permissions';
    const AUTH_ROLES_PERMISSIONS = 'auth_roles_permissions';
}

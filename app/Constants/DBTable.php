<?php

namespace App\Constants;

/**
 * Class DBTable
 * @package App\Constants
 */
final class DBTable
{
    public const CORE_MIGRATIONS  = 'core_migrations';
    public const CORE_JOBS        = 'core_jobs';
    public const CORE_JOBS_FAILED = 'core_jobs_failed';

    public const SYS_ACTIVITIES = 'sys_activities';

    public const TELESCOPE_ENTRIES      = 'telescope_entries';
    public const TELESCOPE_ENTRIES_TAGS = 'telescope_entries_tags';
    public const TELESCOPE_MONITORING   = 'telescope_monitoring';

    public const AUTH_USERS             = 'auth_users';
    public const AUTH_ROLES             = 'auth_roles';
    public const AUTH_PERMISSIONS       = 'auth_permissions';
    public const AUTH_USERS_PERMISSIONS = 'auth_users_permissions';
    public const AUTH_USERS_ROLES       = 'auth_users_roles';
    public const AUTH_ROLES_PERMISSIONS = 'auth_roles_permissions';
    public const AUTH_PASSWORD_RESETS   = 'auth_password_resets';
}

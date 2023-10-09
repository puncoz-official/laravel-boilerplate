<?php

namespace App\Enums;

/**
 * Class DBTable
 */
enum DBTable: string
{
    public const CORE_MIGRATIONS = 'core_migrations';

    public const CORE_FAILED_JOBS = 'core_failed_jobs';

    public const CORE_SESSIONS = 'core_sessions';

    public const AUTH_USERS = 'auth_users';

    public const AUTH_PASSWORD_RESET_TOKENS = 'auth_password_reset_tokens';

    public const AUTH_PERSONAL_ACCESS_TOKENS = 'auth_personal_access_tokens';

    public const AUTH_TEAMS = 'auth_teams';

    public const AUTH_TEAM_USER = 'auth_team_user';

    public const AUTH_TEAM_INVITATIONS = 'auth_team_invitations';
}

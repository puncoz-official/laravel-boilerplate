<?php

namespace App\Infrastructure\Providers;

use App\Domain\Team\Models\Membership;
use App\Domain\Team\Models\Team;
use App\Domain\Team\Models\TeamInvitation;
use App\Domain\User\Models\User;
use Illuminate\Support\ServiceProvider;
use Laravel\Jetstream\Jetstream;

/**
 * Class JetstreamServiceProvider
 */
class JetstreamServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureModels();
        $this->configurePermissions();

//        Jetstream::createTeamsUsing(CreateTeam::class);
//        Jetstream::updateTeamNamesUsing(UpdateTeamName::class);
//        Jetstream::addTeamMembersUsing(AddTeamMember::class);
//        Jetstream::inviteTeamMembersUsing(InviteTeamMember::class);
//        Jetstream::removeTeamMembersUsing(RemoveTeamMember::class);
//        Jetstream::deleteTeamsUsing(DeleteTeam::class);
//        Jetstream::deleteUsersUsing(DeleteUser::class);
    }

    protected function configureModels(): void
    {
        Jetstream::useUserModel(User::class);
        Jetstream::useTeamModel(Team::class);
        Jetstream::useMembershipModel(Membership::class);
        Jetstream::useTeamInvitationModel(TeamInvitation::class);
    }

    /**
     * Configure the roles and permissions that are available within the application.
     */
    protected function configurePermissions(): void
    {
        Jetstream::defaultApiTokenPermissions(['read']);

        Jetstream::role('admin', 'Administrator', [
            'create',
            'read',
            'update',
            'delete',
        ])->description('Administrator users can perform any action.');

        Jetstream::role('editor', 'Editor', [
            'read',
            'create',
            'update',
        ])->description('Editor users have the ability to read, create, and update.');
    }
}

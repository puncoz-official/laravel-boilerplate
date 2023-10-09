<?php

namespace Database\Seeders\Seeders;

use App\Domain\Team\Models\Team;
use App\Domain\Team\Repositories\TeamRepository;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use JoBins\LaravelRepository\Exceptions\LaravelRepositoryException;

/**
 * Class SuperAdminSeeder
 */
class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws LaravelRepositoryException
     */
    public function run(TeamRepository $teamRepository)
    {
        try {
            /** @var Team $team */
            $team = $teamRepository->findByField('name', 'System');

            $teamOwner = $team->owner();
            $userData  = UserFactory::new()->superAdmin()->raw();

            $teamOwner->update([
                'full_name' => (array) Arr::get($userData, 'full_name'),
                'email'     => Arr::get($userData, 'email'),
                'username'  => Arr::get($userData, 'username'),
                'password'  => Arr::get($userData, 'password'),
            ]);
        } catch (ModelNotFoundException $exception) {
            UserFactory::new()->superAdmin()->create();
        }
    }
}

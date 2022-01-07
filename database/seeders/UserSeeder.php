<?php

namespace Database\Seeders;

use App\Models\Channel;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seedUsers = [
            [
                'name' => 'Administrator',
                'email' => 'admin@example.com',
                'password' => Hash::make('Password1'),
            ],
            [
                'name' => 'Eileen Dover',
                'email' => 'eileen@example.com',
                'password' => Hash::make('Password1'),
            ],
            [
                'name' => 'Russel Leaves',
                'email' => 'russel@example.com',
                'password' => Hash::make('Password1'),
            ],
        ];

        foreach ($seedUsers as $seedUser) {
            $user = User::create($seedUser);
            foreach (['Public', 'Private'] as $pubOrPrivate) {
                $userChannel = [
                    'user_id' => $user->id,
                    'name' => implode([$user->name, " ", $pubOrPrivate, " channel"]),
                    'slug' => Str::slug(implode([$user->name, " ", $pubOrPrivate, " channel"]), '-'),
                    'public' => $pubOrPrivate === 'Public',
                    'uid' => uniqid(true, true),
                    'description' => null,
                    'image' => null,
                ];
                $channel = Channel::create($userChannel);
                $team = $this->createTeam($user);
            }
        }
    }


    /**
     * Create a personal team for the user.
     *
     * Taken from the CreateNewUser class and reproduced for simplicity.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    protected function createTeam(User $user)
    {
        $user->ownedTeams()->save(
            Team::forceCreate([
                                  'user_id' => $user->id,
                                  'name' => explode(' ', $user->name, 2)[0]."'s Team",
                                  'personal_team' => true,
                              ])
        );
    }
}

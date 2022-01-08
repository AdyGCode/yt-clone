<?php

namespace Database\Seeders;

use App\Models\Channel;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Str;
use Symfony\Component\Console\Helper\ProgressBar;

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

        $defaultChannels = ['Public', 'Private', 'Delete This'];
        $totalSeedRecords = count($seedUsers);
        // Create a progress bar to monitor seeding of users
        $progressBar = $this->command->getOutput()->createProgressBar($totalSeedRecords);
        $progressBar->setRedrawFrequency(200);
        $progressBar->maxSecondsBetweenRedraws(1);
        $progressBar->minSecondsBetweenRedraws(0.01);
        $progressBar->start();

        foreach ($seedUsers as $seedUser) {
            $user = User::create($seedUser);
            // Create the default channels for the user
            foreach ($defaultChannels as $defaultChannel) {
                $channelName = implode([$user->name, " ", $defaultChannel, " channel"]);
                $userChannel = [
                    'user_id' => $user->id,
                    'name' => $channelName,
                    'slug' => Str::slug($channelName, '-'),
                    'public' => $defaultChannel === 'Public',
                    'uid' => uniqid(true, true),
                    'description' => null,
                    'image' => null,
                ];
                $channel = Channel::create($userChannel);
            }

            // Create the user a 'personal' team, and update seed progress
            $team = $this->createTeam($user);
            $progressBar->advance();
        }

        // end the progress bar, and start a new console output line
        $progressBar->finish();
        $this->command->info('');
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

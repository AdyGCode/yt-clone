<?php

namespace Database\Seeders;

use App\Models\Video;
use Illuminate\Database\Seeder;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seedVideos = [
            [
                'title' => "Welcome",
                'description' => "Front titles video",
                'duration' => "00:00:07",
                'series' => 0,
                'episode' => 0,
                'channel_id' => 1,
            ],
            [
                'title' => "Goodbye",
                'description' => "End titles video",
                'duration' => "00:00:12",
                'series' => 0,
                'episode' => 0,
                'channel_id' => 2,
            ],
            [
                'title' => "Nothingness",
                'description' => "A dark screen",
                'duration' => "12:12:12",
                'series' => 0,
                'episode' => 0,
                'channel_id' => 4,
            ],
        ];

        $totalSeedRecords = count($seedVideos);
        // Create a progress bar to monitor seeding of videos
        $progressBar = $this->command->getOutput()->createProgressBar($totalSeedRecords);
        $progressBar->setRedrawFrequency(20);
        $progressBar->maxSecondsBetweenRedraws(0.05);
        $progressBar->minSecondsBetweenRedraws(0.01);
        $progressBar->start();

        foreach ($seedVideos as $seedVideo) {
            $seedVideo['uid'] = uniqid(true, true);
            Video::create($seedVideo);
            $progressBar->advance();
        }

        // end the progress bar, and start a new console output line
        $progressBar->finish();
        $this->command->info('');
    }
}

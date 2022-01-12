<?php

namespace Database\Seeders;

use App\Models\Channel;
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
                'series' => null,
                'episode' => null,
                'channel_id' => 1,
                'filename' => "",
            ],
            [
                'title' => "Everything",
                'description' => "A white screen",
                'duration' => "01:01:01",
                'series' => 1,
                'episode' => 1,
                'channel_id' => 4,
                'filename' => "",
                'status' => 1,
            ],
            [
                'title' => "Nothingness",
                'description' => "A dark screen",
                'duration' => "02:02:02",
                'series' => 1,
                'episode' => 2,
                'channel_id' => 4,
                'filename' => "",
            ],
            [
                'title' => "Goodbye",
                'description' => "End titles video",
                'duration' => "00:00:12",
                'series' => null,
                'episode' => 1,
                'channel_id' => 2,
                'filename' => "",
                'status' => 1,
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
            $channelOwner = (Channel::where('id', $seedVideo['channel_id'])->first())->user_id;
            $seedVideo['uid'] = uniqid(true, true);
            $seedVideo['user_id'] = $channelOwner;
            $seedVideo['thumbnail'] = $seedVideo['filename'];
            Video::create($seedVideo);
            $progressBar->advance();
        }

        // end the progress bar, and start a new console output line
        $progressBar->finish();
        $this->command->info('');
    }
}

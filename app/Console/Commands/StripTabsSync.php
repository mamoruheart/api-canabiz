<?php

namespace App\Console\Commands;

use App\Models\StripTab;
use App\Models\User;
use App\Notifications\StripTabsNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class StripTabsSync extends Command
{
    protected $bar;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:strips';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $new_strips = collect([]);
        $ads = collect([]);
        $alerts = collect([]);
        $news = collect([]);


        $base_url = "https://www.gov.il/he/api/units/get/cannabis_unit";

        $response = Http::get($base_url);

        if ($response->status() == 200 && $response->json()) {
            $data = $response->json();
            $this->bar = $this->output->createProgressBar(count($data['alertsStrip']['alerts']));
            $this->bar->start();

            StripTab::query()->update(['is_old' => true]);

            foreach ($data['alertsStrip']['alerts'] as $alert) {
                $this->bar->advance();

                $strip = StripTab::updateOrCreate([
                    'title' => $alert['alert']['title'],
                    'date' => $alert['date'],
                ], [
                    'url' => $alert['alert']['url']
                ]);

                if (!$strip->is_old) {
                    $alerts->push($strip);
                }
            }

            $this->bar = $this->output->createProgressBar(count($data['newsStrip']['stripModel']['newsNoPictureStrip']['items']));
            $this->bar->start();

            StripTab::query()->update(['is_old' => true]);

            foreach ($data['newsStrip']['stripModel']['newsNoPictureStrip']['items'] as $item) {
                $this->bar->advance();

                $strip = StripTab::updateOrCreate([
                    'title' => $item['title'],
                    'date' => $item['metaData'][0],
                ], [
                    'description' => $item['description'],
                    'url' => $item['url']
                ]);

                if (!$strip->is_old) {
                    $news->push($strip);
                }
            }
        }





        $base_url = "https://www.gov.il/he/api/offices/getTabItems/policies?officeId=104cb0f4-d65a-4692-b590-94af928c19c0&unitId=f40553ef-e6a3-4687-82ad-ee05c42a0c40&topicId=&subTopic=&promotedData=&targetAudience=&subTargetAudience=";

        $response = Http::get($base_url);

        if ($response->status() == 200 && $response->json()) {
            $data = $response->json();
            $this->bar = $this->output->createProgressBar(count($data));
            $this->bar->start();

            StripTab::query()->update(['is_old' => true]);

            foreach ($data as $obj) {
                $this->bar->advance();

                $strip = StripTab::updateOrCreate([
                    'title' => $obj['title'],
                    'date' => $obj['metaData'][0],
                    'type' => $obj['metaData'][1]
                ], [
                    'description' => $obj['description'],
                    'url' => $obj['url']
                ]);

                if (!$strip->is_old) {
                    $new_strips->push($strip);
                }
            }


        }

        $base_url = "https://www.gov.il/he/api/offices/getTabItems/publication?officeId=104cb0f4-d65a-4692-b590-94af928c19c0&unitId=f40553ef-e6a3-4687-82ad-ee05c42a0c40&topicId=&subTopic=&promotedData=&targetAudience=&subTargetAudience=";

        $response = Http::get($base_url);

        if ($response->status() == 200 && $response->json()) {
            $data = $response->json();
            $this->bar = $this->output->createProgressBar(count($data));
            $this->bar->start();

            StripTab::query()->update(['is_old' => true]);

            foreach ($data as $obj) {
                $this->bar->advance();

                $strip = StripTab::updateOrCreate([
                    'title' => $obj['title'],
                    'date' => $obj['metaData'][0],
                    'type' => $obj['metaData'][1]
                ], [
                    'description' => $obj['description'],
                    'url' => $obj['url']
                ]);

                if (!$strip->is_old) {
                    $ads->push($strip);
                }
            }
        }

        if ($new_strips->count() > 0 || $ads->count() > 0 || $alerts->count() > 0 || $news->count() > 0) {
            $user = new User();

             $user->name = 'Guy';
             $user->email = 'guy@ewp.co.il';
             $user->notify(new StripTabsNotification($new_strips, $ads, $alerts, $news));
             error_log('emailed'.$user, 3, '/error.log');
            
//             $user->name = 'Oren';
//             $user->email = 'oren@knbis.com';
//             $user->notify(new StripTabsNotification($new_strips, $ads, $alerts, $news));
//
//             $user->name = 'Amit';
//             $user->email = 'amit@knbis.com';
//             $user->notify(new StripTabsNotification($new_strips, $ads, $alerts, $news));

            
        }

        return 0;
    }
}

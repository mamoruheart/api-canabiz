<?php

namespace App\Console\Commands;

use App\Models\Pharmacy;
use App\Models\User;
use App\Notifications\PharmaciesSyncNotification;
use App\Services\MedicalDataService;
use Illuminate\Console\Command;

class PharmaciesSync extends Command
{
    protected $bar;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:pharmacies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check pharmacies, make log and send to email';

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
        $service = new MedicalDataService("484d31ec-8788-4254-b33d-ab3225d4d327");

        $first = $service->getData(0, true);
        sleep(5);

        Pharmacy::query()->update(['in_db' => false]);
        error_log('pharm started', 3, './error.log');
        if ($first) {
            $total = $first[1];
            $this->bar = $this->output->createProgressBar($total);
            $this->bar->start();
            $this->processData($first[0]);

            for ($i=1; $i<=round($total / 10); $i++) {
                $this->processData($service->getData($i));
                sleep(5);
            }

            $notInDb = Pharmacy::whereInDb(false)->get();
            $new = Pharmacy::whereColumn('created_at', 'updated_at')->get();
            if ($new->count() > 0 || $notInDb->count() > 0) {
                error_log("\n pharm new" . $new, 3, './error.log');
                error_log("\n pharm notInDb".$notInDb, 3, './error.log');
                 $user = new User();
                 $user->name = 'Guy';
                 $user->email = 'guy@ewp.co.il';
                 $user->notify(new PharmaciesSyncNotification($new, $notInDb));

//                 $user->name = 'Oren';
//                 $user->email = 'oren@knbis.com';
//                 $user->notify(new PharmaciesSyncNotification($new, $notInDb));
//
//                 $user->name = 'Amit';
//                 $user->email = 'amit@knbis.com';
//                 $user->notify(new PharmaciesSyncNotification($new, $notInDb));

                
            }
            Pharmacy::whereIn('id', $notInDb->pluck('id'))->delete();
        }
        $this->bar->finish();
        return 0;
    }

    private function processData($data)
    {
        foreach ($data as $pharmacy) {
            Pharmacy::updateOrCreate([
                'name' => $pharmacy['Data']['pharmacy_name'],
                'city' => $pharmacy['Data']['pharmacy_city'],
                'street' => $pharmacy['Data']['pharmacy_street']
            ],[
                'delivery' => $pharmacy['Data']['pharmacy_delivery'] == "כן",
                'in_db' => true,
                'notes' => $pharmacy['Data']['pharmacy_notes'],
                'map' => $pharmacy['Data']['map']
            ]);
            $this->bar->advance();
        }
    }
}

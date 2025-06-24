<?php

namespace App\Console\Commands;

use App\Models\Physician;
use App\Models\User;
use App\Notifications\PhysiciansSyncNotification;
use App\Services\MedicalDataService;
use Illuminate\Console\Command;

class PhysiciansSync extends Command
{
    protected $bar;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:physicians';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check physicians, make log and send to email';

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
        $service = new MedicalDataService("96eda0d5-e3bf-4e3f-834d-de1e0c9fd3a2");

        $first = $service->getData(0, true);
        sleep(5);

        if ($first) {
            $this->bar = $this->output->createProgressBar($first[1]);
            $this->bar->start();
            $this->processData($first[0]);
            Physician::query()->update(['in_db' => false]);
            $InDb = Physician::get()->pluck('id');
            //$compare = array();
            for ($i=1; $i<=round($first[1] / 10); $i++) {
            
                $new =  $this->processData($service->getData($i));
                // if($new !=null){
                //     array_push($compare ,$new->id);  
                // }
                sleep(5);
            }
    
            $notInDb = Physician::whereInDb(false)->get();
            $new = Physician::whereColumn('created_at', 'updated_at')->get();
            if ($new->count() > 0 || $notInDb->count() > 0) {
                error_log("\n phys new" . $new, 3, './error.log');
                error_log("\n phys notInDb".$notInDb, 3, './error.log');
                $user = new User();
                error_log('emailed'.$user, 3, '../../error.log');
                $user->name = 'Guy';
               $user->email = 'guy@ewp.co.il';
                $user->notify(new PhysiciansSyncNotification($new, $notInDb));

//             $user->name = 'Oren';
//             $user->email = 'oren@knbis.com';
//                  $user->notify(new PhysiciansSyncNotification($new, $notInDb));
//
//             $user->name = 'Amit';
//             $user->email = 'amit@knbis.com';
//                  $user->notify(new PhysiciansSyncNotification($new, $notInDb));

                

            }
            Physician::whereIn('id', $notInDb->pluck('id'))->delete();
        }
        $this->bar->finish();
        return 0;
    }

    private function processData($data)
    {
        foreach ($data as $pharmacy) {
           $new =  Physician::updateOrCreate([
                'name' => $pharmacy['Data']['dr_name'],
                'city' => $pharmacy['Data']['city'],
                'street' => $pharmacy['Data']['street']
            ],[
                'institution' => $pharmacy['Data']['institution'],
                'in_db' => true,
                'specialty' => $pharmacy['Data']['specialty']
            ]);
            $this->bar->advance();
            //return $new;
        }
    }
}

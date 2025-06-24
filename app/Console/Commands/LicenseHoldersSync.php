<?php

namespace App\Console\Commands;

use App\Models\LicenseHolder;
use App\Models\User;
use App\Notifications\LicenseHoldersSyncNotification;
use App\Services\MedicalDataService;
use Illuminate\Console\Command;

class LicenseHoldersSync extends Command
{
     protected $bar;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:license_holders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check license holders, make log and send to email';

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
        $service = new MedicalDataService("901ca997-a597-45f0-9a3d-e1f6ae7bb77d");

        $first = $service->getData(0, true);
        sleep(5);

        LicenseHolder::query()->update(['in_db' => false]);
        error_log('LH started', 3, './error.log');
        if ($first) {
            $this->bar = $this->output->createProgressBar($first[1]);
            $this->bar->start();
            $this->processData($first[0]);

            for ($i=1; $i<=round($first[1] / 10); $i++) {
                $this->processData($service->getData($i));
                sleep(5);
            }

            $notInDb = LicenseHolder::whereInDb(false)->get();
            $new = LicenseHolder::whereColumn('created_at', 'updated_at')->get();
       
            if ($new->count() > 0 || $notInDb->count() > 0) {
                error_log("\n LH new" . $new, 3, './error.log');
                error_log("\n LH notInDb".$notInDb, 3, './error.log');
                 $user = new User();
                
                 $user->name = 'Guy';
                 $user->email = 'guy@ewp.co.il';
                 $user->notify(new LicenseHoldersSyncNotification($new, $notInDb));
                 error_log('emailed'.$user, 3, '../../error.log');
//
//                 $user->name = 'Amit';
//                 $user->email = 'amit@knbis.com';
//                 $user->notify(new LicenseHoldersSyncNotification($new, $notInDb));
//                
//                  $user->name = 'Oren';
//                 $user->email = 'oren@knbis.com';
//                 $user->notify(new LicenseHoldersSyncNotification($new, $notInDb));                

                
            }
            LicenseHolder::whereIn('id', $notInDb->pluck('id'))->delete();
        }
        $this->bar->finish();
        return 0;
    }

    private function processData($data)
    {
        $types = [
            "",
            "בית מסחר למוצרי קנביס medical grade בעל רישיון עיסוק",
            "מפעל ייצור למוצרי קנביס medical grade בעל רישיון עיסוק",
            "אתר גידול קנביס (תפרחות קנביס medical grade) בעל רישיון עיסוק",
            "אתר ריבוי קנביס (שתילי קנביס medical grade) בעל רישיון עיסוק",
            "גוף שינוע לקנביס ומוצרי medical grade בעל רישיון עיסוק",
            "גוף התעדה מוסמך לעמידה בתנאי איכות ואבטחה בקנביס",
            "מעבדת בדיקה לאצוות ולשירותי מחקר בקנביס בעלת רישיון עיסוק",
            "גוף עיסוק בקנביס בעל רישיון עיסוק - אחר",
            "אתר השמדה בעל רישיון עיסוק"
        ];
        foreach ($data as $pharmacy) {
            LicenseHolder::updateOrCreate([
                'name' => $pharmacy['Data']['company_name'],
            ],[
                'type' => $types[$pharmacy['Data']['type']],
                'in_db' => true
            ]);
            $this->bar->advance();
        }
    }
}

<?php

namespace App\Console\Commands;

use App\Requests;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;

class CancellBookings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bookings:cancel';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cancels Booking That have expired';

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
     * @return mixed
     */
    public function handle()
    {
        $requests = Requests::query()->where('end','>', now())
            ->where(function (Builder $builder){
                $builder->orWhere('status' , 'completed');
                $builder->orWhere('status' , 'init');
            })->get();

        /** @var Requests $request */
        foreach ($requests as $request)
        {
            echo 'Looking @ Request : ' . $request->id .PHP_EOL;

            if ($request->status === 'init')
            {
                $request->update([
                    'status' => 'cancelled'
                ]);

                echo 'Decision @ Request Cancelled : ' . $request->id .PHP_EOL;

            } else {

                echo 'Decision @ Request Ended : ' . $request->id .PHP_EOL;

                $request->update([
                    'status' => 'ended'
                ]);

                $location = $request->location;

                $location->update([
                    'occupied' => null,
                    'occupied_user_id' => null,
                    'reserved' => null,
                    'reserved_user_id' => null,
                    'vehicle_id' => null,
                ]);

            }
        }
    }
}

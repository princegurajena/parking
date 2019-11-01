<?php /** @noinspection ALL */

namespace App\Console\Commands;

use App\Notification;
use App\ParkingSpace;
use App\Requests;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;

class SimulateSensor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'simulation:censor';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Simulation of Censor Events';

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
        $this->alert("Sensor Simulation Terminal");

        $event = $this->choice(
            'Enter event to simulate',
            [ 'parks-after-paying' ,'leaving-parking-earlier' ,'parks-without-paying' ],
            0
        );

        $this->info("Event selected ". ucwords(str_replace('-', ' ' , $event)));

        if ($event === 'parks-after-paying')
        {
            // Get all occupied and paid for parking spaces

            $spaces = ParkingSpace::query()->where(function (Builder $builder) {
                $builder->whereNotNull(['reserved_user_id' , 'occupied_user_id'] , 'or');
            })->get();

            $this->info("Occupied or reserved number : " . count($spaces));

            if (count($spaces))
            {
                $result = collect($spaces)->map(function ($value){
                    return $value->id;
                })->values()->toArray();

                $choice = $this->choice(
                    'Enter parking space id',
                    $result,
                    0
                );

                $number = $this->ask('Enter Registration Number');

                /** @var ParkingSpace $space */

                $space = ParkingSpace::query()->find($choice);

                Notification::query()->create([
                    'type' => 'parking',
                    'message' => "Vehicle {$number} has parked on {$space->name} with successful payment",
                    'parking_space_id' => $choice,
                ]);

                $this->info("Vehicle {$number} has parked on {$space->name} with successful payment");
            }
        }

        if ($event === 'leaving-parking-earlier') {

            $spaces = ParkingSpace::query()->where(function (Builder $builder) {
                $builder->whereNotNull(['reserved_user_id' , 'occupied_user_id'] , 'or');
            })->get();

            $this->info("Occupied or reserved number : " . count($spaces));

            if (count($spaces))
            {
                $result = collect($spaces)->map(function ($value){
                    return $value->id;
                })->values()->toArray();

                $choice = $this->choice(
                    'Enter parking space id',
                    $result,
                    0
                );

                $requests = Requests::query()->where('end','>', now())->where(function (Builder $builder) use ($choice) {
                        $builder->orWhere('status' , 'completed');
                        $builder->where('parking_space_id' , '=', $choice);
                    })->get();

                $this->info("Requests : " . count($requests));

                if (count($requests))
                {
                    $request = $requests->first();

                    $request->update([
                        'status' => 'ended'
                    ]);

                    $location = $request->location;
                }

                $space = ParkingSpace::query()->find($choice);

                $space->update([
                    'occupied' => null,
                    'occupied_user_id' => null,
                    'reserved' => null,
                    'reserved_user_id' => null,
                    'vehicle_id' => null,
                ]);

                Notification::query()->create([
                    'type' => 'parking',
                    'message' => "Vehicle has left on {$space->name} before parking ending period",
                    'parking_space_id' => $choice,
                ]);

                $this->info("Vehicle has left on {$space->name} before parking ending period");
            }

        }

        if ($event === 'parks-without-paying'){

            $spaces = ParkingSpace::query()->where(function (Builder $builder) {
                $builder->whereNull(['reserved_user_id' , 'occupied_user_id'] , 'or');
            })->get();

            $this->info("Free parking number : " . count($spaces));


            if (count($spaces)){

                $result = collect($spaces)->map(function ($value){
                    return $value->id;
                })->values()->toArray();

                $choice = $this->choice(
                    'Enter parking space id',
                    $result,
                    0
                );

                $number = $this->ask('Enter Registration Number');

                /** @var ParkingSpace $space */

                $space = ParkingSpace::query()->find($choice);

                Notification::query()->create([
                    'type' => 'parking',
                    'message' => "Vehicle {$number} has parked on {$space->name} without payment",
                    'parking_space_id' => $choice,
                ]);

                $this->info("Vehicle {$number} has parked on {$space->name} without payment");

            }
        }

        $this->info(PHP_EOL);
        $this->alert("Sensor Simulation End");
        return;
    }
}

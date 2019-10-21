<?php

use App\ParkingSpace;
use App\User;
use App\Vehicle;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        User::query()->create([
            "name" => "Prince",
            "email" => "root@system",
            "role" => "admin",
            "password" => Hash::make("password")
        ]);

        Vehicle::query()->create([
            'user_id' => 1,
            'number' => 'ABK5522',
            'name'=> 'Range Rover Sport',
            'description' => 'Black in color'
        ]);

        $users = factory(User::class , 20 )->create();

        // create parking spots
        // -19.517569, 29.836276
        //  -19.517569 + 0.000030

        $lat = -19.517569;
        $long = 29.836276;

        $locations = [];

        for ($i = 0 ; $i < 10 ; $i++ )
        {
            $lat = $lat + 0.00018;
            $locations[] = [ $lat , $long ];
        }

        $lat = -19.517569;
        $long = 29.836106;

        for ($i = 0 ; $i < 10 ; $i++ )
        {
            $lat = $lat + 0.00018;
            $locations[] = [ $lat , $long ];
        }

        foreach ($locations as $key => $loc)
        {
            echo 'Adding Location ' . $loc[0] . ' - ' .$loc[1].PHP_EOL;

            $rand = random_int(1,3);

            echo "Random Value :  " .$rand.PHP_EOL;

            ParkingSpace::query()->create([
                'lat' => $loc[0],
                'long' => $loc[1],
                'name' => 'A'.$key,
                'road' => 'example',
                'city' => 'Gweru',
                'province' => 'Midlands',
                'country' => 'Zimbabwe',
                'rate' => 5,
            ]);
        }


        // create  vehicles for users

    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

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
        //
    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;

class Force extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'force:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Forcefully refresh the tables';

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
        \DB::statement('SET FOREIGN_KEY_CHECKS = 0'); //Turn off foreign key checks
        $this->call('migrate:fresh'); //Drops all the tables and runs the migrations
        \DB::statement('SET FOREIGN_KEY_CHECKS = 1'); //Turn on foreign key checks
        $this->info("Tables refreshed.");
    }
}

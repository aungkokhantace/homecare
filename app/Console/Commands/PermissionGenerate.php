<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PermissionGenerate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'aceplus:permissions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To generate the permissions for the system';

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
        $this->call('db:seed', array('--class' => 'Default_PermissionSeeder'));
    }
}

<?php

namespace VNCore\Horicon\Commands;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use VNCore\Horicon\Models\Role;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'horicon:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install application for Horicon';

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
        $this->line('[START NEW]');

        exec('composer require barryvdh/laravel-debugbar --dev');
        exec('composer require laravelcollective/html');
        exec('composer require spatie/laravel-medialibrary:^7.0.0');

        $this->call('make:auth');
        $this->call('notifications:table');

        $this->line('[END NEW]');
    }
}

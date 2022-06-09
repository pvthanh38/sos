<?php

namespace VNCore\Horicon\Commands;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use VNCore\Horicon\Models\Role;

class InitCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'horicon:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Init application for Horicon';

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
        //ln -sr storage/app/public public/storage
        //ln -sr /products/iroam-cms/cms/storage/app /products/iroam-cms/assets/cms-upload
        $this->line('[START INIT]');

        $this->call('storage:link');
        $this->call('migrate');
        $this->call('passport:install');

        $this->line('Create a new user');
        $user = new User();
        $user->name = 'Administrator';
        $user->title = 'Admin Manager';
        $user->email = 'admin@vncore.com';
        $user->password = bcrypt('secret');
        $user->save();
        $this->line('User: ' . $user->name);

        $this->line('Create new roles');
        $roles = ['admin', 'staff'];
        foreach ($roles as $roleName) {
            $role = new Role();
            $role->name = $roleName;
            $role->save();
            $this->line('Role: ' . $role->name);
        }

        $this->line('Assign the admin role to Admin');
        $user->roles()->attach(1);

        $this->line('[END INIT]');
    }
}

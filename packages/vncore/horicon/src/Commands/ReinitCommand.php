<?php

namespace VNCore\Horicon\Commands;

use Illuminate\Console\Command;

class ReinitCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'horicon:reinit';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reinit application for Horicon';

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
        $this->line('[START REINIT]');

        $this->call('migrate:rollback');

        $this->line('[END REINIT]');
    }
}

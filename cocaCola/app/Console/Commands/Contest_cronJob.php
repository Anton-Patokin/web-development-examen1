<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Classes\order_contest;
use App\Contest;

class Contest_cronJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'contest:proses';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'choose winner sen email';

    /**
     * Create a new command instance.
     *
     * @return void
     */

    protected $_active_Contest;
    public function __construct()
    {
        parent::__construct();
        $this->_active_Contest = new order_contest();

    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $contests = Contest::all();

        if($contest_now=$this->_active_Contest->get_contest()){
            
            var_dump($contest_now);
        }

    }
}

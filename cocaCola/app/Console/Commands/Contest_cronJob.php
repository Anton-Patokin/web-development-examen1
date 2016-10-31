<?php

namespace App\Console\Commands;

use App\Googlelocation;
use Illuminate\Console\Command;
use App\Classes\order_contest;
use App\Contest;
use Carbon\Carbon;
use App\Participant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\User;

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
        $query = "select * from participants where created_at>='" . Carbon::now()->startOfDay() . "';";


        if (DB::select($query)) {
            $participants = DB::select($query);
            Mail::send('email.email', ['participants' => $participants, 'contest' => $contest_now = $this->_active_Contest->get_contest()], function ($message) {
                $message->to('paraplu@list.ru', 'paraplu')->subject("test laravel");
            });
            echo "vandag hebben " . count(DB::select($query)) . " gerigistreerd";
        }


        $end_contest_date = Carbon::parse($contest_now = $this->_active_Contest->get_contest()->date_end)->startOfDay();
        $today = Carbon::now()->startOfDay()->tomorrow();
        if ($end_contest_date == $today) {
            if ($this->_active_Contest->get_contest()->type == "code") {

                $win_partisipants = $this->_active_Contest->get_contest()->participants()->get()->random(3);

                Mail::send('email.winParticipants', ['participants' => $win_partisipants, 'contest' => $contest_now = $this->_active_Contest->get_contest()], function ($message) {
                    $message->to('paraplu@list.ru', 'paraplu')->subject("test laravel");
                });
            } elseif ($this->_active_Contest->get_contest()->type == "Google-maps") {


                if ($top10 = Googlelocation::orderBy('distance', 'ASC')->take(10)->get()){
                    $array = [];

                    
                    foreach ($top10 as $top) {

                        $user = $top->user()->get()[0];

                        //return User::where('id',$user->id);
                        $participant = $user->get_participant()->get()[0];
                        array_push($array, $participant);
                    }
                    //print_r($array);
                    $win_partisipants = $array;
                    //print_r($win_partisipants);

                    $send_to = $this->_active_Contest->get_contest()->email;
                    echo $send_to;
                    Mail::send('email.winParticipants', ['participants' => $win_partisipants, 'contest' => $contest_now = $this->_active_Contest->get_contest()], function ($message) {
                        $message->to('paraplu@list.ru', 'paraplu')->subject("test laravel");
                    });
                }


            }
        }

        echo "cron job werkt";

        //echo  $contest_now=$this->_active_Contest->get_contest();

        //var_dump(Participant::all());
        //echo print_r(Participant::query('id'),true);
        //echo print_r(Participant::where('id',1),true);
        //Participant::
        //var_dump(Participant::all()->name);
        // echo Participant::query('select id from participants limit 1;')->each;;

        //echo Carbon::now()->startOfDay()->timestamp();
        //echo Carbon::now()->startOfDay()->getTimestamp();
        //$query1 = "select * from `participants` where created_at BETWEEN '".Carbon::now()->startOfDay()->getTimestamp()."' AND '".Carbon::now()->endOfDay()->getTimestamp()."';";
        //$query2 = "select * from participants where created_at BETWEEN '".Carbon::now()->startOfDay()."' AND '".Carbon::now()->endOfDay()."';";

        //$query = "select * from participants where created_at>='".Carbon::now()->startOfDay()."';";

        // print_r($query."\n");
        //print_r($query1."\n");
        //print_r($query2."\n");
        // print_r(DB::select($query));


        //$contests = Contest::all();


//        if($contest_now=$this->_active_Contest->get_contest()){
//
//            var_dump(Participant::where('created_at','==', Carbon::now()));
//            echo  Carbon::now();
//
//            if($Participants_today = $contest_now::where('date_start','>=', Carbon::now())){
//                echo "partisipants today";
//                var_dump($Participants_today);
//            }else{
//                echo  "Niemand heeft vandaag gespeeld";
//            }
//
//        }

    }
}

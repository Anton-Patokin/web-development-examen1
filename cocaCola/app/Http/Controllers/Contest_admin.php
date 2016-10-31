<?php

namespace App\Http\Controllers;


use app\Classes\order_contest;
use App\User;
use Illuminate\Http\Request;
use Collective\Html\Eloquent\FormAccessible;
use App\Http\Requests;
use App\Contest;
use App\Participant;
use Excel;
use App\Classes\timeClasses;
use App\Googlelocation;
use Illuminate\Support\Facades\DB;


class Contest_admin extends Controller
{
    use FormAccessible;


    protected $_mijnNieuweClass;
    protected $_dystance;

    public function __construct()
    {

        $this->_mijnNieuweClass = new timeClasses();
        $pricesClass = new timeClasses();
        $this->middleware('auth');
//        $this->middleware('isAdmin');
    }

    public function test()
    {
        return var_dump();

        //Mailer::to('paraplu@list.ru')->send(new ContestMail());
//        Mail::send('email.email', ['title' => "paraplu"], function ($message) {
//            $message->to('paraplu@list.ru', 'paraplu')->subject("test laravel");
//        });
        return "test";
    }

    public function index()
    {
        $contests = Contest::all();
        return view("admin/contest", ['contests' => $contests]);
    }

    public function seCourenturentContest(Request $request)
    {

        $this->validate($request, [
            'contestName' => 'required|max:255',
            'contestDateStart' => 'required|date',
            'contestDateEnd' => 'required|date',
            'contestType' => 'required',
            'email' => 'required|email|max:100|'
        ]);

        $pricesClass = new timeClasses();
        $bool = $pricesClass->validateDate($request->contestDateStart, $request->contestDateEnd, 0);
        //return $bool ? 'true' : 'false';
        if ($bool) {
            $contests = Contest::all();
            if (count($contests) < 4) {
                $Contestdatum = new Contest;
                $Contestdatum->name = $request->contestName;
                $Contestdatum->date_start = $request->contestDateStart;
                $Contestdatum->date_end = $request->contestDateEnd;
                $Contestdatum->type = $request->contestType;
                $Contestdatum->email = $request->email;
                $Contestdatum->save();
            }
        }
        return redirect("/contest");
    }

    public function updateCourenturentContest($id)
    {

//        $this->validate($request, [
//            'contestName' => 'required|max:255',
//            'contestDateStart' => 'required|date',
//            'contestDateEnd' => 'required|date',
//            'contestType' => 'required',
//        ]);
//
        $contests = Contest::find($id);
//        $contests->contestName = $request->contestName;
//        $contests->contestDateStart = $request->contestDateStart;
//        $contests->contestDateEnd = $request->contestDateEnd;
//        $contests->contestType = $request->contestType;
//        $contests->save();
        return view("admin/update", ['contest' => $contests]);
    }

    public function updateNowCourenturentContest(Request $request, $id)
    {
        $this->validate($request, [
            'contestName' => 'required|max:255',
            'contestDateStart' => 'required|date',
            'contestDateEnd' => 'required|date',
            'contestType' => 'required',
            'email' => 'required|max:100|email'
        ]);


        $pricesClass = new timeClasses();
        $bool = $pricesClass->validateDate($request->contestDateStart, $request->contestDateEnd, $id);
        //return $bool ? 'true' : 'false';
        if ($bool) {
            $contests = Contest::find($id);
            $contests->name = $request->contestName;
            $contests->date_start = $request->contestDateStart;
            $contests->date_end = $request->contestDateEnd;
            $contests->type = $request->contestType;
            $contests->email = $request->email;
            $contests->save();
        }

        return redirect("/contest");
    }


    public function deleteCourenturentContest($id)
    {
        if ($contests = Contest::find($id)) {
            $contests->delete();
        }
        return redirect("/contest");
    }

    public function showContestant($project_id)
    {

//        $array = [];
//        $contests = Contest::all();
//        foreach ($contests as $contest) {
//            //return Contestdatums::find($contest->id)->participants()->get();
//            $array = array_add($array, $contest->name, Contest::find($contest->id)->participants()->get());
//        }

        $contest = Contest::where('id', $project_id)->first();
        $pagination_partisipant = $contest->participants()->paginate(15);
        return view("admin/users", ['contest' => $contest, 'participants' => $pagination_partisipant]);
    }

    public function deleteContestant($id)
    {
        if ($partisepant = Participant::find($id)) {


            if ($partisepant->user_id) {
                User::where('id', $partisepant->user_id)->first()->usergooglelocations()->delete();
                User::where('id', $partisepant->user_id)->delete();


            }

            $partisepant->delete();

        };

        return back();
    }

    public function download_excelContestant($id_contest)
    {

        if ($contest = Contest::where('id', $id_contest)->first()) {
            $get_participants = $contest->first()->participants()->get();
            Excel::create('contest', function ($excel) use ($get_participants) {

                $excel->sheet('participants', function ($sheet) use ($get_participants) {

                    $sheet->fromArray($get_participants);

                });

            })->export('xls');
        }


        // niet nodig maar toch
        return redirect('/contastant');
    }
}

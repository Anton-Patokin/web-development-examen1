<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Contestdatums;
use App\Participant;
use Excel;
use App\Classes\timeClasses;


class Contest extends Controller
{
    use FormAccessible;

    public function test()
    {

    }

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isAdmin');
    }

    public function index()
    {
        $contests = Contestdatums::all();
        return view("admin/contestDatums", ['contests' => $contests]);
    }

    public function seCourenturentContest(Request $request)
    {

        $this->validate($request, [
            'contestName' => 'required|max:255',
            'contestDateStart' => 'required|date',
            'contestDateEnd' => 'required|date',
            'contestType' => 'required',
        ]);

        $pricesClass = new timeClasses();
        $bool = $pricesClass->validateDate($request->contestDateStart,$request->contestDateEnd,0);
        //return $bool ? 'true' : 'false';
        if($bool){
            $contests = Contestdatums::all();
            if (count($contests) < 4) {
                $Contestdatum = new Contestdatums;
                $Contestdatum->contestName = $request->contestName;
                $Contestdatum->contestDateStart = $request->contestDateStart;
                $Contestdatum->contestDateEnd = $request->contestDateEnd;
                $Contestdatum->contestType = $request->contestType;
                $Contestdatum->save();
            }
        }
        return redirect("/contest_datums");
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
        $contests = Contestdatums::find($id);
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
        ]);


        $pricesClass = new timeClasses();
        $bool = $pricesClass->validateDate($request->contestDateStart,$request->contestDateEnd,$id);
        //return $bool ? 'true' : 'false';
        if($bool){
            $contests = Contestdatums::find($id);
            $contests->contestName = $request->contestName;
            $contests->contestDateStart = $request->contestDateStart;
            $contests->contestDateEnd = $request->contestDateEnd;
            $contests->contestType = $request->contestType;
            $contests->save();
        }

        return redirect("/contest_datums");
    }


    public function deleteCourenturentContest($id)
    {
        if ($contests = Contestdatums::find($id)) {
            $contests->delete();
        }


        return redirect("/contest_datums");

    }

    public function showContestant()
    {


        return Contestdatums::find(1)->participants()->get();
        $array = [];
        $contests = Contestdatums::all();
        foreach ($contests as $contest) {
            //return Contestdatums::find($contest->id)->participants()->get();
            $array = array_add($array, $contest->contestName, Contestdatums::find($contest->id)->participants()->get());
        }
        return view("admin/users", ['contests' => $array]);
    }

    public function deleteContestant($id)
    {
        if ($partisepant = Participant::find($id)) {
            $partisepant->delete();
        };

        return redirect('/contastant');
    }
    public  function  download_excelContestant($name){

        if(Contestdatums::where('contestName', $name)->first()){
            $get_participants = Contestdatums::where('contestName', $name)->first()->participants()->get();
            Excel::create('contest', function($excel) use($get_participants) {

                $excel->sheet('participants', function($sheet) use($get_participants) {

                    $sheet->fromArray($get_participants);

                });

            })->export('xls');
        }


        // niet nodig maar toch
        return redirect('/contastant');
    }

}
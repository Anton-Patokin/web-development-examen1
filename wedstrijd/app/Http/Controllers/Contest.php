<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Contestdatums;
use App\Participant;


class Contest extends Controller
{
    use FormAccessible;

    public function __construct()
    {
        $this->middleware('auth');
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

        $contests = Contestdatums::all();
        if (count($contests) < 4) {
            $Contestdatum = new Contestdatums;
            $Contestdatum->contestName = $request->contestName;
            $Contestdatum->contestDateStart = $request->contestDateStart;
            $Contestdatum->contestDateEnd = $request->contestDateEnd;
            $Contestdatum->contestType = $request->contestType;
            $Contestdatum->save();
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

    public function updateNowCourenturentContest(Request $request,$id)
    {
        $this->validate($request, [
            'contestName' => 'required|max:255',
            'contestDateStart' => 'required|date',
            'contestDateEnd' => 'required|date',
            'contestType' => 'required',
        ]);

        $contests = Contestdatums::find(16);
        $contests->contestName = $request->contestName;
        $contests->contestDateStart = $request->contestDateStart;
        $contests->contestDateEnd = $request->contestDateEnd;
        $contests->contestType = $request->contestType;
        $contests->save();
        return redirect("/contest_datums");
    }


    public function deleteCourenturentContest($id)
    {

        $contests = Contestdatums::find($id);
        $contests->delete();

        return redirect("/contest_datums");

    }

    public  function  showContestant(){
        //comit
        return Contestdatums::find(1)->participants()->get();
    }

}
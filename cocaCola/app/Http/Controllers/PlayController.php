<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contest;
use App\Classes\order_contest;
use App\Participant;



class PlayController extends Controller
{

    public function index()
    {
        $contest = new order_contest();
        $project = $contest->get_contest();

        if (!($project)) {
            return redirect('/');
        }
        return view('/play/' . $project->type, ['contest' => $project]);

        //return view('/play/play-contest', ['wedstrijd' => Contestdatums::all()]);
    }

//    public function code(Request $request)
//    {
//        $this->validate($request, [
//            'code' => 'required|max:6|min:6',
//
//        ]);
//        return view('/play/partisipan_info')->with("code", $request->code)->with("type", "code");
//    }

    public function logica($type, Request $request)
    {
        return redirect("/apartisipan-information");
        $this->validate($request, [
            'name' => 'required|min:6|max:255',
            'address' => 'required|min:6|max:255',
            'location' => 'required|min:6|max:255',
            'email' => 'required|email|unique:participants',
        ]);
        return "okeey";
        if ($type == "code") {
            $this->validate($request, [
                'code' => 'required|max:6|min:6',
            ]);
        }


        $participant = new Participant();
        $participant->ipAdres = $request->contestName;
        $participant->name = $request->name;
        $participant->adres = $request->address;
        $participant->location = $request->location;
        $participant->email = $request->contestType;
        $participant->Contestdatums_id = $request->contestType;
        $participant->save();

        return redirect('/');
    }
    
}

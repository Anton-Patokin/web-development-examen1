<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contest;
use App\Classes\order_contest;
use App\Participant;
use Illuminate\Support\Facades\Session;

class PlayController extends Controller
{

    protected $_contest;

    public function __construct()
    {
        $this->_contest = new order_contest();

        $this->middleware('auth');
//        $this->middleware('isAdmin');
    }

    public function index()
    {


        if (!($project = $this->_contest->get_contest())) {
            Session::flash('message', 'Sorry but today there are no contests. Check play date at the bottom of the page.');
            return redirect('/');
        }
        return view('/play/' . $project->type, ['contest' => $project]);

        //return view('/play/play-contest', ['wedstrijd' => Contestdatums::all()]);
    }

    public function play_code(Request $request)
    {


        //return  $request->ip();


        if (!($project = $this->_contest->get_contest()) || count($this->_contest->get_contest()->participants()->where('ip_adres', $request->ip())->get())) {
            Session::flash('message', 'you may participate only once');
            return redirect('/');
        }


        $this->validate($request, [
            'code' => 'required|max:6|min:6',
            'name' => 'required|max:100',
            'email' => 'required|email|max:255|unique:participants',
            'address' => 'required|max:255',
            'location' => 'required',
        ]);


        $partisipant = new Participant();
        $partisipant->ip_adres = $request->ip();
        $partisipant->name = $request->name;
        $partisipant->address = $request->address;
        $partisipant->location = $request->location;
        $partisipant->email = $request->email;

        $project->participants()->save($partisipant);

        Session::flash('succes', 'Thank you for participating, We will contact the winners by email');
        return back();
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

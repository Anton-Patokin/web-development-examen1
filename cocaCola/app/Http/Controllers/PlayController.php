<?php

namespace App\Http\Controllers;

use App\Googlelocation;
use App\User;
use Illuminate\Http\Request;
use App\Contest;
use App\Classes\order_contest;
use App\Participant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;


class PlayController extends Controller
{

    protected $_contest;

    public function __construct()
    {
        $this->_contest = new order_contest();

        if (($this->_contest->get_contest()) && $this->_contest->get_contest()->type == "Google-maps") {
            $this->middleware('auth');
        }

        //$this->middleware('auth');
//        $this->middleware('isAdmin');
    }

    public function index()
    {


        if (!($project = $this->_contest->get_contest())) {
            Session::flash('message', 'Sorry but today there are no contests. Check play date at the bottom of the page.');
            return redirect('/');
        }
        if ($project->type == 'Google-maps') {
            $top10 = Googlelocation::orderBy('distance', 'ASC')->take(10)->get();


            $array = [];

            foreach ($top10 as $top) {
                $user = $top->user()->get()[0];

                //return User::where('id',$user->id);
                $participant = $user->get_participant()->get()[0]->name;
                $array = array_add($array, $participant, $top->distance);
            }
            return view('/play/' . $project->type, ['contest' => $project, 'top10' => $array]);
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

    public function google_maps_logica($var)
    {
        if ($var == "pins") {
            // return Googlelocation::all();
            return $this->_contest->get_contest()->contestgooglelocations()->get();
        }
        if ($var == "top10") {
            return $this->_contest->get_contest()->contestgooglelocations()->get();
        }
        return "Now results found";
    }

    public function google_maps_logica_post(Request $request)
    {


        $rules = array('lat' => 'required|unique:googlelocations|max:25',
            'lng' => 'required|unique:googlelocations|max:25',
            'name' => 'required|max:100', 'address' => 'required|max:255',
            'location' => 'required|max:100');


//
//        $validator = Validator::make(Input::all(), $rules);
//
//// Validate the input and return correct response
//        if ($validator->fails()) {
//            return Response::json(array(
//                'success' => false,
//                'errors' => $validator->getMessageBag()->toArray()
//
//            ), 400); // 400 being the HTTP code for an invalid request.
//        }
//        return Response::json(array('success' => true), 200);


        // win location lat 32.317838 lng -90.886714
        $this->validate($request, $rules);


        if (count(Auth::user()->usergooglelocations()->get()) < "1") {


            $contest_dystance = new order_contest();
            $distance = $contest_dystance->DistAB($request->lat, $request->lng, "32.317838", "-90.886714");

            $location = new Googlelocation();
            $location->lat = $request->lat;
            $location->lng = $request->lng;
            $location->contest_id = $this->_contest->get_contest()->id;
            $location->user_id = Auth::id();
            $location->distance = floatval($distance);
            $location->save();

            $partisipant = new Participant();
            $partisipant->ip_adres = $request->ip();
            $partisipant->name = $request->name;
            $partisipant->address = $request->address;
            $partisipant->location = $request->location;
            $partisipant->email = Auth::user()->email;
            $partisipant->user_id = Auth::id();

            $this->_contest->get_contest()->participants()->save($partisipant);

        }else{
            return "error";
        }

        return $array = array('succes' => array('distance' => $distance,'place'=>"10"));
    }

}

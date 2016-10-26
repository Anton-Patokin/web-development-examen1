<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contestdatums;

use App\Http\Requests;

class PlayController extends Controller
{
    public function index()
    {

        $contest_active = "";
        if ($projects = Contestdatums::orderBy('contestDateStart')->get()) {
            foreach ($projects as $project) {

                if (strtotime($project->contestDateStart) <= time() && strtotime($project->contestDateEnd) >= time()) {
                    return view('/play/'.$project->contestType, ['contest' => $project]);
                }
            }
        }

        return redirect("/");


        return view('/play/play-contest', ['wedstrijd' => Contestdatums::all()]);
    }
}

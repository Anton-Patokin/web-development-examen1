<?php

namespace app\Classes;

use App\Contestdatums;


class order_contest
{
    public function get_contest()
    {
        $contest_id = false;
        if ($projects = Contestdatums::orderBy('contestDateStart')->get()) {
            foreach ($projects as $project) {

                if (strtotime($project->contestDateStart) <= time() && strtotime($project->contestDateEnd) >= time()) {
                    return $project;
                }
            }
        }

        return $contest_id;
    }
}


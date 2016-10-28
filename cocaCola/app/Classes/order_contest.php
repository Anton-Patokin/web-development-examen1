<?php

namespace app\Classes;

use App\Contest;


class order_contest
{
    public function get_contest()
    {
        $contest_id = false;
        
        if ($projects = Contest::orderBy('date_start')->get()) {

            foreach ($projects as $project) {

                if (strtotime($project->date_start) <= time() && strtotime($project->date_end) >= time()) {
                    return $project;
                }
            }
        }

        return $contest_id;
    }
}


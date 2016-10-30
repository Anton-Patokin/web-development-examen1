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
    public $lat_a = 0;
    public $lon_a = 0;
    public $lat_b = 0;
    public $lon_b = 0;

    public $measure_unit = 'kilometers';

    public $measure_state = false;

    public $measure = 0;

    public $error = '';

    public function DistAB($lat_a, $lon_a, $lat_b, $lon_b)
    {
        $delta_lat = $lat_b - $lat_a;
        $delta_lon = $lon_b - $lon_a;

        $earth_radius = 6372.795477598;

        $alpha = $delta_lat / 2;
        $beta = $delta_lon / 2;
        $a = sin(deg2rad($alpha)) * sin(deg2rad($alpha)) + cos(deg2rad($this->lat_a)) * cos(deg2rad($this->lat_b)) * sin(deg2rad($beta)) * sin(deg2rad($beta));
        $c = asin(min(1, sqrt($a)));
        $distance = 2 * $earth_radius * $c;
        $distance = round($distance, 4);

        $this->measure = $distance;
        return $this->measure;
    }



}


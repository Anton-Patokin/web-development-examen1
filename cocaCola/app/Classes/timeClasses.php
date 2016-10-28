<?php

namespace app\Classes;

use App\Contest;
use Illuminate\Support\Facades\Session;

class timeClasses
{
    public function validateDate($dateStart, $dateEnd, $id)
    {
        $validate = false;

//        control if the past date are valide
        if (strtotime($dateStart) < strtotime($dateEnd)) {
            if ($contests = Contest::all()) {

                foreach ($contests as $contest) {
                    if (!($contest->id == $id)) {
                        $contest_start = $contest->date_start;
                        $contest_end = $contest->date_end;
                        if ((strtotime($dateStart) <= strtotime($contest_start) && strtotime($dateEnd) >= strtotime($contest_start)) || ((strtotime($dateStart) <= strtotime($contest_end) && strtotime($dateEnd) >= strtotime($contest_end)))) {
                            Session::flash('message', 'This date is already reserved');
                            return $validate = false;
                        }
                    }
                }
                return $validate = true;
            }
            return $validate = true;
        }
        Session::flash('message', 'End date must be later than start date');
        return $validate;
    }
}


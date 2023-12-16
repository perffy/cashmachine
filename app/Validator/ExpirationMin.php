<?php

namespace App\Validator;

use Carbon\Carbon;

class ExpirationMin
{
    public function validate($attribute, $value, $parameters, $validator)
    {
        $minMonths = $parameters[0];
        $month = $validator->getData()[$parameters[1]];
        $year = $validator->getData()[$parameters[2]];

        $ccDate = Carbon::parse($year.'-'.$month.'-01')->floorMonth();
        $today = Carbon::parse(date('Y-m-d'))->floorMonth();
        $diff = $today->diffInMonths($ccDate, false);

        return $diff >= $minMonths;
    }
}

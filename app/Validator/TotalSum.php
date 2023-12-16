<?php

namespace App\Validator;

class TotalSum
{
    public function validate($attribute, $value, $parameters, $validator)
    {
        $sum = 0;
        $max = $parameters[0] ?? 10000;
        unset($parameters[0]);

        foreach ($parameters as $parameter) {
            $multiplier = explode("_", $parameter);
            $sum += $validator->getData()[$parameter] ? $validator->getData()[$parameter] * (int)$multiplier[1] : 0;
        }

        return $sum <= $max;
    }

}

<?php

if(!function_exists('getMonths')) {
    function getMonths()
    {
        return [
            '01' => 'Jan',
            '02' => 'Feb',
            '03' => 'Mar',
            '04' => 'Apr',
            '05' => 'Mai',
            '06' => 'Jun',
            '07' => 'Jul',
            '08' => 'Aug',
            '09' => 'Sep',
            '10' => 'Oct',
            '11' => 'Nov',
            '12' => 'Dec',
        ];
    }
}

if(!function_exists('getYears')) {
    function getYears()
    {
        $years = [];
        for ($i = date('Y'); $i < date('Y') + 10; ++$i) {
            $years[$i] = $i;
        }
        return $years;
    }
}

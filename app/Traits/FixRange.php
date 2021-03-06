<?php

namespace App\Traits;

use Carbon\Carbon;

trait FixRange
{
    /**
     * @param $value
     * @return string[]
     * @todo: analysis the value of ricRange and return the suitable range
     */
    public function getFixRangeDates($value)
    {
        /**
         * today:
         *  2022-02-17  00:00:00 --> 2022-02-17  23:59:59
         * monthly:
         *  2022-02-01  00:00:00 --> 2022-02-28  23:59:59
         * yearly:
         * 2022-01-01  00:00:00 --> 2022-12-31  23:59:59
         */
        $today = Carbon::now(); //Current Date and Time
        //check from the value
        if ($value == 'today') {
            $from = $to = $today->format('Y-m-d');
        } elseif ($value == 'monthly') {
            $from = Carbon::parse($today)->startOfMonth()->toDateString();
            $to = Carbon::parse($today)->endOfMonth()->toDateString();
        } else {
            //yearly or wrong value
            $year = Carbon::now()->format('Y');
            $from = $year . '-01-01';
            $to = $year . '-12-31';
        } //if-else
        //return the range
        return [
            'from' => $from . ' ' . ' 00:00:00',
            'to' => $to . ' ' . ' 23:59:59'
        ];
    } //method

}//trait

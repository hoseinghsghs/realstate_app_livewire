<?php

use Carbon\Carbon;

if (!function_exists('generateImageName')) {
    function generateImageName($name)
    {
        $year = Carbon::now()->year;
        $month = Carbon::now()->month;
        $day = Carbon::now()->day;
        $hour = Carbon::now()->hour;
        $minute = Carbon::now()->minute;
        $second = Carbon::now()->second;
        $microsecond = Carbon::now()->microsecond;
        return $year . '_' . $month . '_' . $day . '_' . $hour . '_' . $minute . '_' . $second . '_' . $microsecond . '_' . $name;
    }
}
if (!function_exists('PertiongenerateImageName')) {
    function PertiongenerateImageName($name)
    {
        $v = verta();
        $v->timezone = 'Asia/Tehran';
        $year=$v->year; // 1396
        $month=$v->month; // 3
        $day=$v->day; // 14
        $hour=$v->hour; // 14
        $minute=$v->minute; // 18
        $second=$v->second;
        $micro=$v->micro;
        return $year . '_' . $month . '_' . $day . '_' . $hour . '_' . $minute . '_' . $second . '_' . $micro . '_' . $name;
    }
}
?>
<?php

namespace App\Http\Controllers;

trait GetTimeController
{

  public function getTime () {
    $gettime = get_headers("https://google.com")[3];
    $gethour = explode(' ', $gettime)[5];
    $D = (int)explode(' ', $gettime)[2];
    $M = 6;
    $Y = (int)explode(' ', $gettime)[4];
    $h = (int)explode(':', $gethour)[0] + 7;
    $m = (int)explode(':', $gethour)[1];
    $s = (int)explode(':', $gethour)[2];
    $timeint = mktime($h, $m, $s, $M, $D, $Y);
    $time = date("Y-m-d H:i:s", $timeint);
    return $time;
  }

}
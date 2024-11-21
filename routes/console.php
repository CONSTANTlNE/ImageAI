<?php

use App\Jobs\CheckMidjourney;
use App\Jobs\FetchRunwayJob;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

//Artisan::command('inspire', function () {
//    $this->comment(Inspiring::quote());
//})->purpose('Display an inspiring quote')->hourly();

//Schedule::call(function () {
//    DB::table('recent_users')->delete();
//})->daily();

Schedule::job(new CheckMidjourney())->everyTwentySeconds();
Schedule::job(new FetchRunwayJob())->everyFiveSeconds();
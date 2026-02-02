<?php

use App\Models\WeeklyQuestion;
use Illuminate\Support\Facades\Artisan;
use App\Models\Word;

Artisan::command('weekly:expire', function () {
    WeeklyQuestion::where('is_active', true)
        ->whereDate('end_date', '<', now()->toDateString())
        ->update(['is_active' => false]);
    $this->comment('Expired weekly questions updated.');
})->purpose('Deactivate expired weekly questions')->weeklyOn(5, '23:59'); 



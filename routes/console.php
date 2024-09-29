<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('test:test {name : is name} {--A|--aptt= : test apt}',function($name){
    // dd($this->option('aptt'));
    $this->line("<info>this test comment for</info> $name ") ;
})->purpose('this is a tests ');

Artisan::command('nsme:set_name',function(){
    $name=$this->ask('inter your name');
    $this->error("this {$name}");
});
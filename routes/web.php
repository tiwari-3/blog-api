<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get("/test", function(){
    return ["name"=>"Mayank Tiwari", "channel" => "Code step by step"];
});

<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', function (){
    $ninjas = [
        ["name" => "Furina", "skill" => 75, "id" => "1"],
        ["name" => "Navia", "skill" => 70, "id" => "2"]
    ];

    return view('index.index', ["greeting" => "Hello!", "ninjas" => $ninjas]);
});

Route::get('/index/create', function () {
    return view('index.create');
});

Route::get('/index/{id}', function ($id){

    return view('index.show', ["id" => $id]);
});
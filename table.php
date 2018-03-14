<?php
require __Dir__.'/vendor/autoload.php';
use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->create('area22', function ($table) {
    $table->increments('id');
    $table->string('areaName')->unique();
    $table->timestamps();
});
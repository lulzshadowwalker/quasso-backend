<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('landing.index'));

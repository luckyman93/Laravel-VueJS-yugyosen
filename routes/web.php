<?php

use Illuminate\Support\Facades\Route;

Route::get('/boat/{prefectureParam}', function ($prefectureParam) {
    return view('boatlist', compact('prefectureParam'));
})->name('boatlist');

Route::get('/boat/{prefectureParam}/{cityParam}', function ($prefectureParam, $cityParam) {
    return view('boatlist', compact('prefectureParam', 'cityParam'));
})->name('boatlist');

Route::get('/boat/{prefectureParam}/{cityParam}/{param}', function ($prefectureParam, $cityParam, $param) {
    if (substr($param, 0, 1) == 'p') {
        return view('boatlist', compact('prefectureParam', 'cityParam', 'param'));
    } else {
        return view('boatdetail', compact('prefectureParam', 'cityParam', 'param'));
    }
})->name('boatlist', 'boatdetail');

// Route::get('/boat/{prefectureParam}/{cityParam}/{portParam}/{boatParam}', function ($prefectureParam, $cityParam, $portParam, $boatParam) {
//     return view('boatdetail', compact('prefectureParam', 'cityParam', 'portParam', 'boatParam'));
// })->name('boatdetail');

Route::get('/{any?}', function () {
    return view('index');
})->where('any', '.+');

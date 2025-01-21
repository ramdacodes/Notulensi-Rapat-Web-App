<?php

use App\Http\Controllers\PdfController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->to('/information');
});

Route::get('download-pdf/{id}', [PdfController::class, 'download'])->name('download.pdf');

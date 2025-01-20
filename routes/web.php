<?php

use App\Http\Controllers\AgendaController;
use App\Http\Controllers\PdfController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->to('/information');
});

Route::get('generate-pdf/{id}', [PdfController::class, 'generatePDF'])->name('generate.pdf');


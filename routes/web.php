<?php

use App\Http\Controllers\AgendaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->to('/information');
});

Route::prefix('agenda')->group(function () {
    Route::get('generate-pdf/{id}', [AgendaController::class, 'generatePDF'])->name('agenda.generate.pdf');
    Route::get('presence/{id}', [AgendaController::class, 'presence'])->name('agenda.presence');
});


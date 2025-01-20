<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    public function generatePDF($id) {
        $agendaId = decrypt($id);

        $agenda = Agenda::findOrFail($agendaId);

        if ($agenda) {
            $pdf = Pdf::loadView('template.pdf-agenda', ['data' => $agenda]);

            $filename = "MEETING_INVITATION_" . strtoupper($agenda->name) . "_" . date('Y-m-d') . ".pdf";

            return $pdf->download($filename);
        } else {
            return abort(404);
        }
    }
}

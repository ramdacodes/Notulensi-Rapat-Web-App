<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    public function generatePDF($id) {
        return 'SIP';
    }

    public function presence($id) {
        $agendaId = decrypt($id);

        $agenda = Agenda::findOrFail($agendaId);

        if ($agenda) {
            return view('presence');
        } else {
            return abort(404);
        }
    }
}

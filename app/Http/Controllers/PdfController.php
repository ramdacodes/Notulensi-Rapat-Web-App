<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Carbon\Carbon;
use Codedge\Fpdf\Fpdf\Fpdf;

class PdfController extends Controller
{
    public function download($id)
    {
        $agendaId = decrypt($id);

        $agenda = Agenda::findOrFail($agendaId);

        if ($agenda) {
            $pdf = new Fpdf;
            $pdf->AddPage();
            $pdf->SetFont('Arial', 'B', 12);

            $pdf->Image(public_path('images/usb-logo.png'), 10, 10, 30);

            $pdf->SetFont('Arial', '', 12);
            $pdf->SetTextColor(0, 0, 139);
            $pdf->Cell(0, 5, 'Yayasan Pendidikan Keuangan dan Perbankan', 0, 1, 'C');

            $pdf->SetFont('Arial', 'B', 22);
            $pdf->SetTextColor(194, 8, 8);
            $pdf->Cell(0, 10, 'UNIVERSITAS SANGGA BUANA', 0, 1, 'C');

            $pdf->SetFont('Arial', '', 11);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(0, 5, 'Jl. PHH. Mustofa No.68 Kota Bandung 40124', 0, 1, 'C');

            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(0, 5, 'Website: www.usbypkp.ac.id, Email: info@usbypkp.ac.id', 0, 1, 'C');
            $pdf->Cell(0, 5, 'Telp: 022-7275489, Fax: 022-7201756', 0, 1, 'C');

            $pdf->SetLineWidth(1);
            $pdf->Line(10, 45, 200, 45);
            $pdf->Ln(7);

            $agenda_id_padded = str_pad($agendaId, 3, '0', STR_PAD_LEFT);
            $date = date('Y');
            $month = date('m');
            $nomorSurat = "AGR/{$agenda_id_padded}/USB-YPKP/{$month}/{$date}";

            $pdf->SetFont('Arial', '', 11);

            $labelWidth = 40;

            $pdf->Cell($labelWidth, 10, 'Nomor', 0, 0, 'L');
            $pdf->Cell(0, 10, ": $nomorSurat", 0, 1, 'L');

            $pdf->Cell($labelWidth, 5, 'Lampiran', 0, 0, 'L');
            $pdf->Cell(0, 5, ': -', 0, 1, 'L');

            $pdf->Cell($labelWidth, 10, 'Perihal', 0, 0, 'L');
            $pdf->SetFont('Arial', 'B', 11);
            $pdf->Cell(0, 10, ': Undangan Agenda Rapat', 0, 1, 'L');

            $pdf->Ln(5);

            $pdf->SetFont('Arial', '', 11);
            $pdf->Cell(0, 5, 'Kepada Yth.', 0, 1, 'L');
            $pdf->SetFont('Arial', 'B', 11);

            foreach ($agenda->participants as $index => $participant) {
                $height = ($index % 2 == 0) ? 10 : 5;

                $pdf->Cell(10);

                $pdf->Cell(0, $height, ($index + 1).'. '.$participant, 0, 1, 'L');
            }
            $pdf->Ln(2);
            $pdf->SetFont('Arial', '', 11);
            $pdf->Cell(0, 3, 'di', 0, 1, 'L');
            $pdf->Cell(0, 10, 'Tempat', 0, 1, 'L');
            $pdf->Ln(4);
            $pdf->MultiCell(0, 5, 'Dengan hormat,

            Sehubungan dengan pelaksanaan kegiatan Universitas Sangga Buana, kami bermaksud mengundang Bapak/Ibu atau Saudara/Saudari untuk menghadiri rapat yang akan diselenggarakan sesuai dengan jadwal yang telah ditentukan. Rapat ini bertujuan untuk mendiskusikan agenda terkait program dan kebijakan strategis yang akan dilaksanakan oleh Universitas.

            Adapun detail rapat yang dimaksud adalah sebagai berikut:', 0, 'L');

            $agendaDate = $agenda->date;
            Carbon::setLocale('id');
            $formattedDate = Carbon::parse($agendaDate)->translatedFormat('l, d F Y');

            $agendaLocation = $agenda->location;

            $rundowns = $agenda->rundowns;

            foreach ($rundowns as $key => $rundown) {
                $rundowns[$key]['start_time'] = Carbon::parse($rundown['start_time']);
                $rundowns[$key]['end_time'] = Carbon::parse($rundown['end_time']);
            }

            usort($rundowns, function ($a, $b) {
                return $a['start_time']->greaterThan($b['start_time']);
            });

            $startTime = $rundowns[0]['start_time']->format('H:i');
            $endTime = end($rundowns)['end_time']->format('H:i');

            $pdf->Cell(20);
            $pdf->Cell(50, 10, 'Hari/Tanggal', 0, 0, 'L');
            $pdf->Cell(0, 10, ": $formattedDate", 0, 1, 'L');
            $pdf->Cell(20);
            $pdf->Cell(50, 5, 'Waktu', 0, 0, 'L');
            $pdf->Cell(0, 5, ": $startTime - $endTime WIB", 0, 1, 'L');
            $pdf->Cell(20);
            $pdf->Cell(50, 10, 'Tempat', 0, 0, 'L');
            $pdf->MultiCell(0, 10, ": $agendaLocation", 0, 'L');

            $pdf->Ln(5);
            $pdf->MultiCell(0, 5, 'Demikian informasi ini kami sampaikan. Besar harapan kami agar Bapak/Ibu/Saudara/Saudari dapat hadir dan berpartisipasi dalam rapat ini. Kehadiran dan partisipasi aktif dari pihak Bapak/Ibu/Saudara/Saudari sangat kami harapkan untuk kesuksesan program ini. Atas perhatian dan kerjasamanya, kami ucapkan terima kasih.', 0, 'L');

            $agendaCreatedAt = $agenda->created_at;
            Carbon::setLocale('id');
            $formattedCreatedAt = Carbon::parse($agendaCreatedAt)->translatedFormat('d F Y');

            $pdf->Ln(5);
            $pdf->Cell(0, 10, "Bandung, $formattedCreatedAt", 0, 1, 'R');

            $inviterName = $agenda->inviter_name;
            $inviterPosition = $agenda->inviter_position;

            $pdf->Ln(20);
            $pdf->Cell(0, 5, $inviterName, 0, 1, 'R');
            $pdf->Cell(0, 5, $inviterPosition, 0, 1, 'R');

            $pdf->Output('D', 'MEETING_INVITATION_'.strtoupper($agenda->name).'_'.date('Y-m-d').'.pdf');
        } else {
            return abort(404);
        }
    }
}

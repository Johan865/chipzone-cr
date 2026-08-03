<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\SalesReportService;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function __construct(private SalesReportService $reports)
    {
    }

    public function index()
    {
        return view('admin.reports.index', [
            'byMonth' => $this->reports->salesByMonth(),
            'byClient' => $this->reports->salesByClient(),
        ]);
    }

    public function salesByMonthPdf()
    {
        $pdf = Pdf::loadView('admin.reports.pdf-month', [
            'data' => $this->reports->salesByMonth(),
        ]);

        return $pdf->download('reporte-ventas-por-mes.pdf');
    }

    public function salesByClientPdf()
    {
        $pdf = Pdf::loadView('admin.reports.pdf-client', [
            'data' => $this->reports->salesByClient(),
        ]);

        return $pdf->download('reporte-ventas-por-cliente.pdf');
    }
}

<?php

namespace App\Exports;

use App\Models\FinancialReport;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class FinancialReportExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $data = FinancialReport::orderBy('date', 'desc')->get();

        return view('exports.financial-report', compact('data'));
    }
}

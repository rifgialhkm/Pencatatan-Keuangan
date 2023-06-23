<?php

namespace App\Http\Controllers;

use App\Exports\FinancialReportExport;
use App\Models\Category;
use App\Models\FinancialReport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class FinancialReportController extends Controller
{
    public function index(Request $request)
    {
        $data = FinancialReport::orderBy('date', 'desc')->paginate(10);
        $income = FinancialReport::where('type', 'Pemasukan')->sum('amount');
        $expenditure = FinancialReport::where('type', 'Pengeluaran')->sum('amount');

        if ($request->has('type')) {
            $data = FinancialReport::where('type', $request->get('type'))->orderBy('date', 'desc')->paginate(10);

            return view('financial-report.tbody', compact('data'));
        }

        return view('financial-report.index', compact('data', 'income', 'expenditure'));
    }

    public function create()
    {
        $incomeCategory = Category::where('type', 'Pemasukan')->get();
        $expenditureCategory = Category::where('type', 'Pengeluaran')->get();

        return view('financial-report.create', compact('incomeCategory', 'expenditureCategory'));
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'date' => 'required',
            'amount' => 'required',
            'type' => 'required',
            'category_id' => 'required'
        ]);

        FinancialReport::create($validate + [
            'description' => $request->description
        ]);

        return redirect()->route('financial-report.index')->with('success', 'Data berhasil disimpan!');
    }

    public function edit($id)
    {
        $data = FinancialReport::findOrFail($id);
        $category = Category::where('type', $data->type)->get();

        return view('financial-report.edit', compact('data', 'category'));
    }

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'date' => 'required',
            'amount' => 'required',
            'type' => 'required',
            'category_id' => 'required'
        ]);

        $data = FinancialReport::findOrFail($id);

        $data->update($validate + [
            'description' => $request->description
        ]);

        return redirect()->route('financial-report.index')->with('success', 'Data berhasil diubah!');
    }

    public function destroy($id)
    {
        FinancialReport::findOrFail($id)->delete();

        return back()->with('success', 'Data berhasil dihapus!');
    }

    public function export()
    {
        $tanggal = date('d-m-Y', strtotime(now()));

        return Excel::download(new FinancialReportExport(), 'catatan_'.$tanggal.'.xlsx');
    }
}

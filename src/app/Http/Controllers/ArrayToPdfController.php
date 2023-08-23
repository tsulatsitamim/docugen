<?php

namespace App\Http\Controllers;

use App\Exports\GenericExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class ArrayToPdfController extends Controller
{
    public function __invoke(Request $request)
    {
        $items = $request->data;

        $columns = collect($items)->max(fn ($array) => count($array));

        $pdf = Pdf::loadview('exports.generic', [
            'items' => $items,
            'columns' => $columns
        ])->setPaper('a3', 'landscape')->setWarnings(false);

        return $pdf->download('Export.pdf');
    }
}

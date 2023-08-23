<?php

namespace App\Http\Controllers;

use App\Exports\GenericExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ArrayToExelController extends Controller
{
    public function __invoke(Request $request)
    {
        $items = $request->data;
        return Excel::download(new GenericExport($items), $request->filename ?? 'Export.xlsx');
    }
}

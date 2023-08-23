<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class GenericExport implements FromView, ShouldAutoSize
{
    public $items;

    public function __construct($items)
    {
        $this->items = $items;
    }

    public function view(): View
    {
        $columns = collect($this->items)->max(fn ($array) => count($array));

        return view('exports.generic', [
            'items' => $this->items,
            'columns' => $columns
        ]);
    }
}

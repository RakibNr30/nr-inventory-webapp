<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromView;
use \Illuminate\Contracts\View\View;

class ResultExport implements FromView
{
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function view(): View
    {
        $results = User::all();
        return view('cms::result.show', compact(
            'results'
        ));
    }
}

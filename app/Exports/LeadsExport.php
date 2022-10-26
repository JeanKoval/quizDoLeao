<?php

namespace App\Exports;

use App\Models\Lead;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;

class LeadsExport implements FromView, WithTitle
{
    public function view(): View
    {
        return view('exports.lead', [
            'leads' => Lead::all()
        ]);
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Leads';
    }
}
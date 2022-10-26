<?php

namespace App\Http\Controllers;

class LeadController extends Controller
{
    public function export(){;
        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\LeadsExport, 'leads_'.date("Y-m-d_H-i-s").'.xlsx');
    }
}

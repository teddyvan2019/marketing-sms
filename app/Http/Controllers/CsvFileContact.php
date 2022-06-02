<?php

namespace App\Http\Controllers;
use PDF;

use Illuminate\Http\Request;
use App\Imports\CsvImport;
use App\Exports\CsvExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Contact;

class CsvFileContact extends Controller
{
    //

    public function csv_export()
    {
    	return Excel::download(new CsvExport, 'contact.csv');
    }

    public function cvss_import()
    {
    	Excel::import(new CsvImport, request()->file('fichier'));
    	return back();

    }

   
}

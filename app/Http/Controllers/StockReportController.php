<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use PDF;

class StockReportController extends Controller
{
    public function generateReport()
    {
        $products = Product::all();
        $pdf = PDF::loadView('stocks.report', ['products' => $products]);
        
        return $pdf->stream('stocks_report.pdf'); // Stream the PDF for preview instead of download
    }
    
}


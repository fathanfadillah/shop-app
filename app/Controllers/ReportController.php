<?php

namespace App\Controllers;
use App\Models\Product;

class ReportController extends BaseController
{
    public function index()
    {

        $product = new Product();
        
        $reports = $product->findAll();

        $data = [
            'reports' => $reports
        ];

        return view('report/index', $data);
    }
}

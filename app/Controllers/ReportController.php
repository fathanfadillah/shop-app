<?php

namespace App\Controllers;
use App\Models\ReportProduct;
use App\Models\ProductBrand;
use App\Models\StoreArea;

class ReportController extends BaseController
{
    public function index()
    {

        $reportProduct = new ReportProduct;
        $averageCompliances = $reportProduct->getAverageCompliance()->getResult();
        $averageProducts = $reportProduct->getAverageProducts()->getResult();

        $averageProductsPerArea = [];        
        foreach ($averageProducts as $product) {
            $averageProductsPerArea[$product->brand][] = $product;
        }

        $productBrand = new ProductBrand;
        $brandQuery = $productBrand->findAll();
    
        $storeArea = new StoreArea;
        $areaQuery = $storeArea->findAll(); 
        
        $data = [
            'averageCompliances' => $averageCompliances,
            'averageProductsPerArea' => $averageProductsPerArea,
            'brandQuery' => $brandQuery,
            'areaQuery' => $areaQuery
        ];

        return view('report/index', $data);
    }

    public function filter() 
    {
        $request = $this->request->getVar();
        
        $reportProduct = new ReportProduct;
        $averageCompliances = $reportProduct->getAverageComplianceFilter($request)->getResult();
        $averageProducts = $reportProduct->getAverageProductsFilter($request)->getResult();
        
        $averageProductsPerArea = [];        
        foreach ($averageProducts as $product) {
            $averageProductsPerArea[$product->brand][] = $product;
        }

        $productBrand = new ProductBrand;
        $brandQuery = $productBrand->findAll();
    
        $storeArea = new StoreArea;
        $areaQuery = $storeArea->findAll(); 
        
        $data = [
            'averageCompliances' => $averageCompliances,
            'averageProductsPerArea' => $averageProductsPerArea,
            'brandQuery' => $brandQuery,
            'areaQuery' => $areaQuery
        ];

        return view('report/index', $data);
    }

}

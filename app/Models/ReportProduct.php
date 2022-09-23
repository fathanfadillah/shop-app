<?php

namespace App\Models;

use CodeIgniter\Model;

class ReportProduct extends Model
{
    protected $table = 'report_product';
    protected $useTimestamps = true;

    public function getAverageCompliance() {
        $sql = "select store.store_id as store_id,
                        store.store_name as store_name, 
                        store_area.area_name as store_area, 
                        avg(compliance) * 100 as compliance 
                from report_product
                join store
                on report_product.store_id = store.store_id
                join store_area
                on store_area.area_id = store.area_id
                group by store.area_id";
        
        return $this->db->query($sql);
    }

    public function getAverageProducts() {
        $sql = "select product.product_id as product_id, 
                    product_brand.brand_name as brand, 
                    store.store_id as store_id, 
                    store_area.area_name as store_area,
                    avg(compliance) * 100 as compliance 
                from report_product
                join product
                on report_product.product_id = product.product_id
                join product_brand
                on product.brand_id = product_brand.brand_id
                join store
                on report_product.store_id = store.store_id
                join store_area
                on store_area.area_id = store.area_id
                group by product.brand_id, store.area_id";

        return $this->db->query($sql);        
    }

    public function getAverageComplianceFilter($filter) {
        $dateFrom = $filter['dateFrom'];
        $dateTo = $filter['dateTo'];
        $area = $filter['area'];

        if ($filter['area'] === "") {
            $sql = "select store.store_id as store_id,
                        store_area.area_name as store_area, 
                        avg(compliance) * 100 as compliance 
                    from report_product
                    join store
                    on report_product.store_id = store.store_id
                    join store_area
                    on store_area.area_id = store.area_id
                    where report_product.tanggal between '$dateFrom'
                    and '$dateTo' 
                    group by store.area_id"; 
        
            return $this->db->query($sql);    
        }
        
        $sql = "select store.store_id as store_id,
                    store_area.area_name as store_area, 
                    avg(compliance) * 100 as compliance 
                from report_product
                join store
                on report_product.store_id = store.store_id
                join store_area
                on store_area.area_id = store.area_id
                where (store.area_id = $area) and (report_product.tanggal between '$dateFrom'
                and '$dateTo') 
                group by store.area_id"; 
        
        return $this->db->query($sql);
    }

    public function getAverageProductsFilter($filter) {
        $dateFrom = $filter['dateFrom'];
        $dateTo = $filter['dateTo'];
        $area = $filter['area'];

        if ($filter['area'] === "") {
            $sql = "select product.product_id as product_id, 
                        product_brand.brand_name as brand, 
                        store.store_id as store_id, 
                        store_area.area_name as store_area,
                        avg(compliance) * 100 as compliance 
                    from report_product
                    join product
                    on report_product.product_id = product.product_id
                    join product_brand
                    on product.brand_id = product_brand.brand_id
                    join store
                    on report_product.store_id = store.store_id
                    join store_area
                    on store_area.area_id = store.area_id
                    where report_product.tanggal between '$dateFrom'
                    and '$dateTo'
                    group by product.brand_id, store.area_id"; 
        
            return $this->db->query($sql);
        }
        
        $sql = "select product.product_id as product_id, 
                    product_brand.brand_name as brand, 
                    store.store_id as store_id, 
                    store_area.area_name as store_area,
                    avg(compliance) * 100 as compliance 
                from report_product
                join product
                on report_product.product_id = product.product_id
                join product_brand
                on product.brand_id = product_brand.brand_id
                join store
                on report_product.store_id = store.store_id
                join store_area
                on store_area.area_id = store.area_id
                where (store.area_id = $area) and report_product.tanggal between '$dateFrom'
                and '$dateTo'
                group by product.brand_id, store.area_id"; 
        
        return $this->db->query($sql);
    }    
}
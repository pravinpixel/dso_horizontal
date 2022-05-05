<?php

if(! function_exists('category_type')) {
    function category_type() {
        return session()->get('category_type');
    }
}

if(! function_exists('in_house_type')) {
    function in_house_type() {
        return category_type() == "material" ? 'disabled' : null ;
    }
}

if(! function_exists('entry_id')) {
    function entry_id() {
        return session()->get('material_product_id');
    }
}

if(! function_exists('material_product')) {
    function material_product() {
        return session()->get('material_product_id');
    }
} 

if(! function_exists('batch_id')) {
    function batch_id() {
        return session()->get('batch_id');
    }
} 
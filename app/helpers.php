<?php

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\Storage;

if(! function_exists('category_type')) {
    function category_type() {
        return session()->get('category_type');
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

if(! function_exists('wizard_mode')) {
    function wizard_mode() {
        return session()->get('wizard_mode');
    }
}

if(! function_exists('forget_session')) {
    function forget_session() {
        return session()->forget([
            'wizard_mode',
            'batch_id',
            'material_product_id',
            'form-one',
            'form-two',
            'form-three',
            'form-four',
            'category_type'
        ]);
    }
}
if(! function_exists('is_select')) {
    function is_select() {

        if(wizard_mode() == 'create') {
            $status  = 'selected';
        }
  
        return $status ?? null;
    }
}

if(! function_exists('is_disable')) {
    function is_disable($category_type) {
        return "is_disable".".".wizard_mode().".".$category_type."." ;
    }
}
 
 
if(! function_exists('completed_tab')) {
    function completed_tab($type) {
        if(session()->get($type)  ==  'completed') {
            return route('create.material-product',['type'=>$type]);
        } 
        else {
            return "#";
        }
    }
}

if(! function_exists('auth_user')) {
    function auth_user() {
        return Sentinel::getUser();
    }
}
if(! function_exists('storageGet')) {
    function storageGet($src) {
        if (Storage::exists($src)) { 
            $file = asset(str_replace('public', 'public/storage/',$src)) ;
        } else {
            $file =  $src ;
        }
        return $file;
    }
}

if(! function_exists('is_reset')) {
    function is_reset($column, $value, $category_type) {
        $wizard_mode    = wizard_mode();
        $reset_status   = config("is_disable.{$wizard_mode}.{$category_type}.{$column}.reset");
        return $reset_status !== true ? $value :  null ;
    }
}
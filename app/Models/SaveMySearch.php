<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaveMySearch extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'search_title', 
        'batch',              
        'cas',                
        'date_of_expiry',     
        'date_of_manufacture',
        'date_of_shipment',   
        'disposed',           
        'euc_material',       
        'extended_expiry',    
        'extended_qc_status', 
        'housing_number',     
        'housing_type',       
        'iqc_status',         
        'logsheet_id',        
        'po_number',          
        'product_type',       
        'project_name',       
        'serial',             
        'statutory_board',    
        'supplier',           
        'unit_pkt_size',      
    ];
}

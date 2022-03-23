<?php

namespace App\Repositories;

use App\Interfaces\MasterRepositoryInterface ;
use App\Models\Order;
use App\Models\Masters\MasterCategories;
use App\Models\Masters\StatutoryBody;
use App\Models\Masters\PackingSizeData;
use App\Models\Masters\StorageRoom;
use App\Models\Masters\Departments;
use App\Models\Masters\HouseTypes; 


class MasterRepository implements MasterRepositoryInterface {
    public function storeMaster($value, $type)
    {
        if($type == 'category_section') {
            
            return  MasterCategories::create([
                'name' => $value
            ]);

        } elseif($type == 'statutory_section') {

            return  StatutoryBody::create([
                'name' => $value
            ]);
        }elseif($type == 'packing_size_section') {

            return  PackingSizeData::create([
                'name' => $value
            ]);
        }
        elseif($type == 'storage_room') {
            return  StorageRoom::create([
                'name' => $value
            ]);
        }
        elseif($type == 'departments') {
            return  Departments::create([
                'name' => $value
            ]);
        }
        elseif($type == 'house_types') {
            return  HouseTypes::create([
                'name' => $value
            ]);
        }
    }

    public function editMaster($id, $type)
    {
         
        if($type == 'category_section') {
            return  MasterCategories::findOrFail($id);
        } 
        elseif($type == 'statutory_section') {
            return  StatutoryBody::findOrFail($id);
        }
        elseif($type == 'packing_size_section') {
            return  PackingSizeData::findOrFail($id);
        }
        elseif($type == 'storage_room') {
            return  StorageRoom::findOrFail($id);
        }
        elseif($type == 'departments') {
            return  Departments::findOrFail($id);
        }
        elseif($type == 'house_types') {
            return  HouseTypes::findOrFail($id);
        }
    }

    public function updateMaster($value, $type)
    {
        if($type == 'category_section') {
            return  MasterCategories::find($value->id)->update([
                'name' => $value->name
            ]);
        } elseif($type == 'statutory_section') {
            return  StatutoryBody::find($value->id)->update([
                'name' => $value->name
            ]);
        }elseif($type == 'packing_size_section') {
            return  PackingSizeData::find($value->id)->update([
                'name' => $value->name
            ]);
        }
        elseif($type == 'storage_room') {
            return  StorageRoom::find($value->id)->update([
                'name' => $value->name
            ]);
        }
        elseif($type == 'departments') {
            return  Departments::find($value->id)->update([
                'name' => $value->name
            ]);
        }
        elseif($type == 'house_types') {
            return  HouseTypes::find($value->id)->update([
                'name' => $value->name
            ]);
        }
    }

    public function deleteMaster($id, $type)
    {
         
        if($type == 'category_section') {

            return  MasterCategories::findOrFail($id)->delete();

        } elseif($type == 'statutory_section') {

            return  StatutoryBody::findOrFail($id)->delete();

        }elseif($type == 'packing_size_section') {
            
            return  PackingSizeData::find($id)->delete();
        }
        elseif($type == 'storage_room') {
            return  StorageRoom::find($id)->delete();
        }
        elseif($type == 'departments') {
            return  Departments::find($id)->delete();
        }
        elseif($type == 'house_types') {
            return  HouseTypes::find($id)->delete();
        }
    }
}
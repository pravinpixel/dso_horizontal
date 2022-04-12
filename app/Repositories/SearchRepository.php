<?php

namespace App\Repositories;

use App\Interfaces\SearchRepositoryInterface;
use App\Models\MaterialProducts;
  
class SearchRepository implements SearchRepositoryInterface {
    public function bulkSearch($row)
    {
        return MaterialProducts::where('is_draft', 0)
                                ->when($row->category_selection, function ($q) use ($row) {
                                    $q->where('category_selection' , $row->category_selection  ?? null);
                                })
                                ->when($row->item_description, function ($q) use ($row)  {
                                    $q->where('item_description', 'LIKE', '%' . $row->item_description ?? null .'%');
                                })
                                ->when($row->brand, function ($q) use ($row)  {
                                    $q->where('brand' , $row->brand  ?? null);
                                })
                                ->when($row->dept, function ($q) use ($row)  {
                                    $q->where('department' , $row->dept  ?? null);
                                })
                                ->when($row->storage_area, function ($q) use ($row)  {
                                    $q->where('storage_room' , $row->storage_area  ?? null);
                                })
                                ->when($row->date_in, function ($q) use ($row)  {
                                    $q->where('date_in' , $row->date_in  ?? null);
                                })
                                ->paginate(4);
    }
}
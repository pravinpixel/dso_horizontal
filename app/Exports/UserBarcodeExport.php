<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Picqer\Barcode\BarcodeGeneratorPNG;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
class UserBarcodeExport  implements FromArray, WithDrawings, WithEvents
{
    // public function styles(Worksheet $sheet)
    // { 
    //     return [
    //         1    => ['font' => ['bold' => true]],
    //     ];
    // }
    public function drawings() {
        $staffs            = User::all();
        $barcodeCollection = [];
        foreach ($staffs as $key => $user) {
            $filename = $user->email.$user->alias_name.'.jpg';
            if(Storage::exists($filename)) {
                Storage::delete($filename); 
            }
            $generatorPNG = new BarcodeGeneratorPNG;
            \Image::make(base64_encode($generatorPNG->getBarcode($user->email, $generatorPNG::TYPE_CODE_128)))->save(storage_path('app/').$filename);
            $barcodeCollection[] = $filename;
        }
        $drawingCollection =[];
        foreach ($barcodeCollection as $key => $code) {
            $col = "D".($key+1);
            $drawingCollection[] = $drawing =new Drawing();
            $drawing->setName('Logo');
            $drawing->setDescription('This is my logo');
            $drawing->setPath(storage_path('app')."/".$code);
            $drawing->setHeight(50);
            $drawing->setCoordinates($col);
        }
        return $drawingCollection;
    }
    public function array():array
    {
        $staffs = User::all();
        $staffCollection = [];

        foreach ($staffs as $key => $value) {
            $staffCollection[] = [
                "no" => $key+1,
                "alias_name" => $value->alias_name,
                "email" => (string) $value->email,
            ];
        }

        return  $staffCollection;
    }
    
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                // $event->sheet->getDelegate()->getRowDimension('1')->setRowHeight(10);
                $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(20);
                $event->sheet->getDelegate()->getColumnDimension('B')->setWidth(20);
                $event->sheet->getDelegate()->getColumnDimension('C')->setWidth(20);
                $event->sheet->getDelegate()->getColumnDimension('D')->setWidth(40); 

                foreach (User::all() as $key => $value) {
                    $event->sheet->getDelegate()->getRowDimension($key+1)->setRowHeight(40);
                }
            },
        ];
    }
}
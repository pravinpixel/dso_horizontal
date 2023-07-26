<?php

namespace App\Exports;

use App\Models\RepackOutlife;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RepackOutlifeExport implements FromCollection, WithHeadings, WithStyles, WithEvents
{
    public $id;
    public function __construct($id)
    {
        $this->id = $id;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true]],
        ];
    }
    public function collection()
    {
        securityLog('Repack Outlife Export');
        return RepackOutlife::where('batch_id', $this->id)->select([
            'draw_in_time_stamp',
            'draw_out_time_stamp',
            'input_repack_amount',
            'remain_days',
            'qty_cut'
        ])->get();
    }
    public function headings(): array
    {
        return [
            'Date Draw In',
            'Date Draw Out',
            'Input Repack Amount',
            'Remaining Out Life',
            'Quantity Cut'
        ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class   => function(AfterSheet $event) {
                $event->sheet->getDelegate()->getRowDimension('1')->setRowHeight(20);
                $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(30);
                $event->sheet->getDelegate()->getColumnDimension('B')->setWidth(30);
                $event->sheet->getDelegate()->getColumnDimension('C')->setWidth(40);
                $event->sheet->getDelegate()->getColumnDimension('D')->setWidth(20);
                $event->sheet->getDelegate()->getColumnDimension('E')->setWidth(20);
            },
        ];
    }
}
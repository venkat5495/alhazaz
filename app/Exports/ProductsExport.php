<?php

namespace App\Exports;

use App\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use \Maatwebsite\Excel\Sheet;

class ProductsExport implements FromQuery, WithHeadings
{
	use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct($search)
    {
        $this->search = $search;

    }
    // public function collection()
    // {
    //     return Product::select('name','ar_name','video_provider','video_link','description','ar_description','unit_price','purchase_price','quantity','globle_sku','local_sku','meta_title','meta_description')->get();
    // }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $event->sheet->setWidth(array(
                    'A'     =>  5,
                    'B'     =>  30
                ));                
                $event->sheet->styleCells(
                    'A1:M1',
                    [
                        'borders' => [
                            'outline' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                                'color' => ['argb' => 'FFFF0000'],
                            ],
                        ]
                    ]
                );
            },
        ];
    }

    

	

    public function headings(): array
    {
        return [
            'Name',
            'Arabic Name',
            'Video Provider',
            'Video Link',
            'Description',
            'Arabic Description',
            'Unit Price',
            'Purchase Price',
            'Quantity',
            'Globle SKU',
            'Local SKU',
            'Meta Title',
            'Meta Description',
        ];
    }

    public function query()
    {
    	$products = new Product();
    	$products = $products->query();
    	if (!empty($this->search)) {
            $search = $this->search;

            $products = $products->where('name','like', '%'.$search.'%')->orWhere('ar_name','like', '%' .$search.'%');
            if(is_numeric($search)){
                $products = $products->orWhere('unit_price',$search);
            }
        }
        return $products->select('name','ar_name','video_provider','video_link','description','ar_description','unit_price','purchase_price','quantity','globle_sku','local_sku','meta_title','meta_description');
    }

    
}

<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use App\Visit;
use DB;

class MerchandiserReport implements FromCollection, WithHeadings, ShouldAutoSize, WithMapping
{
    protected $area;

    public function __construct($area=NULL)
    {
        $this->area = $area;
    }


    public function collection()
    {

        $sql = "SELECT a.*, b.`name` AS area_name, b.pic FROM merchandisers a LEFT JOIN areas b ON b.id = a.area_id";

        // filter by area
        if($this->area!=NULL){
            $sql = $sql." WHERE a.area_id='$this->area'";
        }

        $query = "($sql) x";

        $raw = DB::table(DB::raw($query))->orderBy('identity_id','ASC')->get();
        return $raw;
        
    }

    public function map($raw): array
    {
        return [
            $raw->identity_id,
            $raw->name,
            $raw->email,
            $raw->phone_number,
            $raw->gender,
            $raw->area_name,
            $raw->pic,
            $raw->address
        ];
    }

    public function columnFormats(): array
    {
        return [
            'D' => NumberFormat::FORMAT_TEXT,
        ];
    }


    public function headings(): array {
        return [
            'Kode MD',
            'Nama MD',
            'Email',
            'No. Handphone',
            'Jenis Kelamin',
            'Area',
            "PIC",
            'Alamat'
        ];
    }
}
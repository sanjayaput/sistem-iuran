<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use App\Visit;
use DB;

class OutletReport implements FromCollection, WithHeadings, ShouldAutoSize, WithMapping
{
    protected $channel;

    public function __construct($channel=NULL)
    {
        $this->channel = $channel;
    }


    public function collection()
    {

        $sql = "SELECT a.code, a.name, a.branch, a.phone, a.address, a.latitude, a.longitude, d.identity_id, 
                       d.name AS md_name, b.name AS channel_name, a.channel_id, c.`name` AS city 
                FROM outlets a 
                LEFT JOIN channels b ON b.id = a.channel_id
                LEFT JOIN cities c ON c.id = a.city_id
                LEFT JOIN merchandisers d ON d.id = a.merchandiser_id";

        // filter by channel
        if($this->channel!=NULL){
            $sql = $sql." WHERE a.channel_id='$this->channel'";
        }

        $query = "($sql) x";

        $raw = DB::table(DB::raw($query))->orderBy('channel_id','ASC')->get();
        return $raw;
        
    }

    public function map($raw): array
    {
        return [
            $raw->code,
            $raw->name,
            $raw->channel_name,
            $raw->branch,
            $raw->city,
            $raw->phone,
            $raw->identity_id,
            $raw->md_name,
            $raw->address,
            $raw->latitude,
            $raw->longitude
        ];
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_TEXT,
            'F' => NumberFormat::FORMAT_TEXT,
            'G' => NumberFormat::FORMAT_TEXT,
            'J' => NumberFormat::FORMAT_TEXT,
            'K' => NumberFormat::FORMAT_TEXT,
        ];
    }


    public function headings(): array {
        return [
            'Kode Outlet',
            'Nama Outlet',
            'Channel',
            'Cabang / DC',
            'Kota',
            'No. Telepon',
            'Kode MD',
            'Nama MD',
            'Alamat',
            'Latitude',
            'Longitude'
        ];
    }
}
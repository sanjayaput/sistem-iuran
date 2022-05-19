<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use App\Visit;
use DB;

class VisitReport implements FromCollection, WithHeadings, ShouldAutoSize, WithMapping
{
    protected $start_date;
    protected $end_date;
    protected $area;
    protected $channel;
    protected $merchandiser;

    public function __construct($start_date=NULL, $end_date=NULL, $area=NULL, $channel=NULL, $merchandiser=NULL)
    {
        $this->start_date   = $start_date;
        $this->end_date     = $end_date;
        $this->area         = $area;
        $this->channel      = $channel;
        $this->merchandiser = $merchandiser;
    }


    public function collection()
    {
        $this->start_date ==NULL ? date('Y-m-d') : $this->start_date;
        $this->end_date ==NULL ? date('Y-m-d') : $this->end_date;

        $sql = "SELECT b.identity_id, b.`name`, e.pic, c.`code` AS outlet_code, d.`name` AS channel_name,
                       c.`name` AS outlet_name, a.visit_date, a.visit_in, a.`desc`, e.`name` AS area_name, a.created_at
                FROM visits a 
                LEFT JOIN merchandisers b ON b.id = a.merchandiser_id
                LEFT JOIN outlets c ON c.id = a.outlet_id
                LEFT JOIN channels d ON d.id = c.channel_id
                LEFT JOIN areas e ON e.id = b.area_id
                WHERE a.visit_date BETWEEN '$this->start_date' AND '$this->end_date'";

        // filter by area / channel / merchandiser
        if($this->area!=NULL){
            $sql = $sql." AND e.id='$this->area'";
        }
        if($this->channel!=NULL){
            $sql = $sql." AND d.id='$this->channel'";
        }
        if($this->merchandiser!=NULL){
            $sql = $sql." AND b.id='$this->merchandiser'";
        }

        $query = "($sql) x";

        $raw = DB::table(DB::raw($query))->orderBy('created_at','DESC')->get();
        return $raw;
        
    }

    public function map($raw): array
    {
        return [
            $raw->identity_id,
            $raw->name,
            $raw->pic,
            $raw->outlet_code,
            $raw->outlet_name,
            $raw->channel_name,
            $raw->area_name,
            $raw->visit_date,
            $raw->visit_in,
            $raw->desc,
        ];
    }


    public function headings(): array {
        return [
            'Kode MD',
            'Nama MD',
            'Nama PIC',
            'Kode Toko',
            'Nama Toko',
            'Channel',
            'Area',
            "Tanggal",
            "Jam Checkin",
            "Catatan"
        ];
    }
}
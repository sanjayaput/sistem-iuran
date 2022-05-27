<?php

use App\ProfilDesa;

/**
 * Get the message array structure.
 *
 * @param  string $message
 * @param  boolean $success
 * @param  int $status
 *
 * @return \Illuminate\Http\JsonResponse
 */
function respondWithMessage($message, $success, $status)
{
    return response()->json([
        'success' => $success,
        'status'  => $status,
        'message' => $message,
    ], $status);
}

/**
 * Get the data json structure.
 *
 * @param  boolean $success
 * @param  int $status
 * @param  string $message
 * @param  array $data
 *
 * @return \Illuminate\Http\JsonResponse
 */
function respondWithData($success, $status, $message, $data)
{
    return response()->json([
        'success' => $success,
        'status'  => $status,
        'message' => $message,
        'data'    => $data,
    ], $status);
}


/**
 * Format Date Indonesia.
 *
 * @param  string $tgl
 * @param  boolean $tampil_hari
 *
 * @return \Illuminate\Http\JsonResponse
 */
function tanggal_indonesia($tgl, $tampil_hari=true){
    $nama_hari=array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu");
    $nama_bulan = array (
            1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus",
            "September", "Oktober", "November", "Desember");
    $tahun=substr($tgl,0,4);
    $bulan=$nama_bulan[(int)substr($tgl,5,2)];
    $tanggal=substr($tgl,8,2);
    $text="";
    if ($tampil_hari) {
        $urutan_hari=date('w', mktime(0,0,0, substr($tgl,5,2), $tanggal, $tahun));
        $hari=$nama_hari[$urutan_hari];
        $text .= $hari.", ";
    }
        $text .=$tanggal ." ". $bulan ." ". $tahun;
    return $text;
}

function format_rupiah($angka){ 
    $hasil =  number_format($angka,0, ',' , '.'); 
    return 'Rp. '.$hasil; 
}

function getProfilDesa()
{
    return ProfilDesa::first();
}
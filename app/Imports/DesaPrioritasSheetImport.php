<?php

namespace App\Imports;

use App\Models\Master\DesaModel;
use App\Models\DesaPrioritas\DesaPrioritasModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Session;

class DesaPrioritasSheetImport implements ToCollection, WithHeadingRow, WithCalculatedFormulas, WithBatchInserts, WithChunkReading, ShouldQueue
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        $i = 1;
        $tahun = request()->tahun;
        $triwulan = request()->triwulan;
        foreach ($rows as $row) {
            $kode_desa_cari = str_replace(".", "", $row['KODE DESA (Permendagri 137 / 2017)']);
            $desa = DesaModel::where('KODE_DESA', $kode_desa_cari)->first();
            if (!is_null($desa)) {
                $desa_prioritas = DesaPrioritasModel::firstOrNew([
                    'ID_DESA' => $desa->ID_DESA,
                    'TERTINGGAL' => $row['Tertinggal'],
                    'TERDEPAN_DAN_TERLUAR' => $row['Terdepan dan Terluar'],
                    'PKSN' => $row['PKSN'],
                    'LOKPRI_BNPP' => $row['Lokpri BNPP'],
                    'TAHUN' => $tahun,
                    'TRIWULAN' => $triwulan
                ]);
                if (!$desa_prioritas->exists) {
                    $get_desa_prioritas = DesaPrioritasModel::where('ID_DESA', $desa_prioritas->ID_DESA)->where('TAHUN', $desa_prioritas->TAHUN)->where('TRIWULAN', $desa_prioritas->TRIWULAN)->first();
                    if (!is_null($get_desa_prioritas)) {
                        $get_desa_prioritas->delete();
                    }
                    $desa_prioritas->save();
                }
            }

            $i++;
        }
        Session::flash('success', 'Data Sheet Desa Prioritas Berhasil');
    }

    public function headingRow(): int
    {
        return 2;
    }

    public function batchSize(): int
    {
        return 5000;
    }

    public function chunkSize(): int
    {
        return 5000;
    }
}

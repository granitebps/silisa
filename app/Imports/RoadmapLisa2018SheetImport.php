<?php

namespace App\Imports;

use App\Models\Master\DesaModel;
use App\Models\RoadmapSilisa\RoadmapRealisasiModel;
use App\Models\RoadmapSilisa\RoadmapTargetModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Session;

class RoadmapLisa2018SheetImport implements ToCollection, WithHeadingRow, WithCalculatedFormulas, WithBatchInserts, WithChunkReading, ShouldQueue
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        $tahun = request()->tahun;
        $triwulan = request()->triwulan;
        foreach ($rows as $row) {
            // Batas Tambah Table Master di Roadmap Lisa
            // =======================================================================================================

            $kode_desa_cari = str_replace(".", "", $row['KODE DESA (Permendagri 137 / 2017)']);
            $desa_id = DesaModel::where('KODE_DESA', $kode_desa_cari)->first();

            if (!is_float($row['Target Pembangkit (kW/kWp)'])) {
                $row['Target Pembangkit (kW/kWp)'] = null;
            }
            if (!is_float($row['Target JTM (Kms)'])) {
                $row['Target JTM (Kms)'] = null;
            }
            if (!is_float($row['Target JTR (Kms)'])) {
                $row['Target JTR (Kms)'] = null;
            }
            if (!is_float($row['Target Gardu (Unit / kVA)'])) {
                $row['Target Gardu (Unit / kVA)'] = null;
            }
            if (!is_float($row['Target Pelanggan (RT)'])) {
                $row['Target Pelanggan (RT)'] = null;
            }
            if (!is_null($desa_id)) {
                // Table Roadmap Target
                $roadmap_target = RoadmapTargetModel::firstOrNew([
                    'ID_DESA' => $desa_id->ID_DESA,
                    'TARGET_PEMBANGKIT' => $row['Target Pembangkit (kW/kWp)'],
                    'TARGET_JTM' => $row['Target JTM (Kms)'],
                    'TARGET_JTR' => $row['Target JTR (Kms)'],
                    'TARGET_GARDU' => $row['Target Gardu (Unit / kVA)'],
                    'TARGET_PELANGGAN' => $row['Target Pelanggan (RT)'],
                    'KETERANGAN' => $row['KETERANGAN RoadMap'],
                    'TAHUN' => $tahun,
                    'TRIWULAN' => $triwulan
                ]);
                if (!$roadmap_target->exists) {
                    $get_roadmap_target = RoadmapTargetModel::where('ID_DESA', $roadmap_target->ID_DESA)->where('TAHUN', $roadmap_target->TAHUN)->where('TRIWULAN', $roadmap_target->TRIWULAN)->first();
                    if (!is_null($get_roadmap_target)) {
                        $get_roadmap_target->delete();
                    }
                    $roadmap_target->save();
                }

                if (!is_float($row['Realisasi Pembangkit (kW/kWp)'])) {
                    $row['Realisasi Pembangkit (kW/kWp)'] = null;
                }
                if (!is_float($row['Realisasi JTM (Kms)'])) {
                    $row['Realisasi JTM (Kms)'] = null;
                }
                if (!is_float($row['Realisasi JTR (Kms)'])) {
                    $row['Realisasi JTR (Kms)'] = null;
                }
                if (!is_float($row['Realisasi Gardu (Unit / kVA)'])) {
                    $row['Realisasi Gardu (Unit / kVA)'] = null;
                }
                if (!is_float($row['Realisasi Pelanggan (RT)'])) {
                    $row['Realisasi Pelanggan (RT)'] = null;
                }
                // Table Roadmap Realisasi
                $roadmap_realisasi = RoadmapRealisasiModel::firstOrNew([
                    'ID_DESA' => $desa_id->ID_DESA,
                    'REALISASI_PEMBANGKIT' => $row['Realisasi Pembangkit (kW/kWp)'],
                    'REALISASI_JTM' => $row['Realisasi JTM (Kms)'],
                    'REALISASI_JTR' => $row['Realisasi JTR (Kms)'],
                    'REALISASI_GARDU' => $row['Realisasi Gardu (Unit / kVA)'],
                    'REALISASI_PELANGGAN' => $row['Realisasi Pelanggan (RT)'],
                    'KETERANGAN' => $row['KETERANGAN RoadMap'],
                    'TAHUN' => $tahun,
                    'TRIWULAN' => $triwulan
                ]);
                if (!$roadmap_realisasi->exists) {
                    $get_roadmap_realisasi = RoadmapRealisasiModel::where('ID_DESA', $roadmap_realisasi->ID_DESA)->where('TAHUN', $roadmap_realisasi->TAHUN)->where('TRIWULAN', $roadmap_realisasi->TRIWULAN)->first();
                    if (!is_null($get_roadmap_realisasi)) {
                        $get_roadmap_realisasi->delete();
                    }
                    $roadmap_realisasi->save();
                }
            }
        }
        Session::flash('success', 'Data Sheet Roadmap LISA Berhasil');
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

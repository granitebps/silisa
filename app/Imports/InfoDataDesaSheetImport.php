<?php

namespace App\Imports;

use App\Models\Master\ProvinsiModel;
use App\Models\Master\KabupatenKotaModel;
use App\Models\Master\KecamatanModel;
use App\Models\Master\DesaModel;
use App\Models\InfoDataDesa\InfoDesaModel;
use App\Models\InfoDataDesa\InfoDesaRTModel;
use App\Models\InfoDataDesa\InfoDesaPembangkitModel;
use App\Models\Master\PotensiEnergiModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Master\WilayahModel;
use App\Models\Master\AreaModel;
use App\Models\Master\RayonModel;

require_once("convert.php");

class InfoDataDesaSheetImport implements ToCollection, WithHeadingRow, WithCalculatedFormulas, WithBatchInserts, WithChunkReading, ShouldQueue
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function collection(Collection $rows)
    {
        $i = 1;
        $errors = array();
        $tahun = request()->tahun;
        $triwulan = request()->triwulan;
        foreach ($rows as $row) {
            // Kode Desas
            $kode_desa = str_replace(".", "", $row['KODE DESA (Permendagri 137 / 2017)']);

            // Table Master Provinsi
            if (!is_null($row['PROVINSI (Permendagri 137 / 2017)']) && !is_null($row['KABUPATEN / KOTA (Permendagri 137 / 2017)']) && !is_null($row['KECAMATAN (Permendagri 137 / 2017)']) && !is_null($row['KODE DESA (Permendagri 137 / 2017)']) && !is_null($row['NAMA DESA / KELURAHAN (Permendagri 137 / 2017)'] && $row['Wilayah / Distribusi'] && $row['Area'] && $row['Rayon'])) {
                $nama_provinsi_temp = preg_replace("/[^A-Za-z ]/", '', $row['PROVINSI (Permendagri 137 / 2017)']);
                $nama_provinsi = strtoupper($nama_provinsi_temp);
                $kode_provinsi = substr($kode_desa, 0, 2) . "00000000";
                $provinsi = ProvinsiModel::firstOrCreate([
                    'NAMA_PROVINSI' => $nama_provinsi,
                    'KODE_PROVINSI' => $kode_provinsi
                ]);

                // Table Master Kabupaten Kota
                $nama_kabupaten_temp = preg_replace('/[^A-Za-z ]/', '', $row['KABUPATEN / KOTA (Permendagri 137 / 2017)']);
                $nama_kabupeten = strtoupper($nama_kabupaten_temp);
                $kode_kabupaten_kota = substr($kode_desa, 0, 4) . "000000";
                $kabupaten = KabupatenKotaModel::firstOrCreate([
                    'ID_PROVINSI' => $provinsi->ID_PROVINSI,
                    'NAMA_KABUPATEN_KOTA' => $nama_kabupeten,
                    'KODE_KABUPATEN_KOTA' => $kode_kabupaten_kota
                ]);

                // Table Master Kecamatan
                $nama_kecamatan_temp = preg_replace('/[^A-Za-z ]/', '', $row['KECAMATAN (Permendagri 137 / 2017)']);
                $nama_kecamatan = strtoupper($nama_kecamatan_temp);
                $kode_kecamatan = substr($kode_desa, 0, 6) . "0000";
                $kecamatan = KecamatanModel::firstOrCreate([
                    'ID_KABUPATEN_KOTA' => $kabupaten->ID_KABUPATEN_KOTA,
                    'NAMA_KECAMATAN' => $nama_kecamatan,
                    'KODE_KECAMATAN' => $kode_kecamatan
                ]);

                // Table Master Wilayah
                // $nama_wilayah_temp = preg_replace('/[^A-Za-z ]/', '', $row['Wilayah / Distribusi']);
                // $nama_wilayah = strtoupper($nama_wilayah_temp);
                $wilayah = WilayahModel::firstOrCreate([
                    'NAMA_WILAYAH' => $row['Wilayah / Distribusi']
                ]);

                // Table Master Area
                // $nama_area_temp = preg_replace('/[^A-Za-z ]/', '', $row['Area']);
                // $nama_area = strtoupper($nama_area_temp);
                $area = AreaModel::firstOrCreate([
                    'NAMA_AREA' => $row['Area']
                ]);

                // Table Master Rayon
                // $nama_rayon_temp = preg_replace('/[^A-Za-z ]/', '', $row['Rayon']);
                // $nama_rayon = strtoupper($nama_rayon_temp);
                $rayon = RayonModel::firstOrCreate([
                    'NAMA_RAYON' => $row['Rayon']
                ]);

                // Table Master Desa
                try {
                    if (is_string($row['Lintang'])) {
                        $row['Lintang'] = dms_to_dec(trim($row['Lintang']));
                    }
                    if (is_string($row['Bujur'])) {
                        $row['Bujur'] = dms_to_dec(trim($row['Bujur']));
                    }
                    if (is_float($row['Lintang'])) {
                        $row['Lintang'] = fix_number($row['Lintang']);
                    }
                    if (is_float($row['Bujur'])) {
                        $row['Bujur'] = fix_number($row['Bujur']);
                    }
                } catch (\Exception $e) {
                    dd($i);
                }
                $nama_desa_temp = preg_replace('/[^A-Za-z ]/', '', $row['NAMA DESA / KELURAHAN (Permendagri 137 / 2017)']);
                $nama_desa = strtoupper($nama_desa_temp);
                $desa = DesaModel::firstOrCreate([
                    'ID_KECAMATAN' => $kecamatan->ID_KECAMATAN,
                    'ID_WILAYAH' => $wilayah->ID_WILAYAH,
                    'ID_AREA' => $area->ID_AREA,
                    'ID_RAYON' => $rayon->ID_RAYON,
                    'KODE_DESA' => $kode_desa,
                    'NAMA_DESA' => $nama_desa,
                    'LINTANG' => $row['Lintang'],
                    'BUJUR' => $row['Bujur']
                ]);
            } else {
                $errors[] = $i;
            }

            // Table Info Desa
            if (!is_float($row['DESA BERLISTRIK PLN'])) {
                $row['DESA BERLISTRIK PLN'] = null;
            }
            if (!is_float($row['DESA BERLISTRIK LTSHE'])) {
                $row['DESA BERLISTRIK LTSHE'] = null;
            }
            if (!is_float($row['DESA BERLISTRIK NON PLN (Selain LTSHE)'])) {
                $row['DESA BERLISTRIK NON PLN (Selain LTSHE)'] = null;
            }
            if (!is_float($row['DESA BELUM BERLISTRIK'])) {
                $row['DESA BELUM BERLISTRIK'] = null;
            }
            if (!is_float($row['Jarak dari Jaringan Eksisting'])) {
                $row['Jarak dari Jaringan Eksisting'] = null;
            }

            try {
                $info_desa = InfoDesaModel::firstOrNew([
                    'ID_DESA' => $desa->ID_DESA,
                    'DESA_BERLISTRIK' => $row['DESA BERLISTRIK PLN'],
                    'DESA_BERLISTRIK_LTSHE' => $row['DESA BERLISTRIK LTSHE'],
                    'DESA_BERLISTRIK_NON_PLN' => $row['DESA BERLISTRIK NON PLN (Selain LTSHE)'],
                    'DESA_BELUM_BERLISTRIK' => $row['DESA BELUM BERLISTRIK'],
                    'JARAK_DARI_JARINGAN_EKSISTENSI' => $row['Jarak dari Jaringan Eksisting'],
                    'KETERANGAN' => $row['Keterangan'],
                    'TAHUN' => $tahun,
                    'TRIWULAN' => $triwulan
                ]);
                if (!$info_desa->exists) {
                    $get_info_desa = InfoDesaModel::where('ID_DESA', $info_desa->ID_DESA)->where('TAHUN', $info_desa->TAHUN)->where('TRIWULAN', $info_desa->TRIWULAN)->first();
                    if (!is_null($get_info_desa)) {
                        $get_info_desa->delete();
                    }
                    $info_desa->save();
                }
            } catch (\Exception $e) {
                dd($i);
            }

            // Table Info Desa RT
            if (!is_float($row['TOTAL RT DESA'])) {
                $row['TOTAL RT DESA'] = null;
            }
            if (!is_float($row['RT BERLISTRIK PLN'])) {
                $row['RT BERLISTRIK PLN'] = null;
            }
            if (!is_float($row['RT BERLISTRIK PLN (MENYALUR)'])) {
                $row['RT BERLISTRIK PLN (MENYALUR)'] = null;
            }
            if (!is_float($row['RT BERLISTRIK NON  PLN (LTSHE)'])) {
                $row['RT BERLISTRIK NON  PLN (LTSHE)'] = null;
            }
            if (!is_float($row['RT BERLISTRIK NON PLN SELAIN LTSHE'])) {
                $row['RT BERLISTRIK NON PLN SELAIN LTSHE'] = null;
            }
            if (!is_float($row['RT TIDAK BERLISTRIK'])) {
                $row['RT TIDAK BERLISTRIK'] = null;
            }
            if (!is_float($row['RT AKAN DILISTRIKI'])) {
                $row['RT AKAN DILISTRIKI'] = null;
            }
            if (!is_float($row['RT BELUM DAPAT DILISTRIKI'])) {
                $row['RT BELUM DAPAT DILISTRIKI'] = null;
            }
            if (!is_float($row['Jumlah Rumah Tangga Calon Penerima Bantuan Subsidi Listrik'])) {
                $row['Jumlah Rumah Tangga Calon Penerima Bantuan Subsidi Listrik'] = null;
            }
            if (!is_float($row['Update Status Jumlah Rumah Tangga Calon Penerima Bantuan Subsidi Listrik'])) {
                $row['Update Status Jumlah Rumah Tangga Calon Penerima Bantuan Subsidi Listrik'] = null;
            }
            try {
                $info_desa_rt = InfoDesaRTModel::firstOrNew([
                    'ID_DESA' => $desa->ID_DESA,
                    'TOTAL_RT' => $row['TOTAL RT DESA'],
                    'RT_LISTRIK_PLN' => $row['RT BERLISTRIK PLN'],
                    'RT_LISTRIK_PLN_MENYALUR' => $row['RT BERLISTRIK PLN (MENYALUR)'],
                    'RT_LISTRIK_NON_PLN_LTSHE' => $row['RT BERLISTRIK NON  PLN (LTSHE)'],
                    'RT_LISTRIK_NON_PLN' => $row['RT BERLISTRIK NON PLN SELAIN LTSHE'],
                    'RT_TIDAK_BERLISTRIK' => $row['RT TIDAK BERLISTRIK'],
                    'RT_AKAN_DILISTRIK' => $row['RT AKAN DILISTRIKI'],
                    'RT_BELUM_DAPAT_DILISTRIK' => $row['RT BELUM DAPAT DILISTRIKI'],
                    'JUMLAH_CALON_PENERIMA_SUBSIDI' => $row['Jumlah Rumah Tangga Calon Penerima Bantuan Subsidi Listrik'],
                    'UPDATE_JMLH_CALON_PENERIMA_SUBSIDI' => $row['Update Status Jumlah Rumah Tangga Calon Penerima Bantuan Subsidi Listrik'],
                    'TAHUN' => $tahun,
                    'TRIWULAN' => $triwulan
                ]);
                if (!$info_desa_rt->exists) {
                    $get_info_desa_rt = InfoDesaRTModel::where('ID_DESA', $info_desa_rt->ID_DESA)->where('TAHUN', $info_desa_rt->TAHUN)->where('TRIWULAN', $info_desa_rt->TRIWULAN)->first();
                    if (!is_null($get_info_desa_rt)) {
                        $get_info_desa_rt->delete();
                    }
                    $info_desa_rt->save();
                }
            } catch (\Exception $e) {
                dd($i);
            }

            // Table Info Desa Pembangkit
            if (!is_float($row['JAM NYALA PLN'])) {
                $row['JAM NYALA PLN'] = null;
            } else {
                $row['JAM NYALA PLN'] = preg_replace("/[^0-9.]/", "", $row['JAM NYALA PLN']);
            }
            try {
                $info_desa_pembangkit = InfoDesaPembangkitModel::firstOrNew([
                    'ID_DESA' => $desa->ID_DESA,
                    'PLN_GRID_ISOLATED' => $row['PLN (GRID/ISOLATED)'],
                    'JENIS_PEMBANGKIT_ISOLATED' => $row['JENIS PEMBANGKIT ISOLATED'],
                    'JAM_NYALA_PLN' => $row['JAM NYALA PLN'],
                    'GRID_KOMUNAL_STANDALONE' => $row['(Grid Komunal/ Stand Alone)'],
                    'JENIS_PEMBANGKIT' => $row['Jenis Pembangkit'],
                    'JAM_NYALA_NON_PLN' => $row['JAM NYALA NON PLN'],
                    'STATUS_KONDISI_PASOKAN_LISTRIK' => $row['Status Kondisi Pasokan Listrik'],
                    'KETERANGAN' => $row['KETERANGAN'],
                    'TAHUN' => $tahun,
                    'TRIWULAN' => $triwulan
                ]);
                if (!$info_desa_pembangkit->exists) {
                    $get_info_desa_pembangkit = InfoDesaPembangkitModel::where('ID_DESA', $info_desa_pembangkit->ID_DESA)->where('TAHUN', $info_desa_pembangkit->TAHUN)->where('TRIWULAN', $info_desa_pembangkit->TRIWULAN)->first();
                    if (!is_null($get_info_desa_pembangkit)) {
                        $get_info_desa_pembangkit->delete();
                    }
                    $info_desa_pembangkit->save();
                }
            } catch (\Exception $e) {
                dd($i);
            }

            // Table Master Potensi Energi
            if (!is_null($row['Potensi Sumber Energi Setempat'])) {
                $potensi_energi = PotensiEnergiModel::firstOrCreate(['NAMA_POTENSI_ENERGI' => $row['Potensi Sumber Energi Setempat']]);
            }

            if (!is_null($row['Potensi Sumber Energi Setempat'])) {
                // Table Pivot Master Potensi Desa dan Info Desa
                $id_potensi_energi = PotensiEnergiModel::where('NAMA_POTENSI_ENERGI', ($row['Potensi Sumber Energi Setempat']))->first();
                $info_desa->potensi_energi()->attach($id_potensi_energi->ID_POTENSI_ENERGI);
            }

            $i++;
        }
        if (count($errors) > 0) {
            $error = implode('|', $errors);
            Session::flash('error', 'Ada data kosong di baris ' . $error);
        } else {
            Session::flash('success', 'Data Master Sheet Info Data Desa Berhasil');
        }
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

<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class SilisaImport implements WithMultipleSheets
{
    /**
     * @param Collection $collection
     */
    public function sheets(): array
    {
        return [
            'Info Data Desa' => new InfoDataDesaSheetImport(),
            'Roadmap LISA_2018' => new RoadmapLisa2018SheetImport(),
            'Desa Prioritas (3T)' => new DesaPrioritasSheetImport()
        ];
    }
}

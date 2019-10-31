<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

/**
 * Class NeoReportExport
 * @package App\Exports
 */
class NeoReportExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $data = new Collection();
        foreach (\App\Helpers\Data::getNeoTypes() as $neoType) {
            $neoLable   = $neoType->name;
            $lowData    = count(\App\Helpers\Data::getLowLevelDataNEO($neoType->id, null));
            $mediumData = count(\App\Helpers\Data::getMediumLevelDataNEO($neoType->id, null));
            $highData   = count(\App\Helpers\Data::getHighLevelDataNEO($neoType->id, null));
            $data->push([$neoLable, $lowData, $mediumData, $highData]);
        }

        return $data;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Loại',
            'Thấp',
            'Trung bình',
            'Cao'
        ];
    }
}

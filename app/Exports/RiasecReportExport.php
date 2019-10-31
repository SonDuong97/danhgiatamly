<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

/**
 * Class RiasecReportExport
 * @package App\Exports
 */
class RiasecReportExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $data = new Collection();
        foreach (\App\Helpers\Data::getRiasecTypes() as $riasecType) {
            $riasecLable = $riasecType->name;
            $riasecData  = count(\App\Helpers\Data::getRiasecDataByTypeName($riasecType->name, null));
            $data->push([$riasecLable, $riasecData]);
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
            'Số lượng'
        ];
    }
}

<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

/**
 * Class PsychologyReportExport
 * @package App\Exports
 */
class PsychologyReportExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $data = new Collection();
        foreach (\App\Helpers\Data::getPsychologyTypes() as $psychologyType) {
            $psychologyLable = $psychologyType->content;
            $psychologyData  = \App\Helpers\Data::getAveragePsychologyScoreByTypeId($psychologyType->id, null);
            $data->push([$psychologyLable, $psychologyData]);
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
            'Chỉ số trung bình'
        ];
    }
}

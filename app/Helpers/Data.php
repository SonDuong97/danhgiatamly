<?php
/**
 * Created by PhpStorm.
 * User: tuando
 * Date: 23/11/2018
 * Time: 10:09
 */

namespace App\Helpers;

use App\NeoReport;
use App\PsychologyReport;
use App\Report;
use App\RiasecReport;
use App\TypeNeo;
use App\TypePsychology;
use App\TypeRiasec;

/**
 * Class Data
 * @package App\Helpers
 */
class Data
{
    /**
     * @return TypeNeo[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function getNeoTypes()
    {
        return TypeNeo::all();
    }

    /**
     * @param $typeId
     *
     * @return mixed
     */
    public static function getLowLevelDataNEO($typeId, $userId)
    {
        if (empty($userId)) {
            return NeoReport::where('type_neo_id', $typeId)
                ->where('level', Helper::LEVEL_THAP)
                ->get();
        } else {

            return NeoReport::join('reports', 'neo_reports.report_id', '=', 'reports.id')
                ->where('type_neo_id', $typeId)
                ->where('level', Helper::LEVEL_THAP)
                ->where('user_id', $userId)
                ->get();
        }
    }

    /**
     * @param $typeId
     *
     * @return mixed
     */
    public static function getMediumLevelDataNEO($typeId, $userId)
    {
        if (empty($userId)) {
            return NeoReport::where('type_neo_id', $typeId)
                ->where('level', Helper::LEVEL_TRUNG_BINH)
                ->get();
        } else {
            return NeoReport::join('reports', 'neo_reports.report_id', '=', 'reports.id')
                ->where('type_neo_id', $typeId)
                ->where('level', Helper::LEVEL_TRUNG_BINH)
                ->where('user_id', $userId)
                ->get();
        }
    }

    /**
     * @param $typeId
     *
     * @return mixed
     */
    public static function getHighLevelDataNEO($typeId, $userId)
    {
        if (empty($userId)) {
            return NeoReport::where('type_neo_id', $typeId)
                ->where('level', Helper::LEVEL_CAO)
                ->get();
        } else {
            return NeoReport::join('reports', 'neo_reports.report_id', '=', 'reports.id')
                ->where('type_neo_id', $typeId)
                ->where('level', Helper::LEVEL_CAO)
                ->where('user_id', $userId)
                ->get();
        }
    }

    /**
     * @return TypeRiasec[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function getRiasecTypes()
    {
        return TypeRiasec::all();
    }

    /**
     * @param $typeName
     *
     * @return mixed
     */
    public static function getRiasecDataByTypeName($typeName, $userId)
    {
        if (empty($userId)) {
            return RiasecReport::where('type_riasec', $typeName)
                ->get();
        } else {
            return RiasecReport::join('reports', 'riasec_reports.report_id', '=', 'reports.id')
                ->where('type_riasec', $typeName)
                ->where('user_id', $userId)
                ->get();
        }
    }

    /**
     * @param $type
     *
     * @return mixed
     */
    public static function getReportDataByType($type, $userId)
    {
        if (empty($userId))
            return Report::where('question_type', $type)
                ->get();
        else {
            return Report::where('question_type', $type)
                ->where('user_id', $userId)
                ->get();
        }
    }

    /**
     * @return TypePsychology[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function getPsychologyTypes()
    {
        return TypePsychology::all();
    }

    /**
     * @param $typeId
     *
     * @return float|int
     */
    public static function getAveragePsychologyScoreByTypeId($typeId, $userId)
    {
        if (empty($userId)) {
            $psychologyReports = PsychologyReport::where('type_psychology_id', $typeId)
                ->get();
        } else {
            $psychologyReports = PsychologyReport::join('reports', 'psychology_reports.report_id', '=', 'reports.id')
                ->where('type_psychology_id', $typeId)
                ->where('user_id', $userId)
                ->get();
        }
        if (count($psychologyReports) == 0)
            return 0;
        $averageScore = 0;
        foreach ($psychologyReports as $psychologyReport) {
            $averageScore += $psychologyReport->score;
        }

        return $averageScore / count($psychologyReports);
    }
}
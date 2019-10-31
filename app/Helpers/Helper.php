<?php
/**
 * Created by PhpStorm.
 * User: tuando
 * Date: 06/11/2018
 * Time: 22:56
 */

namespace App\Helpers;

use App\ExplainQuestionNEO;
use App\ExplainQuestionRIASEC;
use App\NeoTypeRule;
use App\PsychologyAnswerRule;
use App\PsychologyResultRule;
use App\QuestionDifficultPsychology;
use App\QuestionRiaSec;
use App\TypeNeo;
use App\TypePsychology;
use App\TypeRiasec;
use App\University;
use App\User;
use Illuminate\Support\Facades\DB;

/**
 * Class Helper
 * @package App\Helpers
 */
class Helper
{
    /**
     *
     */
    const LEVEL_THAP = 'Thấp';

    /**
     *
     */
    const LEVEL_TRUNG_BINH = 'Trung bình';

    /**
     *
     */
    const LEVEL_CAO = 'Cao';

    /**
     *
     */
    const NEO_LEVEL_HOAN_TOAN_SAI = 0;

    /**
     *
     */
    const NEO_LEVEL_SAI = 1;

    /**
     *
     */
    const NEO_LEVEL_KHONG_DUNG_KHONG_SAI = 2;

    /**
     *
     */
    const NEO_LEVEL_DUNG = 3;

    /**
     *
     */
    const NEO_LEVEL_HOAN_TOAN_DUNG = 4;

    /**
     *
     */
    const RIASEC_LEVEL_HOAN_TOAN_KHONG_DUNG = 0;

    /**
     *
     */
    const RIASEC_LEVEL_KHONG_DUNG = 0;

    /**
     *
     */
    const RIASEC_LEVEL_DUNG_MOT_PHAN = 0.5;

    /**
     *
     */
    const RIASEC_LEVEL_DUNG = 1;

    /**
     *
     */
    const RIASEC_LEVEL_HOAN_TOAN_DUNG = 1;

    /**
     * @param $id
     *
     * @return mixed
     */
    public static function getTypeNEOById($id)
    {
        return TypeNeo::find($id);
    }

    /**
     * @param $data
     * @param $sex
     *
     * @return array
     */
    public static function caculateNEO($data, $sex)
    {
        $result = [];
        $typeNeos = TypeNeo::all();
        foreach ($typeNeos as $typeNeo) {
            $result[] = self::caculateNEOType($typeNeo, $data, $sex);
        }

        return $result;
    }

    /**
     * @param $typeNeo
     * @param $data
     * @param $sex
     *
     * @return array
     */
    private static function caculateNEOType($typeNeo, $data, $sex)
    {
        $neoTypeRule = NeoTypeRule::where('type_id', $typeNeo->id)
            ->first();
        $questions = json_decode($neoTypeRule->content);
        $score = 0;
        foreach ($questions as $questionId) {
            $score += isset($data[$questionId]) ? (int)$data[$questionId] : 0;
        }
        $neoResultRules = DB::table('neo_result_rules')
            ->where('type_id', $typeNeo->id)
            ->where('sex', $sex)
            ->get();
        if (($neoResultRules[0])->score < $score && ($neoResultRules[1])->score < $score) {
            $level = self::LEVEL_CAO;
        } elseif (($neoResultRules[0])->score > $score && ($neoResultRules[1])->score > $score) {
            $level = self::LEVEL_THAP;
        } else {
            $level = self::LEVEL_TRUNG_BINH;
        }

        return [
            'level' => $level,
            'score' => $score,
            'type' => $typeNeo->name,
            'type_id' => $typeNeo->id
        ];
    }

    /**
     * @param $type
     * @param $level
     *
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|null|object
     */
    public static function getExQuestionNEOByTypeAndLevel($type, $level)
    {
        return ExplainQuestionNEO::where('type', $type)
            ->where('level', $level)
            ->first();
    }

    /**
     * @param $typeId
     *
     * @return mixed
     */
    public static function getRiasecTypeById($typeId)
    {
        return TypeRiasec::find($typeId);
    }

    /**
     * @param $data
     *
     * @return array
     */
    public static function caculateRIASEC($data)
    {
        $typeRiasecs = TypeRiasec::all();
        $result = [];
        foreach ($typeRiasecs as $typeRiasec) {
            $result[$typeRiasec->name] = self::caculateRIASECType($typeRiasec, $data);
        }
        return $result;
    }

    /**
     * @param $typeRiasec
     * @param $data
     *
     * @return int
     */
    private static function caculateRIASECType($typeRiasec, $data)
    {
        $typeRiasecQuestions = QuestionRiaSec::where('type_id', $typeRiasec->id)
            ->get();
        $score = 0;
        foreach ($typeRiasecQuestions as $typeRiasecQuestion) {
            if (isset($data[$typeRiasecQuestion->id])) {
                $score += (double)$data[$typeRiasecQuestion->id];
            }
        }

        return $score;

    }

    /**
     * @param $type
     *
     * @return mixed
     */
    public static function getExQuestionRIASECByType($type)
    {
        return ExplainQuestionRIASEC::where('type', $type)
            ->select('id', 'type', 'content')
            ->first();
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public static function getTypePsychologyById($id)
    {
        return TypePsychology::find($id);
    }

    /**
     * @param $typeId
     *
     * @return mixed
     */
    public static function getPsychologyQuestionsByTypeId($typeId)
    {
        return QuestionDifficultPsychology::where('type_psychology_id', $typeId)
            ->get();
    }

    /**
     * @param $typeId
     *
     * @return mixed
     */
    public static function getPsychologyAnswersByTypeId($typeId)
    {
        return PsychologyAnswerRule::where('type_id', $typeId)
            ->get();
    }

    /**
     * @param $data
     *
     * @return array
     */
    public static function caculatePsychology($data)
    {
        $typePsychologies = TypePsychology::all();
        $result = [];
        foreach ($typePsychologies as $typePsychology) {
            $result[] = self::caculatePsychologyType($typePsychology, $data);
        }

        return $result;
    }

    /**
     * @param $typePsychology
     * @param $data
     *
     * @return array
     */
    private static function caculatePsychologyType($typePsychology, $data)
    {
        $typePsychologyQuestions = QuestionDifficultPsychology::where('type_psychology_id', $typePsychology->id)
            ->get();
        $score = 0;
        foreach ($typePsychologyQuestions as $typePsychologyQuestion) {
            $score += isset($data[$typePsychologyQuestion->id]) ? (int)$data[$typePsychologyQuestion->id] : 0;
        }

        $psychologyResultRule = PsychologyResultRule::where('type_id', $typePsychology->id)
            ->first();

        if ($score <= $psychologyResultRule->average_value + $psychologyResultRule->error_value) {
            $typeResult = 'Không gặp vấn đề';
        } elseif ($score >= $psychologyResultRule->average_value + ($psychologyResultRule->error_value) * 2) {
            $typeResult = 'Nên gặp chuyên gia';
        } else {
            $typeResult = 'Nguy cơ';
        }

        return [
            'typeId' => $typePsychology->id,
            'score' => $score,
            'typeResult' => $typeResult,
        ];
    }

    /**
     * @param $name
     *
     * @return mixed
     */
    public static function getUniversityByName($name)
    {
        return University::where('name', $name)
            ->first();
    }

    /**
     * @param $userId
     *
     * @return mixed
     */
    public static function getUserById($userId)
    {
        return User::find($userId);
    }

    public static function formatHtmlResponse($questions)
    {
        return $questions->map(function ($item) {
            $item->content = strip_tags(html_entity_decode($item->content));
            return $item;
        });
    }

    public static function formatContent($content)
    {
        return strip_tags(html_entity_decode($content));

    }
}
<?php

namespace App\Http\Controllers\API;

use App\Events\UserTestAfter;
use App\Helpers\ApiResponse;
use App\Helpers\Helper;
use App\History;
use App\PsychologyResultRule;
use App\QuestionNeo;
use App\QuestionRiaSec;
use App\TypePsychology;
use App\TypeRiasec;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    public function index()
    {
        $data = trans('question_label');
        return ApiResponse::success(collect($data)->toArray());
    }

    public function list(Request $request)
    {

        try {
            switch ($request->input('type')) {
                case 1:
                    if (!isset(Auth::user()->profile->sex)) {
                        $msg = 'You must update your gender first';
                        return ApiResponse::fail(403, $msg);
                    }
                    $type = 'neo';
                    $questions = QuestionNeo::all('id', 'content', 'reverse_score');
                    $questions = Helper::formatHtmlResponse($questions);
                    $scoreSet = QuestionNeo::SCORE_SET;
                    $answerSet = QuestionNeo::ANSWER_SET;
                    break;
                case 2:
                    $type = 'riasec';
                    $questions = QuestionRiaSec::all('id', 'content');
                    $questions = Helper::formatHtmlResponse($questions);
                    $scoreSet = QuestionRiaSec::SCORE_SET;
                    $answerSet = QuestionRiaSec::ANSWER_SET;
                    break;
                case 3:
                    $type = 'psychology';
                    $typeList = TypePsychology::
                    with(['questions' => function ($q) {
                        $q->select(['id', 'content', 'type_psychology_id']);
                    },
                        'answers:name,score,type_id'])
                        ->select('id', 'content')
                        ->get();
                    $typeList->transform(function ($item) {
                        $item->questions = Helper::formatHtmlResponse($item->questions);
                        return $item;
                    });
                    return ApiResponse::success(compact('type', 'typeList'));
                    break;
            }
            return ApiResponse::success(compact('type', 'questions', 'answerSet', 'scoreSet'));
        } catch (\Exception $exception) {
            return ApiResponse::fail(500, $exception->getMessage());
        }
    }

    public function submitRIASECQuestion(Request $request)
    {
        try {
            $data = $request->all();
            unset($data['_token']);
            $results = Helper::caculateRIASEC($data);

            event(new UserTestAfter(Auth::user(), $results, 'riasec'));

            $historyData = [
                'userId' => Auth::user()->id,
                'title' => 'Trắc nghiệm hứng thú nghề nghiệp RIASEC',
                'result' => $results
            ];
            $history = new History();
            $history->saveHistory($historyData);
            $typeName = array_search(max($results), $results);
//            $key = TypeRiasec::where('name', $typeName)->first()->id;
            $highestFieldExplain = Helper::getExQuestionRIASECByType($typeName);
//            $highestFieldExplain->type = $typeName;
            $highestFieldExplain->content = strip_tags(html_entity_decode($highestFieldExplain->content));

            return ApiResponse::success(compact('results', 'highestFieldExplain'));

        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function submitNeoQuestion(Request $request)
    {
        try {
            $data = $request->all();
            unset($data['_token']);
            $sex = isset(Auth::user()->profile->sex) ? Auth::user()->profile->sex : 'Nam';
            $testResult = Helper::caculateNEO($data, $sex);

            event(new UserTestAfter(Auth::user(), $testResult, 'neo'));

            $historyData = [
                'userId' => Auth::user()->id,
                'title' => 'Trắc nghiệm nhân cách NEO',
                'result' => $testResult
            ];
            $history = new History();
            $history->saveHistory($historyData);
            $test = array_map(function ($item) {
                $item['explain'] = Helper::getExQuestionNEOByTypeAndLevel($item['type'], $item['level'])->convert_content;
                return $item;
            }, $testResult);
            $res = [
                'results' => $test
            ];

            return ApiResponse::success($res);
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function submitPsychologyQuestion(Request $request)
    {
        try {
            $data = $request->all();
            unset($data['_token']);
            $result = Helper::caculatePsychology($data);
            event(new UserTestAfter(Auth::user(), $result, 'psychology'));

            $historyData = [
                'userId' => Auth::user()->id,
                'title' => 'Trắc nghiệm sàng lọc tâm lý',
                'result' => $result
            ];
            $history = new History();
            $history->saveHistory($historyData);
            $psychologyResultRules = PsychologyResultRule::all();
            $lockupTable = $psychologyResultRules->map(function ($item) {
                $name = Helper::getTypePsychologyById($item->type_id)->content;
                $score = [
                    'Không gặp vấn đề' => (string)($item->average_value + $item->error_value),
                    'Nguy cơ' => (string)($item->average_value + $item->error_value) . '~' .
                        (string)($item->average_value + 2 * $item->error_value),
                    'Nên gặp chuyên gia' => '>' .
                        (string)($item->average_value + 2 * $item->error_value)
                ];
                return [
                    $name => $score
                ];
            });
            return ApiResponse::success(compact('result', 'lockupTable'));
        } catch (\Exception $exception) {
            ApiResponse::fail($exception->getCode());
        }
    }

}


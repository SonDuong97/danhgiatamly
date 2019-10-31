<?php
/**
 * Created by PhpStorm.
 * User: tuando
 * Date: 03/11/2018
 * Time: 20:06
 */

namespace App\Http\Controllers;

use App\Events\UserTestAfter;
use App\ExplainQuestionRIASEC;
use App\Helpers\Helper;
use App\History;
use App\QuestionRiaSec;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class QuestionRiasecTestController
 * @package App\Http\Controllers
 */
class QuestionRiasecTestController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $questionRIASECs = QuestionRiaSec::all();

        return view('pages.questions.riasec', [
            'questionRIASECs' => $questionRIASECs
        ]);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submitRIASECQuestion(Request $request)
    {
        $data = $request->all();
        unset($data['_token']);
        $riasecResult = Helper::caculateRIASEC($data);
        arsort($riasecResult);

        event(new UserTestAfter(Auth::user(), $riasecResult, 'riasec'));

        $historyData = [
            'userId' => Auth::user()->id,
            'title'  => 'Trắc nghiệm hứng thú nghề nghiệp RIASEC',
            'result' => $riasecResult
        ];
        $history     = new History();
        $history->saveHistory($historyData);

        return redirect()->route('question.riasec-result')->with('riasecResult', $riasecResult);
    }
}
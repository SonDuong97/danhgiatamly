<?php
/**
 * Created by PhpStorm.
 * User: tuando
 * Date: 03/11/2018
 * Time: 20:45
 */

namespace App\Http\Controllers;

use App\Events\UserTestAfter;
use App\Helpers\Helper;
use App\History;
use App\TypePsychology;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class QuestionPsychologyTestController
 * @package App\Http\Controllers
 */
class QuestionPsychologyTestController
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $typePsychologies = TypePsychology::all();

        return view('pages.questions.psychology', [
            'typePsychologies' => $typePsychologies
        ]);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submitPsychologyQuestion(Request $request)
    {
        $data = $request->all();
        unset($data['_token']);
        $result = Helper::caculatePsychology($data);

        event(new UserTestAfter(Auth::user(), $result, 'psychology'));

        $historyData = [
            'userId' => Auth::user()->id,
            'title'  => 'Trắc nghiệm sàng lọc tâm lý',
            'result' => $result
        ];
        $history     = new History();
        $history->saveHistory($historyData);

        return redirect()->route('question.psychology-result')->with('result', $result);
    }
}
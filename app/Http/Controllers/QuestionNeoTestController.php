<?php
/**
 * Created by PhpStorm.
 * User: tuando
 * Date: 02/11/2018
 * Time: 10:26
 */

namespace App\Http\Controllers;

use App\Events\UserTestAfter;
use App\Helpers\Helper;
use App\History;
use App\Profile;
use App\QuestionNeo;
use App\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class QuestionNeoTestController
 * @package App\Http\Controllers
 */
class QuestionNeoTestController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $profile = Profile::where('user_id', Auth::user()->id)
            ->first();
        $sex = $profile->sex;
        $universities = University::all();
        if (empty($sex)) {
            return view('pages.profile', [
                'universities' => $universities,
                'user'         => Auth::user(),
                'profile'      => $profile,
                'message'      => 'Nhập giới tính của bạn trước khi thực hiện kiểm tra NEO'
            ]);
        }
        $questionNEOs = QuestionNeo::all();

        $scores = QuestionNeo::SCORE_SET;
        return view('pages.questions.neo', compact('questionNEOs', 'scores'));
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submitNEOQuestion(Request $request)
    {
        $profile = Profile::where('user_id', Auth::user()->id)
            ->first();
        $data = $request->all();
        unset($data['_token']);
        $result = Helper::caculateNEO($data, $profile->sex);

        event(new UserTestAfter(Auth::user(), $result, 'neo'));

        $historyData = [
            'userId' => Auth::user()->id,
            'title'  => 'Trắc nghiệm nhân cách NEO',
            'result' => $result
        ];
        $history = new History();
        $history->saveHistory($historyData);

        return redirect()->route('question.neo-result')->with('result', $result);
    }
}
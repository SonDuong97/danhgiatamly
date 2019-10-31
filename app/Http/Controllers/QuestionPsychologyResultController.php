<?php
/**
 * Created by PhpStorm.
 * User: tuando
 * Date: 12/11/2018
 * Time: 09:21
 */

namespace App\Http\Controllers;

use App\PsychologyResultRule;

/**
 * Class QuestionPsychologyResultController
 * @package App\Http\Controllers
 */
class QuestionPsychologyResultController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $psychologyResultRules = PsychologyResultRule::all();

        return view('pages.questions.psychology_result', [
            'psychologyResultRules' => $psychologyResultRules
        ]);
    }
}
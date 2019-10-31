<?php
/**
 * Created by PhpStorm.
 * User: tuando
 * Date: 09/11/2018
 * Time: 00:29
 */

namespace App\Http\Controllers;

/**
 * Class QuestionRiasecResultController
 * @package App\Http\Controllers
 */
class QuestionRiasecResultController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('pages.questions.riasec_result');
    }
}
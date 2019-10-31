<?php
/**
 * Created by PhpStorm.
 * User: tuando
 * Date: 07/11/2018
 * Time: 18:23
 */

namespace App\Http\Controllers;

/**
 * Class QuestionNeoResultController
 * @package App\Http\Controllers
 */
class QuestionNeoResultController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        return view('pages.questions.neo_result');
    }
}
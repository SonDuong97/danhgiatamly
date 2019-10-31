<?php
/**
 * Created by PhpStorm.
 * User: tuando
 * Date: 02/11/2018
 * Time: 09:07
 */

namespace App\Http\Controllers;

/**
 * Class QuestionController
 * @package App\Http\Controllers
 */
class QuestionController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $label = trans('question_label');
        return view('pages.question')->with(['label' => $label]);
    }
}
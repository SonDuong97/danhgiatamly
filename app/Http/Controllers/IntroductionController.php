<?php
/**
 * Created by PhpStorm.
 * User: tuando
 * Date: 27/12/2018
 * Time: 18:13
 */

namespace App\Http\Controllers;

/**
 * Class IntroductionController
 * @package App\Http\Controllers
 */
class IntroductionController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('pages.introduction');
    }
}
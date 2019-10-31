<?php
/**
 * Created by PhpStorm.
 * User: tuando
 * Date: 11/11/2018
 * Time: 20:53
 */

namespace App\Http\Controllers;

use App\PsychologyAnswerRule;
use App\PsychologyResultRule;
use App\TypePsychology;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

/**
 * Class PsychologyRuleController
 * @package App\Http\Controllers
 */
class PsychologyRuleController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $psychologyResultRules = PsychologyResultRule::all();
        $psychologyAnswerRules = PsychologyAnswerRule::all();

        return view('admin.rules.Psychology.index', [
            'psychologyResultRules' => $psychologyResultRules,
            'psychologyAnswerRules' => $psychologyAnswerRules
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createResultRule()
    {
        $typePsychologies = TypePsychology::all();

        return view('admin.rules.Psychology.result.create', [
            'typePsychologies' => $typePsychologies
        ]);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function storeResultRule(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type-id'       => 'required',
            'average-value' => 'required|numeric',
            'error-value'   => 'required|numeric'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        } else {
            $typeId       = $request->get('type-id');
            $averageValue = $request->get('average-value');
            $errorValue   = $request->get('error-value');
            try {
                DB::beginTransaction();
                $psychologyResultRule                = new PsychologyResultRule();
                $psychologyResultRule->type_id       = $typeId;
                $psychologyResultRule->average_value = $averageValue;
                $psychologyResultRule->error_value   = $errorValue;
                $psychologyResultRule->save();
                DB::commit();
                alert()->overlay('Create Psuchology Result Rule', 'Success Create Rule', 'success');

                return redirect(route('psychologyrule.index'));
            } catch (\Exception $e) {
                DB::rollback();
                echo $e;
                die();
            }
        }
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroyResultRule($id)
    {
        try {
            DB::beginTransaction();
            PsychologyResultRule::destroy($id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            echo $e;
        }
        alert()->overlay('Delete Psychology Rule', 'Success Delete Psychology Rule', 'error');

        return redirect(route('psychologyrule.index'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createAnswerRule()
    {
        $typePsychologies = TypePsychology::all();

        return view('admin.rules.Psychology.answer.create', [
            'typePsychologies' => $typePsychologies
        ]);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function storeAnswerRule(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type-id' => 'required',
            'name'    => 'required',
            'score'   => 'required|numeric'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        } else {
            $typeId = $request->get('type-id');
            $name   = $request->get('name');
            $score  = $request->get('score');
            try {
                DB::beginTransaction();
                $psychologyAnswerRule          = new PsychologyAnswerRule();
                $psychologyAnswerRule->type_id = $typeId;
                $psychologyAnswerRule->name    = $name;
                $psychologyAnswerRule->score   = $score;
                $psychologyAnswerRule->save();
                DB::commit();
                alert()->overlay('Create Psuchology Answer Rule', 'Success Create Rule', 'success');

                return redirect(route('psychologyrule.index'));
            } catch (\Exception $e) {
                DB::rollback();
                echo $e;
                die();
            }
        }
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroyAnswerRule($id)
    {
        try {
            DB::beginTransaction();
            PsychologyAnswerRule::destroy($id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            echo $e;
        }
        alert()->overlay('Delete Psychology Rule', 'Success Delete Psychology Rule', 'error');

        return redirect(route('psychologyrule.index'));
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editResultRule($id)
    {
        $psychologyResultRule = PsychologyResultRule::find($id);
        $typePsychologies     = TypePsychology::all();

        return view('admin.rules.Psychology.result.edit', [
            'psychologyResultRule' => $psychologyResultRule,
            'typePsychologies'     => $typePsychologies
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updateResultRule(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'type-id'       => 'required|numeric',
            'average-value' => 'required|numeric',
            'error-value'   => 'required|numeric'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        } else {
            try {
                $psychologyResultRule = PsychologyResultRule::find($id);
                DB::beginTransaction();
                $psychologyResultRule->type_id       = $request->get('type-id');
                $psychologyResultRule->average_value = $request->get('average-value');
                $psychologyResultRule->error_value   = $request->get('error-value');
                $psychologyResultRule->save();
                DB::commit();
                alert()->overlay('Update Psychology Result Rule', 'Success Update Psychology Result Rule', 'success');

                return redirect(route('psychologyrule.index'));
            } catch (\Exception $e) {
                DB::rollback();
                echo $e;
                die();
            }
        }
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editAnswerRule($id)
    {
        $psychologyAnswerRule = PsychologyAnswerRule::find($id);
        $typePsychologies     = TypePsychology::all();

        return view('admin.rules.Psychology.answer.edit', [
            'psychologyAnswerRule' => $psychologyAnswerRule,
            'typePsychologies'     => $typePsychologies
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updateAnswerRule(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'type-id' => 'required|numeric',
            'name'    => 'required',
            'score'   => 'required|numeric'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        } else {
            try {
                $psychologyAnswerRule = PsychologyAnswerRule::find($id);
                DB::beginTransaction();
                $psychologyAnswerRule->type_id       = $request->get('type-id');
                $psychologyAnswerRule->name = $request->get('name');
                $psychologyAnswerRule->score   = $request->get('score');
                $psychologyAnswerRule->save();
                DB::commit();
                alert()->overlay('Update Psychology Answer Rule', 'Success Update Psychology Answer Rule', 'success');

                return redirect(route('psychologyrule.index'));
            } catch (\Exception $e) {
                DB::rollback();
                echo $e;
                die();
            }
        }
    }
}
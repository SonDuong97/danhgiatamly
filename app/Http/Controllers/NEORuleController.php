<?php
/**
 * Created by PhpStorm.
 * User: tuando
 * Date: 06/11/2018
 * Time: 21:26
 */

namespace App\Http\Controllers;

use App\NeoResultRule;
use App\NeoTypeRule;
use App\QuestionNeo;
use App\TypeNeo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

/**
 * Class NEORuleController
 * @package App\Http\Controllers
 */
class NEORuleController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $neoTypeRules   = NeoTypeRule::all();
        $neoResultRules = NeoResultRule::all();

        return view('admin.rules.NEO.index', [
            'neoTypeRules'   => $neoTypeRules,
            'neoResultRules' => $neoResultRules
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createTypeRule()
    {
        $typeNeos     = TypeNeo::all();
        $questionNeos = QuestionNeo::all();

        return view('admin.rules.NEO.type.create', [
            'typeNeos'     => $typeNeos,
            'questionNeos' => $questionNeos
        ]);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function storeTypeRule(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type'     => 'required',
            'question' => 'required'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        } else {
            $typeId    = $request->get('type');
            $questions = $request->get('question');
            try {
                DB::beginTransaction();
                $neoTypeRule          = new NeoTypeRule();
                $neoTypeRule->type_id = $typeId;
                $neoTypeRule->content = json_encode($questions);
                $neoTypeRule->save();
                DB::commit();
                alert()->overlay('Create NEO Type Rule', 'Success Create Rule', 'success');

                return redirect(route('neorule.index'));
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
    public function destroyTypeRule($id)
    {
        try {
            DB::beginTransaction();
            NeoTypeRule::destroy($id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            echo $e;
        }
        alert()->overlay('Delete NEO Rule', 'Success Delete NEO Rule', 'error');

        return redirect(route('neorule.index'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createResultRule()
    {
        $typeNeos = TypeNeo::all();

        return view('admin.rules.NEO.result.create', [
            'typeNeos' => $typeNeos
        ]);
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
            NeoResultRule::destroy($id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            echo $e;
        }
        alert()->overlay('Delete NEO Rule', 'Success Delete NEO Rule', 'error');

        return redirect(route('neorule.index'));
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function storeResultRule(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type'  => 'required',
            'sex'   => 'required',
            'level' => 'required',
            'score' => 'required|numeric'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        } else {
            try {
                DB::beginTransaction();
                $neoResultRule          = new NeoResultRule();
                $neoResultRule->sex     = $request->get('sex');
                $neoResultRule->type_id = $request->get('type');
                $neoResultRule->level   = $request->get('level');
                $neoResultRule->score   = $request->get('score');
                $neoResultRule->save();
                DB::commit();
                alert()->overlay('Create NEO Type Rule', 'Success Create Rule', 'success');

                return redirect(route('neorule.index'));
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
    public function editResultRule($id)
    {
        $neoResultRule = NeoResultRule::find($id);
        $typeNeos      = TypeNeo::all();

        return view('admin.rules.NEO.result.edit', [
            'neoResultRule' => $neoResultRule,
            'typeNeos'      => $typeNeos
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
            'type-id' => 'required|numeric',
            'sex'     => 'required',
            'level'   => 'required',
            'score'   => 'required|numeric'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        } else {
            try {
                $neoResultRule = NeoResultRule::find($id);
                DB::beginTransaction();
                $neoResultRule->type_id = $request->get('type-id');
                $neoResultRule->sex     = $request->get('sex');
                $neoResultRule->level   = $request->get('level');
                $neoResultRule->score   = $request->get('score');
                $neoResultRule->save();
                DB::commit();
                alert()->overlay('Update NEO Result Rule', 'Success Update NEO Result Rule', 'success');

                return redirect(route('neorule.index'));
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
    public function editTypeRule($id)
    {
        $neoTypeRule  = NeoTypeRule::find($id);
        $typeNeos     = TypeNeo::all();
        $questionNEOs = QuestionNeo::all();

        return view('admin.rules.NEO.type.edit', [
            'neoTypeRule'  => $neoTypeRule,
            'typeNeos'     => $typeNeos,
            'questionNEOs' => $questionNEOs
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updateTypeRule(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'type-id'    => 'required',
            'questionId' => 'required'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        } else {
            $typeId      = $request->get('type-id');
            $questionIds = $request->get('questionId');
            try {
                DB::beginTransaction();
                $neoTypeRule          = NeoTypeRule::find($id);
                $neoTypeRule->type_id = $typeId;
                $neoTypeRule->content = json_encode($questionIds);
                $neoTypeRule->save();
                DB::commit();
                alert()->overlay('Update NEO Type Rule', 'Success Update NEO Type Rule', 'success');

                return redirect(route('neorule.index'));
            } catch (\Exception $e) {
                DB::rollback();
                echo $e;
                die();
            }
        }
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: tuando
 * Date: 01/11/2018
 * Time: 08:48
 */

namespace App\Http\Controllers;

use App\ExplainQuestionRIASEC;
use App\TypeRiasec;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

/**
 * Class ExplainQuestionRIASECController
 * @package App\Http\Controllers
 */
class ExplainQuestionRIASECController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $exQuestionRIASECs = ExplainQuestionRIASEC::paginate(10);

        return view('admin.Explains.RIASEC.index', [
            'exQuestionRIASECs' => $exQuestionRIASECs
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $typeRiasecs = TypeRiasec::all();
        return view('admin.Explains.RIASEC.create', compact('typeRiasecs'));
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $data      = $request->all();
        $validator = Validator::make($request->all(), [
            'content' => 'required',
            'type'    => 'required'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        } else {
            try {
                DB::beginTransaction();
                $explainQuestionRIASEC = new ExplainQuestionRIASEC();
                $explainQuestionRIASEC->saveExplainQuestionRIASEC($data);
                DB::commit();
                alert()->overlay('Create Explain Question RIASEC', 'Success Create Explain Question RIASEC', 'success');

                return redirect(route('explainriasec.index'));
            } catch (\Exception $e) {
                DB::rollback();
                echo $e;
                die();
            }
        }

    }

    /**
     * @param $riasecId
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($riasecId)
    {
        $exQuestionRIASEC = ExplainQuestionRIASEC::find($riasecId);

        return view('admin.Explains.RIASEC.edit', [
            'exQuestionRIASEC' => $exQuestionRIASEC
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $exQuestionRIASEC          = ExplainQuestionRIASEC::find($id);
            $exQuestionRIASEC->content = $request->get('content');
            $exQuestionRIASEC->save();
            DB::commit();
            alert()->overlay('Update Explain Question RIASEC', 'Success Update Explain Question RIASEC', 'info');

            return redirect(route('explainriasec.index'));
        } catch (\Exception $e) {
            DB::rollback();
            echo $e;
            die();
        }
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            ExplainQuestionRIASEC::destroy($id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            echo $e;
        }
        alert()->overlay('Delete Explain Question RIASEC', 'Success Delete Explain Question RIASEC', 'error');

        return redirect(route('explainriasec.index'));
    }
}
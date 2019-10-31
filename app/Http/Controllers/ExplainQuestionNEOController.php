<?php

namespace App\Http\Controllers;

use App\ExplainQuestionNEO;
use App\TypeNeo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

/**
 * Class ExplainQuestionNEOController
 * @package App\Http\Controllers
 */
class ExplainQuestionNEOController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $exQuestionNEOs = ExplainQuestionNEO::paginate(10);

        return view('admin.Explains.NEO.index', [
            'exQuestionNEOs' => $exQuestionNEOs
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $typeNeos = TypeNeo::all();

        return view('admin.Explains.NEO.create', [
            'typeNeos' => $typeNeos
        ]);
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
            'type'    => 'required',
            'level'   => 'required'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        } else {
            try {
                DB::beginTransaction();
                $explainQuestionNEO = new ExplainQuestionNEO();
                $explainQuestionNEO->saveExplainQuestionNEO($data);
                DB::commit();
                alert()->overlay('Create Explain Question NEO', 'Success Create Explain Question NEO', 'success');

                return redirect(route('explainneo.index'));
            } catch (\Exception $e) {
                DB::rollback();
                echo $e;
                die();
            }
        }
    }

    /**
     * @param ExplainQuestionNEO $explainQuestionNEO
     */
    public function show(ExplainQuestionNEO $explainQuestionNEO)
    {
        //
    }

    /**
     * @param $neoId
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($neoId)
    {
        $exQuestionNEO = ExplainQuestionNEO::find($neoId);

        return view('admin.Explains.NEO.edit', [
            'exQuestionNEO' => $exQuestionNEO
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
            $exQuestionRIASEC          = ExplainQuestionNEO::find($id);
            $exQuestionRIASEC->content = $request->get('content');
            $exQuestionRIASEC->save();
            DB::commit();
            alert()->overlay('Update Explain Question NEO', 'Success Update Explain Question NEO', 'info');

            return redirect(route('explainneo.index'));
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
            ExplainQuestionNEO::destroy($id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            echo $e;
        }
        alert()->overlay('Delete Explain Question NEO', 'Success Delete Explain Question NEO', 'error');

        return redirect(route('explainneo.index'));
    }
}

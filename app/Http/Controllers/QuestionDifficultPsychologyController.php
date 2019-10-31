<?php

namespace App\Http\Controllers;

use App\Exports\QuestionDifficultPsychologyExport;
use App\QuestionDifficultPsychology;
use App\TypePsychology;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

/**
 * Class QuestionDifficultPsychologyController
 * @package App\Http\Controllers
 */
class QuestionDifficultPsychologyController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $questions = QuestionDifficultPsychology::paginate(10);
        $types     = TypePsychology::all();

        return view('admin.questions.Psychology.index', [
            'questions' => $questions,
            'types'     => $types
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $types = TypePsychology::all();

        return view('admin.questions.Psychology.create', compact('types'));
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $question  = $request->all();
        $validator = Validator::make($request->all(), [
            'content'            => 'required',
            'type_psychology_id' => 'required'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        } else {
            try {
                DB::beginTransaction();
                $questionDPL    = new QuestionDifficultPsychology();
                $questionDPL_id = $questionDPL->saveQuestionDifficultPsychology($question);
                DB::commit();
                alert()->overlay('Create QuestionDifficult Psychology', 'Success Create QuestionDifficult Psychology', 'success');

                return redirect(route('psychology.index'));
            } catch (\Exception $e) {
                DB::rollback();
                echo $e;
                die();
            }
        }
    }

    /**
     * @param QuestionDifficultPsychology $questionDifficultPsychology
     */
    public function show(QuestionDifficultPsychology $questionDifficultPsychology)
    {
        //
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $types    = TypePsychology::all();
        $question = QuestionDifficultPsychology::find($id);

        return view('admin.questions.Psychology.edit', compact('question', 'types'
        ));
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $question = $request->all();
        try {
            DB::beginTransaction();
            $questionDPL = QuestionDifficultPsychology::find($id);
            $questionDPL->updateQuestionDifficultPsychology($question);
            DB::commit();
            alert()->overlay('Update Difficult Psychology', 'Success Update Difficult Psychology', 'info');

            return redirect(route('psychology.index'));
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
            QuestionDifficultPsychology::destroy($id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            echo $e;
        }
        alert()->overlay('Delete Question Difficult Psychology', 'Success Delete QuestionDifficult Psychology', 'error');

        return redirect(route('psychology.index'));
    }

    public function export()
    {
        return Excel::download(new QuestionDifficultPsychologyExport(), 'QuestionPsychology.xlsx');
    }

}

<?php

namespace App\Http\Controllers;

use App\Exports\QuestionRiaSecExport;
use App\QuestionRiaSec;
use App\TypeRiasec;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

/**
 * Class QuestionRiaSecController
 * @package App\Http\Controllers
 */
class QuestionRiaSecController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = QuestionRiaSec::paginate(10);

        return view('admin.questions.RIASEC.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $typeRiasecs = TypeRiasec::all();

        return view('admin.questions.RIASEC.create', [
            'typeRiasecs' => $typeRiasecs
        ]);
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
            'content' => 'required',
            'type-id' => 'required'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        } else {
            try {
                DB::beginTransaction();
                $questionRiaSec = new QuestionRiaSec();
                $question_id    = $questionRiaSec->saveQuestionRiaSec($question);
                DB::commit();
                alert()->overlay('Create Question RIASEC', 'Success Create Question RIASEC', 'success');

                return redirect(route('riasec.index'));
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
    public function edit($id)
    {
        $question    = QuestionRiaSec::find($id);
        $typeRiasecs = TypeRiasec::all();

        return view('admin.questions.RIASEC.edit', [
            'question'    => $question,
            'typeRiasecs' => $typeRiasecs
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
        $question = $request->all();
        try {
            DB::beginTransaction();
            $questionRiaSec = QuestionRiaSec::find($id);
            $questionRiaSec->updateQuestionRiaSec($question);
            DB::commit();
            alert()->overlay('Update Question RIASEC', 'Success Update Question RIASEC', 'info');

            return redirect(route('riasec.index'));
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
            QuestionRiaSec::destroy($id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            echo $e;
        }
        alert()->overlay('Delete Question RIASEC', 'Success Delete Question RIASEC', 'error');

        return redirect(route('riasec.index'));
    }

    /**
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export()
    {
        return Excel::download(new QuestionRiaSecExport(), 'QuestionRiasec.xlsx');
    }

}

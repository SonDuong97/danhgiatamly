<?php

namespace App\Http\Controllers;

use App\Exports\QuestionNeoExport;
use App\QuestionNeo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class QuestionNeoController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = QuestionNeo::paginate(10);

        return view('admin.questions.NEO.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.questions.NEO.create', compact(''));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $params  = $request->all();
        $validator = Validator::make($request->all(), [
            'content' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        } else {
            try {
                DB::beginTransaction();
                $questionNeo = new QuestionNeo();
                $question_id = $questionNeo->saveQuestionNeo($params);
                DB::commit();
                alert()->overlay('Create Question NEO', 'Success Create Question NEO', 'success');

                return redirect(route('neo.index'));
            } catch (\Exception $e) {
                DB::rollback();
                echo $e;
                die();
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\QuestionNeo $questionNeo
     *
     * @return \Illuminate\Http\Response
     */
    public function show(QuestionNeo $questionNeo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\QuestionNeo $questionNeo
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = QuestionNeo::find($id);

//        var_dump('111');

        return view('admin.questions.NEO.edit', compact('question'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\QuestionNeo $questionNeo
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $question = $request->all();
        try {
            DB::beginTransaction();
            $questionNeo = QuestionNeo::find($id);
            $questionNeo->updateQuestionNeo($question);
            DB::commit();
            alert()->overlay('Save Question NEO', 'Success Save Question NEO', 'info');

            return redirect(route('neo.index'));
        } catch (\Exception $e) {
            DB::rollback();
            echo $e;
            die();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\QuestionNeo $questionNeo
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            QuestionNeo::destroy($id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            echo $e;
        }
        alert()->overlay('Delete Question NEO', 'Success Delete Question NEO', 'error');

        return redirect(route('neo.index'));
    }

    public function export()
    {
        return Excel::download(new QuestionNeoExport(), 'QuestionNeo.xlsx');
    }

}

<?php

namespace App\Exports;

use App\QuestionRiaSec;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;


class QuestionRiaSecExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $questions =  DB::table('question_ria_secs')
            ->select('content','question_ria_secs.created_at as Created at','type_riasecs.name as Type','question_ria_secs.created_at as created_at')
            ->leftJoin('type_riasecs', 'question_ria_secs.type_id', '=', 'type_riasecs.id')
            ->orderBy('Type', 'asc')
            ->get();

        return view('exports.questionRiaSec', [
            'questions' => $questions
        ]);
    }
}

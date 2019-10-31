<?php

namespace App\Exports;

use App\QuestionDifficultPsychology;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;


class QuestionDifficultPsychologyExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $questions =  DB::table('question_difficult_psychologies')
            ->select('question_difficult_psychologies.content as content','type_psychologies.content as Type','question_difficult_psychologies.created_at as created_at')
            ->leftJoin('type_psychologies', 'question_difficult_psychologies.type_psychology_id', '=', 'type_psychologies.id')
            ->orderBy('Type', 'asc')
            ->get();

        return view('exports.questionRiaSec', [
            'questions' => $questions
        ]);
    }
}

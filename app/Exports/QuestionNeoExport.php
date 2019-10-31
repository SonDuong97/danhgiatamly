<?php

namespace App\Exports;

use App\QuestionNeo;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class QuestionNeoExport implements FromView
{

    public function view(): View
    {
        return view('exports.questionNeo', [
            'questions' => QuestionNeo::all()
        ]);
    }

}

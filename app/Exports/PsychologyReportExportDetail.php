<?php

namespace App\Exports;

use App\Helpers\Helper;
use App\History;
use App\PsychologyReport;
use App\Report;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;


/**
 * Class PsychologyReportExportDetail
 * @package App\Exports
 */
class PsychologyReportExportDetail implements FromView
{

    public function view(): View
    {
        $histories =  DB::table('history')
            ->select('users.name as user_name', 'history.user_id as user_id', 'users.email as user_email', 'history.title as title','history.result as result','history.created_at as created_at')
            ->leftJoin('users', 'history.user_id', '=', 'users.id')
            ->where('history.title', '=', 'Trắc nghiệm sàng lọc tâm lý')
            ->orderBy('user_id', 'asc')
            ->get();
//        dd($histories[0]);
//        dd($histories[0]->result);
//        dd(json_decode($histories[0]->result->content(), true));


        return view('exports.PsychologyReportExportDetail', [
            'histories' => $histories
        ]);
    }
}

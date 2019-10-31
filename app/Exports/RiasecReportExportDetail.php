<?php

namespace App\Exports;

use App\Report;
use App\RiasecReport;
use App\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;


/**
 * Class RiasecReportExportDetail
 * @package App\Exports
 */
class RiasecReportExportDetail implements FromView
{
    public function view(): View
    {
        $histories =  DB::table('history')
            ->select('users.name as user_name', 'history.user_id as user_id', 'users.email as user_email', 'history.title as title','history.result as result','history.created_at as created_at')
            ->leftJoin('users', 'history.user_id', '=', 'users.id')
            ->where('history.title', '=', 'Trắc nghiệm hứng thú nghề nghiệp RIASEC')
            ->orderBy('user_id', 'asc')
            ->get();
//        dd($histories[0]->result);
//        dd(json_decode($histories[0]->result->content(), true));


        return view('exports.RiasecReportExportDetail', [
            'histories' => $histories
        ]);
    }

}

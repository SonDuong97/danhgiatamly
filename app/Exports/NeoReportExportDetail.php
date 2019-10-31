<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

/**
 * Class NeoReportExportDetail
 * @package App\Exports
 */
class NeoReportExportDetail implements FromView
{
    public function view(): View
    {
        $histories =  DB::table('history')
            ->select('users.name as user_name', 'history.user_id as user_id', 'users.email as user_email', 'history.title as title','history.result as result','history.created_at as created_at')
            ->leftJoin('users', 'history.user_id', '=', 'users.id')
            ->where('history.title', '=', 'Trắc nghiệm nhân cách NEO')
            ->orderBy('user_id', 'asc')
            ->get();
//        dd($histories[0]->result);
//        dd(json_decode($histories[0]->result->content(), true));


        return view('exports.NeoReportExportDetail', [
            'histories' => $histories
        ]);
    }
}

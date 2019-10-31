<?php
/**
 * Created by PhpStorm.
 * User: tuando
 * Date: 22/11/2018
 * Time: 22:47
 */

namespace App\Http\Controllers;

use App\Exports\NeoReportExport;
use App\Exports\NeoReportExportDetail;
use App\Exports\PsychologyReportExport;
use App\Exports\PsychologyReportExportDetail;
use App\Exports\RiasecReportExport;
use App\Exports\RiasecReportExportDetail;
use App\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Class ReportController
 * @package App\Http\Controllers
 */
class ReportController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.reports.chart', [
            'userId' => null,
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail(Request $request)
    {
        $searchVal = $request->get('search-val');
        if (!empty($searchVal)) {
            $users = User::where('name', 'like', '%' . $searchVal . '%')
                ->orWhere('email', 'like', '%' . $searchVal . '%')
                ->paginate(5);
        } else {
            $users = User::paginate(5);
        }

        return view('admin.reports.detail_chart', [
            'users' => $users
        ]);
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function userDetail($id)
    {
        return view('admin.reports.chart', [
            'userId' => $id,
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function neoExport()
    {
        return Excel::download(new NeoReportExport, 'neo-report.xlsx');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function psychologyExport()
    {
        return Excel::download(new PsychologyReportExport, 'psychology-report.xlsx');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function riasecExport()
    {
        return Excel::download(new RiasecReportExport, 'riasec-report.xlsx');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function neoExportDetail()
    {
        return Excel::download(new NeoReportExportDetail, 'neo-report-detail.xlsx');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function psychologyExportDetail()
    {
        return Excel::download(new PsychologyReportExportDetail, 'psychology-report-detail.xlsx');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function riasecExportDetail()
    {
        return Excel::download(new RiasecReportExportDetail, 'riasec-report-detail.xlsx');
    }
}
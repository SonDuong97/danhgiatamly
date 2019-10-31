<?php
/**
 * Created by PhpStorm.
 * User: tuando
 * Date: 14/11/2018
 * Time: 08:58
 */

namespace App\Http\Controllers;

use App\ExplainQuestionRIASEC;
use App\History;
use App\User;
use Barryvdh\DomPDF\Facade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class HistoryController
 * @package App\Http\Controllers
 */
class HistoryController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $history = History::where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.history', [
            'history' => $history
        ]);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function historyDetail(Request $request)
    {
        $type = $request->type;
        $id   = $request->id;
        if (!empty($type) && !empty($id)) {
            $history = History::find($id);

            return view('pages.history_detail', [
                'history' => $history,
                'type'    => $type
            ]);
        } else {
            redirect(route('history'));
        }
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function riasecHistoryDetailExportPDF(Request $request)
    {
        $exRiasecQuestions = ExplainQuestionRIASEC::all();
        $id                = $request->id;
        $user_id = $request->user_id ?: Auth::id();
        $user_name = User::findOrFail($user_id)->name;

        if (!empty($id)) {
            $history = History::find($id);
            $pdf     = Facade::loadView('exports.riasec_history_detail_pdf', [
                'history'           => $history,
                'exRiasecQuestions' => $exRiasecQuestions,
                'user_name' => $user_name
            ]);

            return $pdf->stream('riasec-history-detail.pdf');
        }
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function psychologyHistoryDetailExportPDF(Request $request)
    {
        $id = $request->id;
        $user_id = $request->user_id ?: Auth::id();
        $user_name = User::findOrFail($user_id)->name;
        if (!empty($id)) {
            $history = History::find($id);
            $pdf     = Facade::loadView('exports.psychology_history_detail_pdf', [
                'history' => $history,
                'user_name' => $user_name
            ]);

            return $pdf->stream('psychology-history-detail.pdf');
        }
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function neoHistoryDetailExportPDF(Request $request)
    {
        $id = $request->id;
        $user_id = $request->user_id ?: Auth::id();
        $user_name = User::findOrFail($user_id)->name;
        if (!empty($id)) {
            $history = History::find($id);
            $pdf     = Facade::loadView('exports.neo_history_detail_pdf', [
                'history' => $history,
                'user_name' => $user_name
            ]);

            return $pdf->stream('neo-history-detail.pdf');
        }
    }
}
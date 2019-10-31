<?php

namespace App\Http\Controllers\API;

use App\Helpers\ApiResponse;
use App\Helpers\Helper;
use App\History;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index()
    {
        try {
            $histories = History::where('user_id', Auth::user()->id)
                ->select('id', 'title', 'created_at')
                ->orderBy('created_at', 'desc')
                ->get();

            $histories->transform(function ($history) {
                $history->created_at->format('H:i:s D, M, Y ');
                $history->result = json_decode($history->result, true);
                switch ($history->title) {
                    case 'Trắc nghiệm nhân cách NEO':
                        $history->type = 'neo';
                        break;
                    case 'Trắc nghiệm hứng thú nghề nghiệp RIASEC':
                        $history->type = 'riasec';
                        break;
                    default:
                        $history->type = 'psychology';
                        break;
                }
                return $history;
            });

            return ApiResponse::success($histories);
        } catch (\Exception $exception) {
            return ApiResponse::fail(500);
        }
    }

    public function detail(Request $request)
    {
        try {
            $history = History::find($request->id);
            $result = json_decode($history->result, true);
            if ($request->type == 'psychology') {
                $result = collect($result)->map(function ($item) {
                    $item['trouble'] = Helper::getTypePsychologyById($item['typeId'])->content;
                    return $item;
                });
            }
            $history->result = $result;
            return ApiResponse::success($history);
        } catch (\Exception $exception) {
            return ApiResponse::fail(500);
        }
    }
}

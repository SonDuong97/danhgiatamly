<?php

namespace App\Listeners;

use App\Events\UserTestAfter;
use App\NeoReport;
use App\PsychologyReport;
use App\Report;
use App\RiasecReport;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class CreateReport
 * @package App\Listeners
 */
class CreateReport
{
    /**
     * Create the event listener.
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserTestAfter $event
     *
     * @return void
     */
    public function handle(UserTestAfter $event)
    {
        $result   = $event->_result;
        $user     = $event->_user;
        $data     = [
            'userId'       => $user->id,
            'questionType' => $event->_questionType
        ];
        $report   = new Report();
        $reportId = $report->saveReport($data);
        if ($event->_questionType == 'neo') {
            foreach ($result as $value) {
                $neoReport              = new NeoReport();
                $neoReport->report_id   = $reportId;
                $neoReport->type_neo_id = $value['type_id'];
                $neoReport->level       = $value['level'];
                $neoReport->save();
            }
        } elseif ($event->_questionType == 'riasec') {
            $riasecReport              = new RiasecReport();
            $riasecReport->report_id   = $reportId;
            $riasecReport->type_riasec = key($result);
            $riasecReport->save();
        } elseif ($event->_questionType == 'psychology') {
            foreach ($result as $value) {
                $psychologyReport                     = new PsychologyReport();
                $psychologyReport->report_id          = $reportId;
                $psychologyReport->type_psychology_id = $value['typeId'];
                $psychologyReport->score              = $value['score'];
                $psychologyReport->save();
            }
        }
    }
}

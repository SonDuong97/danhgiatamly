<?php
/**
 * Created by PhpStorm.
 * User: tuando
 * Date: 23/11/2018
 * Time: 08:58
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Report
 * @package App
 */
class Report extends Model
{
    /**
     * @var string
     */
    protected $table = 'reports';

    /**
     * @param $data
     *
     * @return mixed
     */
    public function saveReport($data)
    {
        $this->user_id       = $data['userId'];
        $this->question_type = $data['questionType'];
        $this->save();

        return $this->id;
    }
}
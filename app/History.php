<?php
/**
 * Created by PhpStorm.
 * User: tuando
 * Date: 14/11/2018
 * Time: 10:50
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class History
 * @package App
 */
class History extends Model
{
    /**
     * @var string
     */
    protected $table = 'history';

    /**
     * @param $data
     */
    public function saveHistory($data)
    {
        $this->user_id = $data['userId'];
        $this->title   = $data['title'];
        $this->result  = json_encode($data['result']);
        $this->save();
    }
}
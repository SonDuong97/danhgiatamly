<?php
/**
 * Created by PhpStorm.
 * User: tuando
 * Date: 06/12/2018
 * Time: 16:28
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class University
 * @package App
 */
class University extends Model
{
    /**
     * @var string
     */
    protected $table = 'universities';

    protected $hidden = ['created_at', 'updated_at'];

    /**
     * @param $university
     *
     * @return mixed
     */
    public function saveUniversity($university)
    {
        $this->name       = $university['name'];
        $this->speciality = json_encode($university['speciality']);
        $this->save();

        return $this->id;
    }

    /**
     * @param $university
     *
     * @return mixed
     */
    public function updateUniversity($university)
    {
        $this->name       = $university['name'];
        $this->speciality = json_encode($university['speciality']);
        $this->save();

        return $this->id;
    }
}
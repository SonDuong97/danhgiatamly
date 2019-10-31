<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TypePsychology
 * @package App
 */
class TypePsychology extends Model
{
    /**
     * @var string
     */
    protected $table = 'type_psychologies';

    function questions () {
        return $this->hasMany('App\QuestionDifficultPsychology' , 'type_psychology_id');
    }

    function answers () {
        return $this->hasMany('App\PsychologyAnswerRule' , 'type_id');
    }
}

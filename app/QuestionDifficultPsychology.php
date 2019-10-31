<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class QuestionDifficultPsychology
 * @package App
 */
class QuestionDifficultPsychology extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'content',
        'type_psychology_id'
    ];

    /**
     * @var array
     */
    protected $dates = ['date'];

    /**
     * @param $QuestionDifficultPsychology
     *
     * @return mixed
     */
    public function saveQuestionDifficultPsychology($QuestionDifficultPsychology)
    {
        $this->content            = $QuestionDifficultPsychology['content'];
        $this->type_psychology_id = $QuestionDifficultPsychology['type_psychology_id'];
        $this->save();

        return $this->id;
    }

    /**
     * @param $QuestionDifficultPsychology
     *
     * @return bool
     */
    public function updateQuestionDifficultPsychology($QuestionDifficultPsychology)
    {

        $this->content            = $QuestionDifficultPsychology['content'];
        $this->type_psychology_id = $QuestionDifficultPsychology['type_psychology_id'];
        $this->save();

        return true;
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class QuestionRiaSec
 * @package App
 */
class QuestionRiaSec extends Model
{
    const SCORE_SET = [0,0,0.5,1,1];
    const ANSWER_SET = [
        'Hoàn toàn không đúng',
        'Không đúng',
        'Đúng một phần',
        'Đúng',
        'Hoàn toàn đúng'
    ];
    /**
     * @var array
     */
    protected $fillable = [
        'content', 'type_id'
    ];

    /**
     * @var array
     */
    protected $dates = ['date'];

    /**
     * @param $questionRiaSec
     *
     * @return mixed
     */
    public function saveQuestionRiaSec($questionRiaSec)
    {
        $this->content = $questionRiaSec['content'];
        $this->type_id = $questionRiaSec['type-id'];
        $this->save();

        return $this->id;
    }

    /**
     * @param $questionRiaSec
     *
     * @return bool
     */
    public function updateQuestionRiaSec($questionRiaSec)
    {

        $this->content = $questionRiaSec['content'];
        $this->type_id = $questionRiaSec['type-id'];
        $this->save();

        return true;
    }
}

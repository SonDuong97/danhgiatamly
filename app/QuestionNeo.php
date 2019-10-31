<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property bool  reverse_score
 * @property mixed id
 * @property  content
 */
class QuestionNeo extends Model
{
    const SCORE_SET    = [0, 1, 2, 3, 4];
    const ANSWER_SET = [
        "Hoàn toàn sai",
        "Sai",
        "Không đúng cũng không sai",
        "Đúng",
        "Hoàn toàn đúng"
    ];

    protected $fillable = [
        'content',
        'reverse_score'
    ];
    protected $casts    = [
        'reverse_score' => 'boolean',
    ];
    protected $dates    = ['date'];

    public function saveQuestionNeo($questionNeo)
    {
        $this->content = $questionNeo['content'];
        $this->reverse_score = $questionNeo['reverse_score'] == 'true' ? true : false;
        $this->save();
        return $this->id;
    }

    public function updateQuestionNeo($questionNeo)
    {

        $this->content = $questionNeo['content'];
        $this->reverse_score = $questionNeo['reverse_score'] == 'true' ? true : false;
        $this->save();
        return true;
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ExplainQuestionNEO
 * @property mixed content
 * @property mixed convert_content
 * @package App
 */
class ExplainQuestionNEO extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'content',
        'level',
        'type'
    ];

    /**
     * @var array
     */
    protected $dates = ['date'];

    public function getConvertContentAttribute()
    {
        return strip_tags(html_entity_decode($this->content));
    }

    /**
     * @param $ExplainQuestionNEO
     *
     * @return mixed
     */
    public function saveExplainQuestionNEO($ExplainQuestionNEO)
    {
        $this->content = $ExplainQuestionNEO['content'];
        $this->level   = $ExplainQuestionNEO['level'];
        $this->type    = $ExplainQuestionNEO['type'];
        $this->save();

        return $this->id;
    }

    /**
     * @param $ExplainQuestionNEO
     *
     * @return bool
     */
    public function updateExplainQuestionNEO($ExplainQuestionNEO)
    {
        $this->content = $ExplainQuestionNEO['content'];
        $this->level   = $ExplainQuestionNEO['level'];
        $this->type    = $ExplainQuestionNEO['type'];;
        $this->save();

        return true;
    }
}

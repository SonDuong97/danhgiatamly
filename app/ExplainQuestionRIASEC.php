<?php
/**
 * Created by PhpStorm.
 * User: tuando
 * Date: 01/11/2018
 * Time: 08:40
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ExplainQuestionRIASEC
 * @package App
 */
class ExplainQuestionRIASEC extends Model
{
    /**
     * @var string
     */
    protected $table = 'explain_question_r_i_a_s_e_cs';

    /**
     * @param $explainQuestionRIASEC
     *
     * @return mixed
     */
    public function saveExplainQuestionRIASEC($explainQuestionRIASEC)
    {
        $this->content = $explainQuestionRIASEC['content'];
        $this->type    = $explainQuestionRIASEC['type'];
        $this->save();

        return $this->id;
    }

    /**
     * @param $explainQuestionRIASEC
     *
     * @return bool
     */
    public function updateExplainQuestionRIASEC($explainQuestionRIASEC)
    {
        $this->content = $explainQuestionRIASEC['content'];
        $this->type    = $explainQuestionRIASEC['type'];
        $this->save();

        return true;
    }
}
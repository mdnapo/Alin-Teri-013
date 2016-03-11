<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    //
    protected $fillable = ['category', 'question', 'answer'];
    // ID
    private $id;
    // Category
    private $category;
    // Question
    private $question;
    // Answer
    private $answer;

    /**
     * Gets QA ID
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Gets QA category
     * @return int
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Sets category
     * @param $category
     * @return void
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * Returns question.
     * @return string
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Sets question.
     * @param $question
     * @return void
     */
    public function setQuestion($question)
    {
        $this->question = $question;
    }

    /**
     * Gets answer
     * @return string
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * Sets answer
     * @param $answer
     * @return void
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;
    }
}

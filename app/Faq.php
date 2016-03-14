<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    /**
     * Guarded
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Get the complete faq.
     * @return array
     */
    public function getCompleteFaq(){
        $completeFaq = \Faq::all();
        return $completeFaq;
    }

    /**
     * Get all questions by category.
     * @param $category
     * @return array
     */
    public function getFaqByCategory($category){
        $available = [];
        $faqs = \Faq::where('cat_name', '=', $category);
        while($faq = count($faqs)){
            array_push($available, $faqs[$faq]);
            $faq++;
        }
        return $available;
    }
}

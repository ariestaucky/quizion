<?php

namespace App;

use App\Quiz;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $casts = [
        'question' => 'array'
    ];

    public function quiz(){
        return $this->belongsTo('App\Quiz');
    }

    public function scopeDetail($query, $id){
        return $query->join('quizzes', 'quizzes.id', 'questions.quiz_id')
                        ->where('quiz_id', $id);
    }

    public function scopeQue($query, $id){
        return $query->where('quiz_id', $id);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test_taker extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function quiz(){
        return $this->belongsTo('App\Quiz');
    }

    public function scopePeople($query, $id){
        return $query->join('quizzes', 'quizzes.id', 'test_takers.quiz_id')
        ->where('quizzes.author_id', $id)
        ->select('test_takers.*', 'quizzes.*', 'test_takers.created_at as date')
        ->orderBy('date', 'desc');
    }

    public function scopeTaken($query, $id){
        return $query->where('user_id', $id);
    }

    public function scopeCheck($query, $id, $user_id){
        return $query->where('quiz_id', $id)
        ->where('user_id', $user_id);
    }

    public function scopeGuest($query, $id, $status){
        return $query->where('quiz_id', $id)
        ->where('status', $status);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $guarded = [];

    public function author(){
        return $this->belongsTo('App\User', 'author_id');
    }
    
    public function question(){
        return $this->hasMany('App\Question', 'quiz_id');
    }

    public function taker(){
        return $this->hasMany('App\Test_taker');
    }

    public function getCatagoryAttribute($attribute){
        return [
            '1' => 'Multiple Choices',
            '2' => 'True/False',
        ][$attribute];
    }

    public function scopeDetail($query, $request){
        return $query->where('catagory', $request->catagory)
        ->where('subject', $request->subject)
        ->where('quantity', $request->quantity);
    }

    public function scopeList($query, $id){
        return $query->where('author_id', $id)->orderBy('created_at', 'DESC')->paginate(20);
    }
}

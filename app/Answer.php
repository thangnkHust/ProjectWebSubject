<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = ['body', 'user_id'];
    
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function boot()
    {
        parent::boot();

        static::created(function($answer){
            $answer->question->increment('answers_count');
            // $answer->question->save();
        });

        static::deleted(function($answer){
            $answer->question->decrement('answers_count');
        });
    }

    public function getCreatedDateAttribute(){
        return $this->created_at->diffForHumans();
    }

    public function getStatusAttribute()
    {
        return $this->is_best ? 'vote-accepted' : '';
    }

    public function getIsBestAttribute(Type $var = null)
    {
        return $this->id === $this->question->best_answer_id;
    }
}

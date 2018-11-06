<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title','image','content'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function category()
    {
        return $this->belongsToMany('App\Category')->withTimestamps();
    }

    public function getTagListAttribute()
    {
        return $this->categories->pluck('id')->all();
    }


}

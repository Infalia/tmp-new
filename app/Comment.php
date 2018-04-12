<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'parent_id',
        'initiative_id',
        'user_id',
        'user_fullname',
        'body',
    ];

    /**
     * Get the initiative that owns the comment.
     */
    public function initiative()
    {
        return $this->belongsTo('App\Initiative');
    }

    /**
     * Get the user that owns the comment.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}

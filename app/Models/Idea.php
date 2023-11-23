<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    use HasFactory;
    protected $fillable = [
        "content",
        'user_id'
    ];

    protected $with = [
        'users',
        'comments'
    ];

    protected $withCount = ['Idealikes'];

    public function comments()
    {
        return $this->hasMany(Comment::class, 'idea_id', 'id');
        //idea_id is the name of the foreign key
        //and id is the primary key in the table in the database
        //it's not necessary to add them any ways
    }
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function Idealikes()
    {
        //here first slot is the current model slot and the second slot is the related model slot
        return $this->belongsToMany(User::class, 'idea_like', 'idea_id', 'user_id')->withTimestamps();
    }
}

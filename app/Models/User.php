<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Idea;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'bio',
        'image'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function ideas(){
        return $this->hasMany(Idea::class)->latest(); //latest is same as OrderBy('creatd_at','DESC');
    }
    public function comments(){
        return $this->hasMany(Comment::class,'user_id','id');
    }

    //let's define the many to many functions between the user and the follower
    public function followings(){
        //here we are gonna get the people we are following, so we are the followers aka foregin pivot key 'cause actually people are pointing at us
        //and people are the followed aka related pivot key
        return $this->belongsToMany(User::class,'follower_user','follower_id','user_id')->withTimestamps();
    }
    public function followers(){
        //things are reversed here we are the user and we want to get the people who we are pointing at.
        return $this->belongsToMany(User::class,'follower_user','user_id','follower_id')->withTimestamps();
    }
    public function follows(User $user){
        return $this->followings()->where('user_id',$user->id)->exists();
    }
    public function Userlikes(){
        return $this->belongsToMany(Idea::class,'idea_like')->withTimestamps();
    }

    public function hasLiked(Idea $idea){
        return $this->Userlikes()->where('idea_id',$idea->id)->exists();
    }

    // public function hasLiked(Idea $idea){
    //     return $this->likes()->where('idea_id',$idea->id)->exists();
    // }

    public function getImageURL(){
        if($this->image){
            return url('storage',$this->image);
        }
        return 'https://api.dicebear.com/6.x/fun-emoji/svg?seed='.$this->name;

    }
}

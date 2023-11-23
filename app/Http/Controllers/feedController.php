<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Idea;
use App\Models\User;

class feedController extends Controller
{
    public function __invoke()
    {
        $followingsId = auth()->user()->followings()->pluck('user_id');
        $ideas = Idea::whereIn('user_id',$followingsId)->orWhere('user_id',auth()->id())->latest();
        return view('feed',[
            'ideas' => $ideas->paginate(5)
        ]);
    }
}

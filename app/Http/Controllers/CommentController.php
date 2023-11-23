<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use App\Models\Idea;

class CommentController extends Controller
{
    public function store(Idea $idea){
        request()->validate([
            'comment_content' => 'required|min:1|max:255'
        ]);
        $comment = Comment::create([
            'content'=>request()->get('comment_content'),
            'idea_id' => $idea->id,
            'user_id' => auth()->user()->id
        ]);
        return redirect()->route('idea.show',$idea->id)->with('success','comment posted successfully!');
    }

    public function delete(Comment $comment){
        $this->authorize('comment.delete',$comment);
        $comment->delete();
        return back()->with('success','deleted comment successfully!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;

class IdeaController extends Controller
{

    //u got to always remember that whever we type Idea $idea we are recieving an Id not
    //a record and laravel is so smart that with model binding it will turn the id into Idea
    public function store()
    {

        request()->validate([
            //u must use the name of the element in the html form
            'idea' => 'required|min:5|max:1000'
        ]);

        $idea = Idea::create([
            'content' => request()->get('idea'),
            'user_id' => auth()->user()->id
        ]);

        return back()->with('success', 'idea was created successfully!');
    }
    public function destroy(Idea $idea)
    {
        $this->authorize('idea.delete',$idea);
        $idea->delete();
        //you can tell laravel that this is id for the idea database using models
        // $idea = Idea::where('id', $id)->first();
        // if ($idea != null) {
        //     $idea->delete();
        // }
        return redirect()->route('dashboard')->with('success', 'idea deleted successfully!');
    }
    public function show(Idea $idea){
        return view('someFiles.show_idea_card',[
            "idea"=>$idea
        ]);
    }
    public function edit(Idea $idea){
        $this->authorize('update',$idea); //you can use gates in providers or u can use policies
        $editing = true;
        return view('someFiles.show_idea_card',[
            'idea'=>$idea,
            'editing'=>$editing
        ]);
    }
    public function update(Idea $idea){
        $this->authorize('idea.edit',$idea);
        request()->validate([
            'idea'=>'required|min:5|max:1000'
        ]);
        $idea->content = request()->get('idea','');
        $idea->save();
        // $id->update($validated);
        return redirect()->route('dashboard')->with('success','idea edited successfully!');
    }
}

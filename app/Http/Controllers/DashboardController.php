<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailables\Content;
use League\CommonMark\Extension\SmartPunct\EllipsesParser;

class DashboardController extends Controller
{

    public function index()
    {
        // if(!(auth()->check())){
        //     return redirect()->route('login');
        // }
        $ideas = Idea::with('users', 'comments.users')->OrderBy('created_at', 'DESC');

        // $json = $ideas->get();
        // return response()->json($json,200,[],JSON_PRETTY_PRINT);
        return view('Dashboard', [
            'ideas' => $ideas->paginate(5)
        ]);
    }
    public function search()
    {
        $ideas = Idea::OrderBy('created_at', 'DESC');
        if (request()->has('search')) {
            // if(request('search') == ''){
            //     return redirect()->route('dashboard');
            // }
            //you can use required instead in the html form
            $ideas = $ideas->where('content', 'like', '%' . request()->get('search', '') . '%');
            if ($ideas->count() == 0) {
                return redirect()->route('dashboard')->with('failure', 'no match was found!');
            }
        }


        return view('search-page', [
            'ideas' => $ideas->paginate(3),
            'search_word' => request()->get('search')
        ]);
    }
}

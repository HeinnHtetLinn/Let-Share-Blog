<?php

namespace App\Http\Controllers;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $data=Article::all();
        return view('home', [
            "articles" => $data
        ]);
    }

    public function upload(Request $request)
    {
        if($request->hasFile('avatar'))
        {
            $filename = $request->avatar->getClientOriginalName();
            $request->avatar->storeAs('avatars',$filename,'public');
            Auth()->user()->update(['avatar'=>$filename]);
        }

        return redirect()->back();

    }
}

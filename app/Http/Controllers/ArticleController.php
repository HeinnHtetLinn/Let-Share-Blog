<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Gate;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;

class ArticleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index','detail']);
    }

    public function index()
    {
        $data = Article::latest()->paginate(5);
        return view("articles.index", [
            "articles"=>$data
        ]);
    }
    public function detail($id)
    {
        $data = Article::find($id);
        return view("articles.detail", [
            "article" => $data
        ]);
    }
    public function add()
    {
        $data = Category::all();

        return view("articles.add",[
            'categories'=>$data
        ]);

        // $articleData = Article::all();
        // return view("articles.add", [
        //     'articles' => $articleData
        // ]);
    }

    public function create()
    {   

        $validator = validator(request()->all(),[
            'title' => 'required',
            'body' => 'required',
            'category_id'=>'required',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }
        
        $article = new Article;
        $article->title = request()->title;
        $article->body = request()->body;
        $DataExt = $_FILES['data']['type'];

        print_r($DataExt);
        
        if(request()->hasFile('data')){
            if($DataExt === 'image/jpg' or $DataExt === 'image/jpeg' or $DataExt === 'image/png'){
                $filename = request()->data->getClientOriginalName();
                request()->data->storeAs('photos',$filename,'public');
                $article->photo = $filename;
            }elseif($DataExt === 'video/mp4'){
                $filename = request()->data->getClientOriginalName();
                request()->data->storeAs('videos',$filename,'public');
                $article->video = $filename;
            }
        }
        $article->category_id = request()->category_id;
        $article->user_id = auth()->user()->id;
        $article->save();

        return redirect('/articles');
    }

    public function delete($id)
    {
      $article = Article::find($id);
      if(Gate::allows('article-delete',$article)){
        $article->delete();
        return redirect('/articles')->with('info', 'Article deleted');
    }else{
        return back()->with('error','Unauthorize');
    }

      
    }
}

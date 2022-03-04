@extends("layouts.app")
@section("content")

    <div class="container">
        <div class="card mb-2">
            <div class="d-flex justify-content-between align-items-center">
                <div class="user">
                    <img class="image rounded-circle" src="{{asset('/storage/avatars/'.$article->user->avatar)}}" alt="author_image" style="width: 60px;height:60px; padding: 10px; margin: 0px;">
                    <b>{{$article->user->name}}</b>
                </div>
                
                <a href='{{url("/articles/delete/$article->id")}}' class="btn btn-warning mx-2">
                    Delete
                </a>  
            </div>
            <div class="card-body">
                <h5 class="card-title">{{$article->title}}</h5>
                <div class="card-subtitle mb-2 text-muted small">
                    {{$article->created_at->diffForHumans()}},
                    Category: <b>{{$article->category->name}}</b>,
                    
                </div>
                <p class="card-text">{{$article->body}}</p>
                @if($article->photo == null)
                @else
               <a href="{{asset('/storage/photos/'.$article->photo)}}">
               <img src="{{asset('/storage/photos/'.$article->photo)}}" alt="article_photo" class="image-responsive" style="width: 250px;height:250px; padding: 10px; margin: 0px;">
               </a> 
                @endif
                @if($article->video == null)
                @else
                <video src="{{asset('/storage/videos/'.$article->video)}}" controls type="video/mp4"></video>
                @endif
            </div>
        </div>
        <ul class="list-group mb-2">
            <li class="list-group-item active">
                <b>Comments({{count($article->comments)}})</b>
            </li>
            
            
            @foreach($article->comments as $comment)  
            <div class="d-flex py-2">
            <img class="image rounded-circle" src="{{asset('/storage/avatars/'.$comment->user->avatar)}}" alt="comment_image" style="width: 50px;height:50px; padding: 10px; margin: 0px;">
                <div>
                <li class="list-group-item" style="border-radius: 20px;">
                    <b>{{$comment->user->name}}</b><br>
                    
                    {{$comment->content}}
                    
                     
                </li>
                <div class="small mt-1 mx-1">
                        
                        {{$comment->created_at->diffForHumans()}}
                        <a href='{{url("/comments/delete/$comment->id")}}' class="px-2 text-decoration-none text-black" ><b>Delete</b></a>
                </div>
                </div>
                
            </div>
            
                
              
            @endforeach
        </ul>
        @auth
        @if($errors->any())
            <div class="alert alert-warning">
                <ol>
                    @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
                </ol>
            </div>
        @endif
        <form action="{{url('/comments/add')}}" method="post">
        @csrf
        <div class="d-flex">
            <input type="hidden" name="article_id" value="{{$article->id}}">
            <textarea name="content" id="content" class="form-control" placeholder="New Comment"></textarea>
            <button type="submit" class="btn btn-secondary mx-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send-fill" viewBox="0 0 16 16">
  <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083l6-15Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z"/>
</svg>
            </button>
        </div>

        </form>
            
        @endauth
    </div>
@endsection
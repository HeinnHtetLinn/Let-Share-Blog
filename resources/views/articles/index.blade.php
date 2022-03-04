@extends ("layouts.app")
@section("content")
<div class="m-0" style="overflow:hidden !important;">

    <div class="px-md-5">
        <div class="container-fluid px-sm-0 px-xs-0 ">
            @if(session('info'))
                <div class="alert alert-info">
                    {{session('info')}}
                </div>
            @endif

            {{$articles->links()}}
            @foreach($articles as $article)
                <div class="card mb-2">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                        <img src="{{asset('/storage/avatars/'.$article->user->avatar)}}" alt="user_img" class="image rounded-circle" style="width: 50px;height:50px; padding: 10px; margin: 0px;">
                            <div class="d-flex" style="flex-direction: column;">
                            <b>{{$article->user->name}}</b>
                            <div class="card-subtitle text-muted small">
                            {{$article->created_at->diffForHumans()}}
                            </div>
                            </div>
                        </div>
                            
                            
                            <h5 class="card-title">{{$article->title}}</h5>
                        

                        
                        <p class="card-text">{{$article->body}}</p>
                        @if($article->photo == null)
                        @else
                            <a href="{{asset('/storage/photos/'.$article->photo)}}">
                            <img src="{{asset('/storage/photos/'.$article->photo)}}" alt="article_photo" class="image-responsive" style="width: 250px;height:250px; padding: 10px; margin: 0px;">
                            </a> 
                        @endif
                        @if($article->video == null)
                        @else
                        <video src="{{asset('/storage/videos/'.$article->video)}}" controls type="video/mp4" width="320" height="240"></video>
                        @endif
                        <a href='{{url("/articles/detail/$article->id")}}' class="card-link d-block" >
                            View Details &raquo;
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- <div class="col-md-2 d-none d-md-block sticky d-block">
        <div class="container">
            <a href="#">Hello World</a>
        </div>
    </div> -->
    
</div>
@endsection
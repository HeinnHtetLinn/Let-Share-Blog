@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                
                
                <div class="card-body">
                @auth
                    @if(Auth::user()->avatar)
                        
                        
                        
                        <form action="{{route('home')}}" method="POST" enctype="multipart/form-data">
                       <div class="upload position-relative" style="width: 90px; margin:auto">
                            <img class="image rounded-circle border border-3" src="{{asset('/storage/avatars/'.Auth::user()->avatar)}}" alt="profile_image" style="width: 90px;height: 90px; padding: 0px; margin: 0px; ">
                       
                        @csrf
                        <div class="round">
                        <input type="file" class="input" name="avatar">
                        <i class="fas fa-camera" ></i>
                        
                            
                        </div>
                        
                        </div> 
                        <b class="text-center d-block">{{Auth::user()->name}}</b>
                        <input type="submit" class="btn btn-primary" value="Upload"> 
                        </form>
                        
                        
                                    
                    @endif
                @endauth
                    
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- {{ __('You are logged in!') }} -->
                </div> 
                    <div class="container px-5">
                    @foreach($articles as $article)
                        @if(Auth::user()->id == $article->user_id)
                        <div class="card-header bg-dark text-white">
                            {{$article->title}}
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots float-end dropdown-toggle" id="navbarDropdown" data-bs-toggle="dropdown" viewBox="0 0 16 16" style="cursor: pointer;">
                            <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/>
                            </svg>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a href='{{url("/articles/delete/$article->id")}}' class="dropdown-item">Delete</a>
                            </div>
                            <br>
                            Author:{{Auth::user()->name}};
                            <b>Category:</b>{{$article->category->name}}
                            <p class="float-end"><a class="link-info" href='{{url("/articles/detail/$article->id")}}'>details...</a></p>
                        </div>
                        <div class="card-body mb-3 bg-dark bg-gradient text-white">
                            {{$article->body}}
                        </div>
                        @endif
                        
                    @endforeach
                    </div>


                
                
            </div>
        </div>
    </div>
</div>
@endsection

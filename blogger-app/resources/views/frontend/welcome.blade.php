@extends('layouts.site.app')
@section('frontend-title' , 'DEVBlog | Home')
@section('frontend-styles')
@endsection
@section('frontend-content')

<header class="home-header">
    <h1 class="header-text">Your ocean of <span class="second-color">Dev</span> posts is here ! </h1>
</header>

<div class="home-page">
    <div class="row">
        <div class="col-md-8">
           <div class="posts">

               @if($posts->count() > 0)
                   @foreach($posts as $post)
                       <div class="home-single-post">
                           <div class="post-info">
                               <a href="{{route('site.post-details' , $post->id)}}"  class="post-title captalized">
                                   {{ $post->short_title }}
                               </a>
                               <div class="post-header">
                                   <div class="author">
                                       <div class="author-image">
                                           @if(!empty($post->user->avatar))
                                               <img style="height: 40px;width: 40px" class="rounded-circle" src="{{asset('backend/uploads/users/' . $post->user->avatar)}}" alt="user-image">
                                           @else
                                               <img style="height: 40px;width: 40px" class="rounded-circle" src="{{asset('backend/uploads/users/user.png')}}" alt="user-image">
                                           @endif
                                       </div>

                                       <div class="author-info">
                                           <h4 class="captalized">
                                               <a href="{{route('author.profile',$post->user->id)}}" class="author-name">{{$post->user->name}}</a>
                                           </h4>
                                           <span class="post-date">
                                               <i class="fa fa-calendar"></i>
                                               {{$post->created_at}}
                                           </span>
                                       </div>
                                   </div>
                               </div>
                           </div>

                           @if(!empty($post->post_image))
                           <div class="post-image">
                                   <img class="img-fluid img-thumbnail" src="{{asset('backend/uploads/posts/' . $post->post_image)}}" alt="post-image">

                               <div class="post-category">
                                   <a href="#">
                                       <i class="fa fa-copy"></i>
                                       {{$post->category->name}}
                                   </a>
                               </div>
                           </div>
                           @endif

                           <div class="contorls d-flex justify-content-between align-items-center p-2">
                               <span>
                                   <i class="main-color fa fa-comment"></i>
                                   {{ $post->comments->count() }} Comments
                               </span>

                               <span>
                                   @if(Auth::check())
                                   <a class="add-to-fav-btn" href="{{route('posts.favorites' , $post->id)}}">
                                       @if($currentUser->favPosts->count() > 0 && $currentUser->favPosts->contains($post->id) )
                                           <i class="fa second-color fa-heart"></i> <span>Remove from favorite</span>
                                       @else
                                           <i class="fa second-color fa-heart-o"></i> <span>Add to favorite </span>
                                       @endif
                                   </a>
                                   @endif
                               </span>

                           </div>
                           <article class="post-content">
                             {{$post->short_content}}
                               <a href="{{route('site.post-details' , $post->id)}}" class="second-color read-more">read more</a>
                           </article>



                       </div>
                   @endforeach
               @endif


           </div>
        </div>
        <div class="col-md-4">
            <div class="filters-side">

                <div class="card">
                    <div class="card-header bg-main-color">
                     Categories
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            @if($categories->count() > 0)
                                @foreach($categories as $category)
                                    <li class="list-group-item   ">
                                       <a href="{{route('show.category' , $category->id)}}" class="d-flex justify-content-between align-items-center">
                                           {{$category->name}}
                                           <span class="badge bg-second-color rounded-pill">
                                               {{$category->posts->count()}}
                                           </span>
                                       </a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>


                <div class="card mt-5">
                    <div class="card-header bg-main-color">
                        Tags
                    </div>
                    <div class="card-body">
                            @if($tags->count() > 0)
                                @foreach($tags as $tag)

                                        <a href="{{route('tag.posts' , $tag->id)}}" class="badge bg-second-color  p-2">
                                            #{{$tag->tag_name}}
                                        </a>
                                @endforeach
                            @endif
                    </div>
                </div>



                <div class="card mt-5">
                    <div class="card-header bg-main-color">
                        Latest posts
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                        @if($latestPosts->count() > 0)
                            @foreach($latestPosts as $post)
                                <li class="list-group-item">
                                    <i class="fa fa-chevron-right main-color"></i>
                                    <a href="#">
                                        {{Str::limit($post->title , 40 ,'..')}}
                                    </a>
                                </li>

                            @endforeach
                        @endif
                        </ul>
                    </div>
                </div>



                <div class="card mt-5">
                    <div class="card-header bg-main-color">
                        Ads
                    </div>
                    <div class="card-body">

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>















@endsection
@section('frontend-styles')
@endsection

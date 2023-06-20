@extends('layouts.site.app')
@section('frontend-title' , 'blogger website')
@section('frontend-styles')
@endsection
@section('frontend-content')

    <div class="show-favorites">
        <header class="favorite-header">
            <div class="intro">
                <h2 class="">
                    Favorite Posts({{$favPosts->count()}})
                </h2>
            </div>
        </header>

        <div class="container">
            <div class="user-posts mt-2">
                @if(!empty($favPosts))
                    @foreach($favPosts as $post)
                        <div class="user-single-post">

                            <div class="post-image">
                                @if(!empty($post->post_image))
                                    <img  class="" src="{{asset('backend/uploads/posts/' . $post->post_image)}}" alt="user-image">
                                @else
                                    <img  class="" src="{{asset('backend/uploads/posts/default-post.png')}}" alt="post-image">
                                @endif
                                <span class="category">{{$post->category->name}}</span>
                            </div>
                            <div class="post-details">
                                <h3 class="captalized">
                                    <a class="" href="{{route('site.post-details' ,$post->id)}}">{{$post->short_title}}</a>
                                </h3>
                                <span class="post-date"><i class="fa fa-calendar"></i> {{$post->created_at}}</span>
                                <p>{{$post->short_content}}</p>
                                <div class="d-flex justify-content-between align-items-center mt-auto">
                                    <p class="m-0">
                                        <i class="fa fa-tags"></i>
                                        Tags:
                                        @if($post->tags->count() > 0)
                                            @foreach($post->tags as $tag)
                                                <span class="second-color me-1">#{{$tag->tag_name}}</span>
                                            @endforeach
                                        @endif
                                    </p>
                                    <span class="comments-count">
                                                   <i class="fa fa-comment"></i>
                                                   {{$post->comments->count()}}
                                    </span>
                                </div>
                            </div>
                        </div>

                    @endforeach
                @endif
            </div>
        </div>
    </div>




@endsection
@section('frontend-scripts')
@endsection

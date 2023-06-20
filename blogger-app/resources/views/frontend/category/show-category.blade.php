@extends('layouts.site.app')
@section('frontend-title' , 'blogger website')
@section('frontend-styles')
@endsection
@section('frontend-content')

        <div class="show-category">
            <header class="category-header">
                <div class="intro">
                    <img class="img-thumbnail img-fluid" src="{{asset('backend/uploads/categories/' . $category->category_image)}}">
                    <div class="intro-text">
                        <h2>{{$category->name}}</h2>
                        <p>{{$category->description}} Category</p>
                    </div>
                </div>
            </header>

            <div class="container">
                <div class="category-posts mt-2">
                   <div class="row">
                       @if($category->posts->count() > 0)
                           @foreach($category->posts as $post)
                               <div class="col-md-6">
                                   <div class="category-single-post">
                                       <a class="" href="{{route('site.post-details' ,$post->id)}}">

                                           <div class="post-image">
                                               @if(!empty($post->post_image))
                                                   <img  class="" src="{{asset('backend/uploads/posts/' . $post->post_image)}}" alt="user-image">
                                               @else
                                                   <img  class="" src="{{asset('backend/uploads/posts/default-post.png')}}" alt="post-image">
                                               @endif
                                               <span class="category">{{$post->category->name}}</span>
                                           </div>
                                           <div class="post-details">
                                               <h3>{{Str::limit($post->short_title , 50 , '..')}}</h3>
                                               <span><i class="fa fa-calendar"></i> {{$post->created_at}}</span>
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
                                       </a>
                                   </div>

                               </div>
                           @endforeach
                       @endif
                   </div>
                </div>
            </div>
        </div>




@endsection
@section('frontend-scripts')
@endsection

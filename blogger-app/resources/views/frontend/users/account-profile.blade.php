@extends('layouts.site.app')
@section('frontend-title' , 'Account Profile')
@section('frontend-styles')
@endsection
@section('frontend-content')

    <div class="container">

        <div class="account-profile author-profile">

            <div class="author-intro d-flex justify-content-between align-items-center">

                <div class="d-flex justify-content-between align-items-center">
                    <div class="author-image">
                        @if(!empty($author->avatar))
                            <img style="height: 150px;width: 150px" class="rounded-circle" src="{{asset('backend/uploads/users/' . $author->avatar)}}" alt="user-image">
                        @else
                            <img style="height: 150px;width: 150px" class="rounded-circle" src="{{asset('backend/uploads/users/user.png')}}" alt="user-image">
                        @endif
                    </div>
                    <div class="author-basic">
                        <h2 class="author-name">{{$author->name}}</h2>
                        <h4 class="author-email">{{$author->email}}</h4>
                   </div>
                </div>

                @if(auth()->user())
                <a class="button bg-second-color" href="{{route('account.edit-profile')}}">
                    <i class="fa fa-cogs"></i> Edit Account
                </a>
                @endif

            </div>


            <div class="navigations">
                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-about-tab" data-bs-toggle="pill" data-bs-target="#pills-about" type="button" role="tab" aria-controls="pills-about" aria-selected="true">About</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-posts-tab" data-bs-toggle="pill" data-bs-target="#pills-posts" type="button" role="tab" aria-controls="pills-posts" aria-selected="false">Posts</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Contact</button>
                    </li>

                </ul>
            </div>


            <div class="tab-content author-contents" id="pills-tabContent">

                <div class="tab-pane fade show active" id="pills-about" role="tabpanel" aria-labelledby="pills-about-tab" tabindex="0">
                    <h3 class="content-title">About Me</h3>
                    <article class="about-author">
                        <q> {{$author->about}}  </q>
                    </article>
                    <ul class="list-unstyled">

                        <li class="list-group-item">
                            <span class="key">
                              <i class="fa fa-file"></i> Number of posts:
                            </span>
                            <span class="value"> {{$author->posts->count()}} </span>
                        </li>

                        <li class="list-group-item">
                            <span class="key">
                               <i class="fa fa-calendar"></i> Joined in:
                            </span>
                            <span class="value">{{$author->created_at}} </span>
                        </li>


                    </ul>
                </div>

                <div class="tab-pane fade" id="pills-posts" role="tabpanel" aria-labelledby="pills-posts-tab" tabindex="0">
                    <h3 class="content-title">My Posts</h3>
                    <div class="user-posts">
                        @if(!empty($author_posts))
                            @foreach($author_posts as $author_post)
                                <div class="user-single-post">

                                    <div class="post-image">
                                        @if(!empty($author_post->post_image))
                                            <img  class="" src="{{asset('backend/uploads/posts/' . $author_post->post_image)}}" alt="user-image">
                                        @else
                                            <img  class="" src="{{asset('backend/uploads/posts/default-post.png')}}" alt="post-image">
                                        @endif
                                        <span class="category">{{$author_post->category->name}}</span>
                                    </div>
                                    <div class="post-details">
                                        <h3 class="captalized">
                                            <a class="" href="{{route('site.post-details' ,$author_post->id)}}">{{Str::limit($author_post->short_title , 50 , '..')}}</a>
                                        </h3>
                                        <span class="post-date"><i class="fa fa-calendar"></i> {{$author_post->created_at}}</span>
                                        <p>{{$author_post->short_content}}</p>
                                        <div class="d-flex justify-content-between align-items-center mt-auto">
                                            <p class="m-0">
                                                <i class="fa fa-tags"></i>
                                                Tags:
                                                @if($author_post->tags->count() > 0)
                                                    @foreach($author_post->tags as $tag)
                                                        <span class="second-color me-1">#{{$tag->tag_name}}</span>
                                                    @endforeach
                                                @endif
                                            </p>
                                            <span class="comments-count">
                                                   <i class="fa fa-comment"></i>
                                                   {{$author_post->comments->count()}}
                                               </span>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">
                    <h3 class="content-title">Contact Me</h3>
                    <form class="contact-author" action="" method="POST">
                        @csrf

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="label-form">FullName</label>
                                    <input class="form-control" type="text" name="fullname" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="label-form">Email</label>
                                    <input class="form-control" type="email" name="email" required>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="label-form">Leave a Message</label>
                                    <textarea class="form-control" rows="5" required></textarea>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group text-end">
                                    <input type="submit" value="send message" class="button bg-second-color">
                                </div>
                            </div>

                        </div>

                    </form>
                </div>

            </div>

        </div>

    </div>
@endsection

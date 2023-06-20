@extends('layouts.site.app')
@section('frontend-title' , 'DevBlog | Show Post Details')
@section('frontend-styles')
@endsection
@section('frontend-content')

<div class="container">


<div class="post-view">
    <div class="row">
        <div class="col-md-8">
            <div class="post-details">
                <a href="#"  class="post-title">{{ $post->title }}</a>
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
                           <a href="{{route('author.profile',$post->user->id)}}" class="author-name">{{$post->user->name}}</a>
                           <span class="post-date">
                           <i class="fa fa-calendar"></i>
                           {{$post->created_at}}
                        </span>
                       </div>
                     </div>

                       <a class="add-to-fav-btn" href="{{route('posts.favorites' , $post->id)}}">
                           @if($currentUser->favPosts->count() > 0 && $currentUser->favPosts->contains($post->id) )
                               <i class="fa second-color fa-heart"></i> <span>Remove from favorite</span>
                           @else
                               <i class="fa second-color fa-heart-o"></i> <span>Add to favorite </span>
                           @endif
                       </a>

                 </div>

                 <div class="post-image">
                   @if(!empty($post->post_image))
                       <img class="img-thumbnail img-fluid" alt="post-image" src="{{ asset('backend/uploads/posts/' . $post->post_image) }}">
                   @endif
                       <div class="post-category">
                           <a href="#">
                               <i class="fa fa-copy"></i>
                               {{$post->category->name}}
                           </a>
                       </div>
               </div>

                 <article class="post-content">
                    {!! $post->content !!}
                </article>

                 <div class="post-tags">
                     <span class="tags">
                         <i class="fa fa-tags"></i> Tags:
                     </span>

                    @if($post->tags->count() > 0)
                        @foreach ($post->tags as $tag )
                            <span class="single-tag">
                                <a href="{{route('tag.posts' , $tag->id)}}">
                                 #{{ $tag->tag_name }}
                                </a>
                            </span>
                        @endforeach
                    @endif
                </div>



                  <div class="post-comments mb-5">

                       <h4>Add New Comment</h4>

                    @if(auth()->user())
                        <div class="add-new-comment">
                            <form action="{{route('user-comment.store')}}" method="POST">
                                @csrf
                                <textarea rows="3"  cols="5" class="" name="comment" required></textarea> <br>
                                <input type="hidden" value="{{$post->id}}" name="post_id" required>
                                <input class="button bg-second-color" type="submit" value="post comment">
                            </form>
                        </div>
                    @else
                        <div class="alert alert-warning">
                            You should log in first to add comment , <a class="second-color" href="/login">Login</a>
                        </div>
                    @endif


                    <h4 class="sub-title mb-5">
                        <i class="fa fa-comments"></i>
                        Comments ({{$postComments->count()}})
                    </h4>

                    @if($postComments->count() > 0)
                        @foreach($postComments->where('parent_id', '=' , '0') as $comment)
                            <div class="single-post-comment">
                                <div class="comment-box">
                                    <div class="user-img">
                                        @if(!empty($comment->user->avatar))
                                            <div class="user-image">
                                                <img style="height: 40px;width: 40px" class="rounded-circle" src="{{asset('backend/uploads/users/' . $comment->user->avatar)}}" alt="user-image">
                                            </div>
                                        @else
                                            <img style="height: 40px;width: 40px" class="rounded-circle" src="{{asset('backend/uploads/users/user.png')}}" alt="user-image">
                                        @endif
                                    </div>
                                    <div class="user-comment">
                                        <a href="{{route('author.profile',$comment->user->id)}}" class="username">
                                            {{$comment->user->name}}
                                            @if($comment->user->id === $post->user_id)
                                                <span class="if-creator">Creator</span>
                                            @endif
                                        </a>

                                        @if($comment->user->id === auth()->user()->id)
                                            <div class="options">
                                                <div class="dropdown">
                                                    <button class="btn  dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    </button>
                                                    <ul class="dropdown-menu">

                                                        <li>
                                                            <a class="dropdown-item edit-button" href="javascript:void()" data-comment-id="{{$comment->id}}" data-post-id="{{$comment->post->id}}">
                                                                <i class="fa fa-edit"></i> Edit
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <form id="deleteParentComment_{{$comment->id}}" class="d-none"  action="{{route('user-comment.delete' , $comment->id)}}" method="post">
                                                                @csrf
                                                                @method('delete')
                                                            </form>
                                                            <a class="dropdown-item" href="#" onclick="document.getElementById('deleteParentComment_{{$comment->id}}').submit();"><i class="fa fa-trash"></i> delete</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        @endif

                                        <span class="comment-date">{{$comment->created_at}}</span>
                                        <q class="comment-body">{{$comment->comment}}</q>

                                        <a class="reply-button" href="javascript:void()" data-comment-id="{{$comment->id}}" data-post-id="{{$comment->post->id}}">
                                            <i class="fa fa-reply"></i> Reply
                                        </a>

                                    </div>
                                </div>

                                <div class="replies" style="padding-inline-start: 50px">
                                    @if($comment->where('parent_id' ,'=' , $comment->id)->count() > 0)
                                        @foreach($comment->where('parent_id' , $comment->id)->get() as $repliedComment)
                                            <div class="comment-box">
                                                <div class="user-img">
                                                    @if(!empty($repliedComment->user->avatar))
                                                        <div class="user-image">
                                                            <img style="height: 40px;width: 40px" class="rounded-circle" src="{{asset('backend/uploads/users/' . $repliedComment->user->avatar)}}" alt="user-image">
                                                        </div>
                                                    @else
                                                        <img style="height: 40px;width: 40px" class="rounded-circle" src="{{asset('backend/uploads/users/user.png')}}" alt="user-image">
                                                    @endif
                                                </div>
                                                <div class="user-comment">
                                                    <a href="{{route('author.profile',$repliedComment->user->id)}}" class="username">
                                                        {{$repliedComment->user->name}}
                                                        @if($repliedComment->user->id === $comment->user_id)
                                                            <span class="if-creator">Creator</span>
                                                        @endif
                                                    </a>

                                                    @if($repliedComment->user->id === auth()->user()->id)
                                                        <div class="options">
                                                            <div class="dropdown">
                                                                <button class="btn  dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                </button>
                                                                <ul class="dropdown-menu">
                                                                    <li>
                                                                        <a class="dropdown-item edit-button" href="javascript:void()" data-comment-id="{{$repliedComment->id}}" data-post-id="{{$repliedComment->post->id}}">
                                                                            <i class="fa fa-edit"></i> Edit
                                                                        </a>
                                                                    </li>

                                                                    <li>
                                                                        <form id="deleteReplyComment_{{$repliedComment->id}}" class="d-none"  action="{{route('user-comment.delete' , $repliedComment->id)}}" method="post">
                                                                            @csrf
                                                                            @method('delete')
                                                                        </form>
                                                                        <a class="dropdown-item" href="#"  onclick="document.getElementById('deleteReplyComment_{{$repliedComment->id}}').submit();"><i class="fa fa-trash"></i> delete</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    @endif

                                                    <span class="comment-date">{{$repliedComment->created_at}}</span>
                                                    <q class="comment-body">{{$repliedComment->comment}}</q>

                                                        <a class="reply-button" href="javascript:void();" data-comment-id="{{$comment->id}}" data-post-id="{{$comment->post->id}}">
                                                            <i class="fa fa-reply"></i> Reply
                                                        </a>

                                                </div>
                                            </div>

                                        @endforeach
                                    @endif

                                </div>
                            </div>
                        @endforeach

                    @endif

                </div>



                  <div class="card">
                    <div class="card-header text-center bg-main-color">
                        ABOUT THE AUTHOR
                    </div>
                    <div class="card-body p-0">
                        <div class="post-author d-flex justify-content-start align-items-start">
                            <div class="author-img me-3">
                                @if(!empty($post->user->avatar))
                                    <img style="height: 100px;width: 100px;border: 4px solid var(--main-color)" class="rounded-circle" src="{{asset('backend/uploads/users/' . $post->user->avatar)}}" alt="user-image">
                                @else
                                    <img style="height: 100px;width: 100px;border: 4px solid var(--main-color)" class="rounded-circle" src="{{asset('backend/uploads/users/user.png')}}" alt="user-image">
                                @endif
                            </div>

                            <div class="author-info">
                                <h3 class="author-name">{{$post->user->name}}</h3>
                                <p>{{$post->user->about}}</p>
                            </div>

                        </div>
                    </div>
                    <div class="card-footer p-3">
                        <a href="{{route('author.profile',$post->user->id)}}" class="button bg-second-color">View all posts</a>
                    </div>

                </div>



                <div class="related-posts mt-5">
                    <div class="card">
                        <div class="card-header bg-main-color text-center">
                            RECOMMENDED POSTS
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                @if($post->category->count() > 0)
                                    @foreach($post->category->posts->where('id', '!=' ,$post->id) as $post)
                                        <li class="list-group-item">
                                            <i class="fa fa-chevron-right main-color"></i>
                                            <a href="{{route('site.post-details' , $post->id)}}">
                                                {{$post->short_title}}
                                            </a>
                                        </li>

                                    @endforeach
                                @endif
                            </ul>
                        </div>



                    </div>
                </div>


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
                                <a href="{{route('tag.posts' , $tag->id)}}" class="badge bg-second-color m-1  p-2">
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
                                        <a href="#">
                                            <i class="fa fa-chevron-right main-color"></i>
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





</div>




@endsection
@section('frontend-scripts')
    <script>

        const editButtons = document.querySelectorAll('.post-comments .edit-button');
        editButtons.forEach((button) => {
            button.addEventListener('click', (e) => {
                e.preventDefault();

                const formParent =  e.target.closest('.user-comment');
                const formExists = formParent.querySelector('.edit-new-comment');
                if (formExists) {
                    return;
                }

                const replyFormExists = formParent.querySelector('.reply-comment');
                if(replyFormExists) {
                    replyFormExists.remove();
                }

                const commentId = e.target.getAttribute('data-comment-id');
                const postId = e.target.getAttribute('data-post-id');

                const commentBody = formParent.querySelector('.comment-body').textContent;
                const editCommentForm = `
                    <form class="edit-new-comment" action="/comments/update/${commentId}" method="post">
                        @csrf
                        @method('PUT')
                        <textarea rows="3"  cols="5" class="" name="comment" required>${commentBody}</textarea> <br>
                        <input type="hidden" value="${postId}" name="post_id" required>
                        <input class="button bg-second-color" type="submit" value="update comment">
                    </form>
                `;

               formParent.insertAdjacentHTML('beforeend', editCommentForm);
            })
        })

        const replyButtons = document.querySelectorAll('.post-comments .reply-button');
        replyButtons.forEach((button) => {
            button.addEventListener('click', (e) => {
                e.preventDefault();

                const formParent =  e.target.closest('.user-comment');
                const formExists = formParent.querySelector('.reply-comment');
                if (formExists) {
                    return;
                }

                const editFormExists = formParent.querySelector('.edit-new-comment');
                if (editFormExists) {
                    editFormExists.remove();
                }

                const commentId = e.target.getAttribute('data-comment-id');
                const postId = e.target.getAttribute('data-post-id');

                const replyCommentForm = `
                    <form class="reply-comment" action="/comments/reply" method="post">
                        @csrf
                        <textarea rows="3"  cols="5" class="" name="comment" required></textarea> <br>
                        <input type="hidden" value="${postId}" name="post_id" required>
                        <input type="hidden" value="${commentId}" name="parent_id" required>
                        <input class="button bg-second-color" type="submit" value="Reply">
                    </form>
                `;

                formParent.insertAdjacentHTML('beforeend', replyCommentForm);
            })
        })

    </script>
@endsection

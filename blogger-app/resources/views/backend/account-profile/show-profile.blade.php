@extends('layouts.dashboard.dashboard-master')
@section('backend-title' , 'Account profile')

@section('backend-styles')
@endsection

@section('backend-content')

<div class="content">
    <div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <div>
                <h4 class="card-title">Welcome,{{ $user->name }}</h4>
              </div>
            </div>
            <div class="card-body table-responsive">
                <div class="card  card-profile">
                    <div class="card-avatar mt-1">
                      <a href="">
                          @if(!empty($user->avatar))
                          <img class="img" src="{{ asset('backend/uploads/users/' . $user->avatar) }}" />
                          @else
                          <img class="img" src="{{ asset('backend/uploads/users/user.png') }}" />
                          @endif
                      </a>
                    </div>
                    <div class="card-body">
                      <h6 class="card-category">
                         @foreach ($user->roles_names as $userRole )
                           <span class="badge badge-primary p-2 m-1">{{ $userRole}}</span>
                         @endforeach
                      </h6>
                      <h4 class="card-title">{{ $user->name }}</h4>
                      <h5>{{ $user->email }}</h5>
                      <p class="card-description">
                        @if(!empty($user->about))
                          <q>{{ $user->about }}</q>
                        @else
                          <q> Type somthing about you here ...! </q>
                        @endif
                      </p>
                      <p>
                        <span class="text-success">Created at: {{ $user->created_at }}</span>
                        |
                        <span class="text-warning">Updated at: {{ $user->updated_at }}</span>
                      </p>
                      <div class="actions">
                        @can('edit-users')
                        <a href="{{route('account-profile.edit')}}" class="special-control-btn btn-success">
                            <i class="fa fa-edit"></i> Edit Account
                        </a>
                        @endcan


                        @can('delete-users')
                            <form id="deleteUserForm"  action="{{route('users.destroy' , $user->id)}}" method="post">
                                @csrf
                                @method('delete')
                                <button onclick="confirm('Are you sure ? , you are goning to delete your account')" class="special-control-btn btn-danger" type="submit">
                                    <i class="fa fa-trash"></i> Delete Account
                                </button>
                            </form>
                        @endcan
                      </div>
                    </div>
                  </div>


                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title text-warning">User Posts
                       <span class="badge badge-warning">{{ $user->posts->count() }} </span>
                    </h3>
                    </div>
                    <div class="card-body user-posts">

                        @if(!empty($user->posts))
                           @foreach ($user->posts as $post )
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
                                        <a class="" href="{{route('site.post-details' ,$post->id)}}">
                                            {{Str::limit($post->short_title , 50 , '..')}}
                                        </a>
                                    </h3>
                                    <span class="post-date">
                                        <i class="fa fa-calendar"></i>
                                        {{$post->created_at}}
                                    </span>
                                    <div>{{$post->short_content}}</div>
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
                        @else
                            <div class="alert m-1 alert-warning">There is no post yet !</div>
                        @endif

                    </div>
                  </div>

            </div>
          </div>






        </div>

      </div>
    </div>
  </div>



@endsection


@section('backend-scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );


</script>

@endsection


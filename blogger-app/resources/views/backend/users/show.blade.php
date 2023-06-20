@extends('layouts.dashboard.dashboard-master')
@section('backend-title' , 'Users Management')

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
                <h4 class="card-title">Account profile: {{ $user->name }}</h4>
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
                        <a href="{{route('users.edit' , $user->id)}}" class="control-btn">
                            <i class="fa fa-edit"></i>
                        </a>
                        @endcan


                        @can('delete-users')
                            <form id="deleteUserForm"  action="{{route('users.destroy' , $user->id)}}" method="post">
                                @csrf
                                @method('delete')
                                <button class="control-btn" type="submit">
                                    <i class="fa fa-trash"></i>
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
                    <div class="card-body">

                        @if(!empty($user->posts))

                        @foreach ($user->posts as $post )
                            <a class="user-single-post" href="{{ route('posts.show' , $post->id) }}">
                                <div class="single-post-image">
                                    @if(!empty($post->post_image) )
                                    <img class="img-thumbnail" src="{{ asset('backend/uploads/posts/' . $post->post_image )  }}">
                                    @else
                                    <img class="img-thumbnail" src="{{ asset('backend/uploads/posts/default-post.png'  )  }}">
                                    @endif
                                </div>
                                <div class="single-post-details mt-3 ml-3">
                                    <h4 class="single-post-title text-primary">
                                        {{ $post->title }}
                                    </h4>
                                    <p>
                                        {!! Str::limit($post->content,250 , '...') !!}
                                    </p>
                                    <p class="text-right text-secondary">
                                        <span>
                                            <i class="fa fa-calendar"></i> {{ $post->created_at }}
                                        </span>
                                    </p>
                                </div>
                            </a>
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


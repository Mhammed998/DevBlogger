@extends('layouts.dashboard.dashboard-master')
@section('backend-title' , 'Posts Management')

@section('backend-styles')
@endsection

@section('backend-content')

<div class="content">
    <div class="container-fluid">



      <div class="row">
        <div class="col-lg-12 col-md-12">
          <div class="card">
            <div class="card-header table-header card-header-primary">
              <div>
                <h4 class="card-title">Posts Management</h4>
                <p class="card-post">full controll with posts management</p>
              </div>

              <a href="{{ route('posts.create') }}" class="create-btn">Create post</a>

            </div>
            <div class="card-body table-responsive">
              <table class="table table-hover">
                <thead class="text-warning">
                  <th>ID</th>
                  <th>Image</th>
                  <th>Title</th>
                  <th>Category</th>
                  <th>Author</th>
                  <th>Status</th>
                  <th>Actions</th>
                </thead>
                <tbody>
                    @if($posts->count() > 0)
                    @foreach ($posts as $post )
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>
                                <a href="" target="_blank">
                                    @if(!empty($post->post_image) )
                                    <img style="width: 70px;height:70px;border-radius:50%;" src="{{ asset('backend/uploads/posts/' . $post->post_image )  }}">
                                    @else
                                    <img style="width: 70px;height:70px;border-radius:50%;" src="{{ asset('backend/uploads/posts/default-post.png'  )  }}">
                                    @endif

                                </a>
                            </td>
                            <td>{{ Str::limit($post->title,50)  }}</td>




                            <td class="text-success">
                                <a class="text-success" href="{{ route('categories.show' , $post->category->id) }}">{{ $post->category->name }}</a>
                             </td>

                             <td class="text-warning">
                                <a class="text-warning" href="{{ route('users.show' , $post->user->id) }}">{{$post->user->name }}</a>
                             </td>


                            <td>
                                @if($post->status)
                                  <span class="text-success">
                                    <i class="fa fa-check"></i>
                                    Visible
                                </span>
                                @else
                                <span class="text-danger">
                                    <i class="fa fa-ban"></i>
                                    Hidden
                                </span>
                                @endif
                            </td>



                            {{-- <td>
                              @if($post->tags->count() > 0)
                               @foreach( $post->tags as $tag )
                                 <span class="text-info mr-1">#{{ $tag->tag_name }}</span>
                               @endforeach
                              @endif
                            </td> --}}


                            <td>


                                <a href="{{route('posts.show' , $post->id)}}" class="text-info control-btn">
                                    <i class="fa fa-eye"></i>
                                </a>


                             @can('edit-posts')
                                <a href="{{route('posts.edit' , $post->id)}}" class="text-success control-btn">
                                    <i class="fa fa-edit"></i>
                                </a>
                            @endcan


                            @can('delete-posts')
                                <form id="deleteUserForm"  action="{{route('posts.destroy' , $post->id)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="text-danger control-btn" type="submit">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            @endcan
                            </td>


                        </tr>
                  @endforeach
                  @else
                  <td colspan="8">
                    <div class="alert alert-warning">There is no data ..!</div>
                  </td>
                  @endif



                </tbody>
              </table>
            </div>
          </div>

        </div>
      </div>


    </div>
  </div>



@endsection


@section('backend-scripts')
@endsection


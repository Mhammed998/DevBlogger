@extends('layouts.dashboard.dashboard-master')
@section('backend-title' , 'Comments Management')

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
                <h4 class="card-title">Comments Management</h4>
                <p class="card-category">full controll with comments management</p>
              </div>

              {{-- <a href="{{ route('categories.create') }}" class="create-btn">Create category</a> --}}

            </div>
            <div class="card-body table-responsive">
              <table class="table table-hover">
                <thead class="text-warning">
                  <th>ID</th>
                  <th>Avatar</th>
                  <th>User</th>
                  <th>Comment</th>
                  <th>Post</th>
                  <th>Created At</th>
                  <th>Actions</th>
                </thead>
                <tbody>
                    @if($comments->count() > 0)
                      @foreach ($comments as $comment )
                        <tr>
                            <td>{{ $comment->id }}</td>
                            <td>
                                @if(!empty($comment->user->avatar))
                                <img style="height: 65px;width:65px;border-radius:50%" class="img" src="{{ asset('backend/uploads/users/' . $comment->user->avatar) }}" />
                                @else
                                <img style="height: 65px;width:65px;border-radius:50%" class="img" src="{{ asset('backend/uploads/users/user.png') }}" />
                                @endif
                            </td>
                            <td>
                                <a class="text-info" href="{{ route('users.show' , $comment->user->id) }}">
                                    {{ $comment->user->name }}
                                </a>
                            </td>
                            <td>
                              {{  $comment->comment}}
                            </td>

                            <td>
                                <a class="text-success" href="{{ route('posts.show' , $comment->post->id) }}">
                                    {{ $comment->post->title}}
                                </a>
                            </td>


                            <td>
                               {{ $comment->created_at }}
                            </td>




                            <td>



                            @can('delete-comments')
                                <form id="deleteUserForm"  action="{{route('comments.destroy' , $comment->id)}}" method="post">
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
                      <tr>
                        <td colspan="8">
                            <div class="alert alert-warning">There is no data ..!</div>
                        </td>
                      </tr>
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


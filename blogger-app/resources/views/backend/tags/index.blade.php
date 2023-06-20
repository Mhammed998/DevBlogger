@extends('layouts.dashboard.dashboard-master')
@section('backend-title' , 'Tags Management')

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
                <h4 class="card-title">Tags Management</h4>
                <p class="card-category">full controll with tags management</p>
              </div>

              <a href="{{ route('tags.create') }}" class="create-btn">Create tag</a>

            </div>
            <div class="card-body table-responsive">
              <table class="table table-hover">
                <thead class="text-warning">
                  <th>ID</th>
                  <th>Tag</th>
                  <th>No.Posts</th>
                  <th>Created At</th>
                  <th>Updated At</th>
                  <th>Actions</th>
                </thead>
                <tbody>
                    @if($tags->count() > 0)
                      @foreach ($tags as $tag )
                        <tr>
                            <td>{{ $tag->id }}</td>

                            <td>{{ $tag->tag_name }}</td>

                            <td>{{ $tag->posts->count() }}</td>

                            <td>{{ $tag->created_at }}</td>

                            <td>{{ $tag->updated_at }}</td>



                            <td>



                                @can('edit-tags')
                                    <a href="{{route('tags.edit' , $tag->id)}}" class="text-info control-btn">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                @endcan

                                    @can('delete-tags')
                                        <form id="deleteUserForm"  action="{{route('tags.destroy' , $tag->id)}}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button class="control-btn text-danger" type="submit">
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


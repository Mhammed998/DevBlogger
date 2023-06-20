@extends('layouts.dashboard.dashboard-master')
@section('backend-title' , 'Categories Management')

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
                <h4 class="card-title">Categories Management</h4>
                <p class="card-category">full controll with categories management</p>
              </div>

              <a href="{{ route('categories.create') }}" class="create-btn">Create category</a>

            </div>
            <div class="card-body table-responsive">
              <table class="table table-hover">
                <thead class="text-warning">
                  <th>ID</th>
                  <th>Image</th>
                  <th>Name</th>
                  <th>Description</th>
                  <th>Posts</th>
                  <th>Status</th>
                  <th>Created At</th>
                  <th>Actions</th>
                </thead>
                <tbody>
                    @if($categories->count() > 0)
                      @foreach ($categories as $category )
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>
                                <a href="" target="_blank">
                                <img style="width: 70px;height:70px;border-radius:50%;" src="{{ asset('backend/uploads/categories/' . $category->category_image )  }}">
                                </a>
                            </td>
                            <td>{{ $category->name }}</td>
                            <td>
                              {{  $category->description}}
                            </td>

                            <td>
                                {{ $category->posts->count() }}
                            </td>
                            <td>
                                @if($category->status)
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

                            <td>
                               {{ $category->created_at }}
                            </td>




                            <td>


                              @can('show-categories')
                                <a href="{{route('categories.show' , $category->id)}}" class="text-info control-btn">
                                    <i class="fa fa-eye"></i>
                                </a>
                                @endcan



                                @can('edit-categories')
                                  <a href="{{route('categories.edit' , $category->id)}}" class="text-success control-btn">
                                    <i class="fa fa-edit"></i>
                                  </a>
                                 @endcan


                            @can('delete-categories')
                                <form id="deleteUserForm"  action="{{route('categories.destroy' , $category->id)}}" method="post">
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


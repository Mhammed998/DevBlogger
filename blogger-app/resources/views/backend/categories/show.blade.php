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
            <div class="card-header card-header-primary">
              <div>
                <h4 class="card-title">Category Details</h4>
                <p class="card-category">Show Category Details</p>
              </div>

              <div>
                @can('edit-categories')
                <a href="{{route('categories.edit' , $category->id)}}" class="control-btn">
                    <i class="fa fa-edit"></i>
                </a>
            @endcan


            @can('delete-categories')
                <form id="deleteUserForm"  action="{{route('categories.destroy' , $category->id)}}" method="post">
                    @csrf
                    @method('delete')
                    <button class="control-btn" type="submit">
                        <i class="fa fa-trash"></i>
                    </button>
                </form>
            @endcan
              </div>
            </div>
            <div class="card-body table-responsive">
                <div class="category-view">
                   <div class="row">
                    <div class="col-md-4">
                      <div class="category-image">
                         <img class="img-thumbnail" src="{{ asset('backend/uploads/categories/' . $category->category_image) }}">
                      </div>
                    </div>
                    <div class="col-md-8">
                        <div class="category-info">
                             <h3>{{ $category->name }} Category</h3>
                             <p>Description: {{ $category->description }}</p>
                             <p>
                                Status:
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

                             </p>

                             <p>
                                Number of Posts: <span class="badge p-1 badge-primary"> {{ $category->posts->count() }} </span>
                             </p>

                             <p>
                                Created At: <span>{{ $category->created_at }}</span>
                             </p>


                             <p>
                                Updated At: <span>{{ $category->updated_at }}</span>
                             </p>


                        </div>
                      </div>
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
@endsection


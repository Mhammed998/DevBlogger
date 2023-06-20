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
            <div class="card-header card-header-primary">
              <div>
                <h4 class="card-title">Create New Category</h4>
                <p class="card-category">Enter valid data to create new category</p>
              </div>
            </div>
            <div class="card-body table-responsive">

                <form class="myform" action="{{route('categories.store')}}" method="POST" enctype="multipart/form-data">

                    @csrf

                    @if($errors->any())
                       @foreach ($errors->all() as $error )
                       <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="material-icons">close</i>
                        </button>
                        <span> {{ $error }}</span>
                      </div>
                       @endforeach
                    @endif




                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">Category Name</label>
                                <input  id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">Category Description</label>
                                <input id="description" name="description" type="text" class="form-control @error('description') is-invalid @enderror" value="{{ old('description') }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">






                        <div class="col-md-6">
                            <div class="form-group bmd-form-group">
                                <select style="width: 100%" id="status" name="status" class="form-control basic-single-status"  name="state">
                                    <option value="1">Activated</option>
                                    <option value="0">Blocked</option>
                                </select>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group bmd-form-group">
                                <input id="category_image" type="file" name="category_image" class="form-control">
                            </div>
                        </div>



                    </div>


                    <button type="submit" class="btn btn-primary pull-right">Save Category</button>
                    <div class="clearfix"></div>
                </form>

            </div>
          </div>
        </div>

      </div>
    </div>
  </div>



@endsection


@section('backend-scripts')
@endsection


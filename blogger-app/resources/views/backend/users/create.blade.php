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
                <h4 class="card-title">Create New User</h4>
                <p class="card-category">Enter valid data to create new user</p>
              </div>
            </div>
            <div class="card-body table-responsive">

                <form class="myform" action="{{route('users.store')}}" method="POST" enctype="multipart/form-data">

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
                                <label class="bmd-label-floating">Full Name</label>
                                <input  id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror


                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">Email</label>
                                <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">


                        <div class="col-md-6">

                            <div class="form-group">
                                <label class="bmd-label-floating">Password</label>
                                <input  type="password" class="form-control @error('password') is-invalid @enderror" name="password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>



                            <div class="form-group">
                                <label class="bmd-label-floating">Confirm Password</label>
                                <input type="password" class="form-control" name="password_confirmation">
                            </div>

                        </div>


                        <div class="col-md-6">

                                <div class="form-group bmd-form-group">
                                    <select style="width: 100%" id="status" name="status" class="form-control basic-single-status"  name="state">
                                        <option value="1">Activated</option>
                                        <option value="0">Blocked</option>
                                    </select>
                                </div>



                                <div class="form-group bmd-form-group">
                                    <input id="avatar" type="file" name="avatar" class="form-control">
                                </div>

                        </div>


                    </div>








                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <select style="width: 100%" class="basic-multiple-for-roles" name="roles_names[]" multiple="multiple">
                                    @if($roles)
                                     @foreach ($roles as $role )
                                     <option value="{{ $role }}">{{ $role }}</option>
                                     @endforeach
                                    @endif
                                  </select>
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea placeholder="Type about yourself here..!" rows="4" id="about" name="about" class="form-control"></textarea>
                            </div>
                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary pull-right">Save User</button>
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


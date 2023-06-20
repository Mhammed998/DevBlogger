@extends('layouts.dashboard.dashboard-master')
@section('backend-title' , 'Roles Management')

@section('backend-styles')
<style>

    #deleteUserForm{
        display: inline-block;
    }
    .control-btn{
        padding: 5px;
        cursor: pointer;
        width: 30px;
        height: 30px;
        background-color: #fff;
        border-radius: 50%;
        margin: 0px 5px;
        text-align: center;
        line-height: 18px;
        border: 0;
        color: #1b1e21 !important;
    }

    .card-header{
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 12px !important;
    }


    .create-btn{
    background-color: #fff;
    color: #222 !important;
    padding: 5px 10px;
    border-radius: 5px;
    cursor: pointer;
    font-weight: 500;
    }


    .form-group label{
      margin: 0px 10px !important;
    }

   .form-group  .form-control{
        border: 1px solid #555;
        border-radius: 5px;
        margin-bottom: 10px;
        padding-left:10px;
    }

    select.form-control{
      border: 1px solid #555;
      border-radius: 5px;
      padding-left: 10px;
      margin-bottom: 20px !important;
    }

    .tall{
        min-height: 90px;
    }

    .permissions label{

    }

</style>
@endsection

@section('backend-content')

<div class="content">
    <div class="container-fluid">


      <div class="row">
        <div class="col-lg-12 col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <div>
                <h4 class="card-title">Create New Role</h4>
                <p class="card-category">Enter valid data to create new role</p>
              </div>
            </div>
            <div class="card-body table-responsive">

                <form class="myform" action="{{route('roles.store')}}" method="POST">

                    @csrf

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="bmd-label-floating">Role name</label>
                                <input  id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror


                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="form-group permissions">
                                <strong>Permission:</strong>
                                <br/>
                                @foreach($permission as $value)
                                    <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                                    {{ $value->name }}</label>

                                @endforeach
                            </div>
                        </div>

                    </div>




                    <button type="submit" class="btn btn-primary pull-right">Save role</button>
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


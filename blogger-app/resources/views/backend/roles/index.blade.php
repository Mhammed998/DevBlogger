@extends('layouts.dashboard.dashboard-master')
@section('backend-title' , 'Roles Management')

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
                <h4 class="card-title">Roles Management</h4>
                <p class="card-category">full controll with roles management</p>
              </div>

              <a href="{{ route('roles.create') }}" class="create-btn">Create role</a>

            </div>
            <div class="card-body table-responsive">
              <table class="table table-hover">
                <thead class="text-warning">
                  <th>ID</th>
                  <th>name</th>
                  <th>Created At</th>
                  <th>Updated At</th>
                  <th>Actions</th>
                </thead>
                <tbody>
                    @if(!empty($roles))
                    @foreach ($roles as $role )
                        <tr>
                            <td>{{ $role->id }}</td>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->created_at }}</td>
                            <td>{{ $role->updated_at }}</td>





                            <td>
                                @can('edit-roles')
                                <a href="{{route('roles.edit' , $role->id)}}" class="text-success control-btn">
                                    <i class="fa fa-edit"></i>
                                </a>
                            @endcan


                            @can('delete-roles')
                                <form id="deleteUserForm"  action="{{route('roles.destroy' , $role->id)}}" method="post">
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
                    <div class="alert alert-secondary"> There is no data yet..!</div>

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


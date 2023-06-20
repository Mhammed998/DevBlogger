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
            <div class="card-header table-header card-header-primary">
              <div>
                <h4 class="card-title">Users Management</h4>
                <p class="card-category">full controll with users management</p>
              </div>

              <a href="{{ route('users.create') }}" class="create-btn">Create user</a>

            </div>
            <div class="card-body table-responsive">
              <table class="table table-hover">
                <thead class="text-warning">
                  <th>ID</th>
                  <th>Avatar</th>
                  <th>Username</th>
                  <th>Email</th>
                  <th>Roles</th>
                  <th>Status</th>
                  <th>Actions</th>
                </thead>
                <tbody>
                    @if($users->count() > 0)
                    @foreach ($users as $user )
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>
                                @if(!empty($user->avatar))
                                <img style="height: 65px;width:65px;border-radius:50%" class="img" src="{{ asset('backend/uploads/users/' . $user->avatar) }}" />
                                @else
                                <img style="height: 65px;width:65px;border-radius:50%" class="img" src="{{ asset('backend/uploads/users/user.png') }}" />
                                @endif
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if(!empty($user->roles_names) )

                                    @foreach($user->roles_names as $v)
                                        <label class="badge p-1 badge-success">{{ $v }}</label>
                                    @endforeach
                                @endif
                            </td>
                            <td>
                                @if($user->status)
                                  <span class="text-success">
                                    <i class="fa fa-check"></i>
                                    Activated
                                </span>
                                @else
                                <span class="text-danger">
                                    <i class="fa fa-ban"></i>
                                    Blocked
                                </span>
                                @endif
                            </td>


                            <td>


                                <a href="{{route('users.show' , $user->id)}}" class="text-info control-btn">
                                    <i class="fa fa-eye"></i>
                                </a>



                                @can('edit-users')
                                <a href="{{route('users.edit' , $user->id)}}" class="text-success control-btn">
                                    <i class="fa fa-edit"></i>
                                </a>
                                @endcan


                            @can('delete-users')
                                <form id="deleteUserForm"  action="{{route('users.destroy' , $user->id)}}" method="post">
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


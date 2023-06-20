@extends('layouts.site.app')
@section('frontend-title' , 'Edit | Account Profile')
@section('frontend-styles')
@endsection
@section('frontend-content')

    <div class="container-fluid">
        <div class="edit-account mt-5">

         <div class="row">
             <div class="col-md-4">
                 <div class="account-card">

                     <div class="user-image">
                         @if(!empty($user->avatar))
                             <img style="height: 150px;width: 150px" class="rounded-circle" src="{{asset('backend/uploads/users/' . $user->avatar)}}" alt="user-image">
                         @else
                             <img style="height: 150px;width: 150px" class="rounded-circle" src="{{asset('backend/uploads/users/user.png')}}" alt="user-image">
                         @endif
                     </div>

                     <div class="info">
                         <h3>{{$user->name}}</h3>
                         <h5>{{$user->email}}</h5>
                         <q>
                             {{ $user->about }}
                         </q>



                         <div class="mt-3">
                             <span class="second-color">Join date : {{$user->created_at}}</span>
                             <br>
                             <span class="main-color"> Last update : {{$user->updated_at}}</span>
                         </div>

                     </div>




                 </div>
             </div>
             <div class="col-md-8">
                 <div class="edit-forms">

                    <div class="edit-form">
                        <h3 class="edit-form-title">Edit Information</h3>
                        <form class="mt-5" action="{{route('account.update-profile' , $user->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                          <div class="row">

                              @if($errors->any())
                                  @foreach($errors->all() as $error)
                                      <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                          <strong>Attention!</strong> {{$error}}
                                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                      </div>
                                  @endforeach
                              @endif

                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label>Username</label>
                                      <input type="text" name="name" class="form-control" value="{{$user->name}}">
                                  </div>
                              </div>

                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label>Email</label>
                                      <input type="email" name="email" class="form-control" value="{{$user->email}}">
                                  </div>
                              </div>

                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label>Avatar</label>
                                      <input type="file" name="avatar" class="form-control">
                                  </div>
                              </div>


                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label>About </label>
                                      <textarea rows="5" name="about" class="form-control">{{$user->about}}</textarea>
                                  </div>
                              </div>

                              <div class="col-md-12">
                                  <div class="form-group text-end">
                                    <input type="submit" class="button bg-second-color" value="SAVE UPDATES">
                                  </div>
                              </div>

                          </div>

                        </form>
                    </div>

                     <div class="edit-form">
                        <h3 class="edit-form-title">Change Password</h3>
                         <form class="mt-5" action="{{route('account.update-password' , $user->id)}}" method="POST">
                             @csrf
                             @method('PUT')

                             <div class="row">

                                 @if($errors->any())
                                     @foreach($errors->all() as $error)
                                         <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                             <strong>Attention!</strong> {{$error}}
                                             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                         </div>
                                     @endforeach
                                 @endif
                                 <div class="col-md-12">
                                     <div class="form-group">
                                         <label>Old Password</label>
                                         <input type="password" name="old_password" class="form-control">
                                     </div>
                                 </div>

                                 <div class="col-md-12">
                                     <div class="form-group">
                                         <label>New Password</label>
                                         <input type="password" name="new_password" class="form-control" >
                                     </div>
                                 </div>

                                 <div class="col-md-12">
                                     <div class="form-group">
                                         <label>Password Confirmation</label>
                                         <input type="password" name="password_confirmation" class="form-control">
                                     </div>
                                 </div>


                                 <div class="col-md-12">
                                     <div class="form-group text-end">
                                         <input type="submit" class="button bg-second-color" value="SAVE UPDATES">
                                     </div>
                                 </div>

                             </div>

                         </form>
                    </div>




                 </div>
             </div>
         </div>



        </div>
    </div>
@endsection

@extends('layouts.dashboard.dashboard-master')
@section('backend-title' , 'Dashboard Management')

@section('backend-styles')
@endsection

@section('backend-content')

<div class="content">
    <div class="container-fluid">
      {{-- <div class="row">
        <div class="col-xl-4 col-lg-12">
          <div class="card card-chart">
            <div class="card-header card-header-success">
              <div class="ct-chart" id="dailySalesChart"></div>
            </div>
            <div class="card-body">
              <h4 class="card-title">Daily Sales</h4>
              <p class="card-category">
                <span class="text-success"><i class="fa fa-long-arrow-up"></i> 55% </span> increase in today sales.</p>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">access_time</i> updated 4 minutes ago
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-lg-12">
          <div class="card card-chart">
            <div class="card-header card-header-warning">
              <div class="ct-chart" id="websiteViewsChart"></div>
            </div>
            <div class="card-body">
              <h4 class="card-title">Email Subscriptions</h4>
              <p class="card-category">Last Campaign Performance</p>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">access_time</i> campaign sent 2 days ago
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-lg-12">
          <div class="card card-chart">
            <div class="card-header card-header-danger">
              <div class="ct-chart" id="completedTasksChart"></div>
            </div>
            <div class="card-body">
              <h4 class="card-title">Completed Tasks</h4>
              <p class="card-category">Last Campaign Performance</p>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">access_time</i> campaign sent 2 days ago
              </div>
            </div>
          </div>
        </div>
      </div> --}}
      <div class="row">
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
              <div class="card-icon">
                <i class="material-icons">people</i>
              </div>
              <p class="card-category">Users</p>
              <h3 class="card-title text-warning text-bold"> {{ $users->count() }} </h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <a href="{{ route('users.index') }}" class="warning-link">
                    <i class="fa fa-arrow-right"></i>
                    show all users</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
              <div class="card-icon">
                <i class="material-icons">library_books</i>
              </div>
              <p class="card-category">Categories</p>
              <h3 class="card-title text-success">{{ $categories->count() }}</h3>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <a href="{{ route('categories.index') }}" class="success-link">
                        <i class="fa fa-arrow-right"></i>
                        show all categories</a>
                  </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
              <div class="card-icon">
                <i class="material-icons">content_paste</i>
              </div>
              <p class="card-category">Posts</p>
              <h3 class="card-title text-danger">{{ $posts->count() }}</h3>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <a href="{{ route('posts.index') }}" class="danger-link">
                        <i class="fa fa-arrow-right"></i>
                        show all posts</a>
                  </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
              <div class="card-icon">
                <i class="material-icons">tags</i>
            </div>
              <p class="card-category">Tags</p>
              <h3 class="card-title text-info">{{ $posts->count() }}</h3>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <a href="{{ route('posts.index') }}" class="link">
                        <i class="fa fa-arrow-right"></i>
                        show all tags</a>
                  </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">

        <div class="col-lg-6 col-md-12">
          <div class="card">
            <div class="card-header card-header-warning">
              <h4 class="card-title">Last Users</h4>
              <p class="card-category">Last registered users</p>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-hover">
                    <thead class="text-warning">
                      <th>ID</th>
                      <th>Avatar</th>
                      <th>Name</th>
                      <th>Roles</th>
                      <th>Actions</th>
                    </thead>
                    <tbody>
                        @if($users->count() > 0)
                          @foreach ($lastUsers as $u )
                            <tr>
                                <td>{{ $u->id }}</td>
                                <td>
                                    @if(!empty($u->avatar))
                                    <img style="height: 50px;width:50px;border-radius:50%" class="img" src="{{ asset('backend/uploads/users/' . $u->avatar) }}" />
                                    @else
                                    <img style="height: 50px;width:50px;border-radius:50%" class="img" src="{{ asset('backend/uploads/users/user.png') }}" />
                                    @endif
                                </td>
                                <td>
                                    <a class="" href="{{ route('users.show' , $u->id) }}">
                                        {{ $u->name }}
                                    </a>
                                </td>


                                <td>
                                    @if(!empty($u->roles_names) )
                                        @foreach($u->roles_names as $v)
                                            <label class="badge badge-primary">{{ $v }}</label>
                                        @endforeach
                                    @endif
                                </td>



                                <td>
                                @can('edit-users')
                                <a href="{{route('users.edit' , $u->id)}}" class="text-success control-btn">
                                    <i class="fa fa-edit"></i>
                                </a>
                                @endcan
                                @can('delete-users')
                                    <form id="deleteUserForm"  action="{{route('users.destroy' , $u->id)}}" method="post">
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
                            <td colspan="5">
                                <div class="alert alert-warning">There is no data ..!</div>
                            </td>
                          </tr>
                        @endif

                      {{-- {{ $lastUsers->links() }} --}}

                    </tbody>
                  </table>
            </div>
          </div>
        </div>

 <div class="col-lg-6 col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">Last Comments</h4>
              <p class="card-category">Last comments added by users</p>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-hover">
                    <thead class="text-warning">
                      <th>ID</th>
                      <th>User</th>
                      <th>Comment</th>
                      <th>Post</th>
                      <th>Actions</th>
                    </thead>
                    <tbody>
                        @if($comments->count() > 0)
                          @foreach ($comments as $comment )
                            <tr>
                                <td>{{ $comment->id }}</td>
                                {{-- <td>
                                    @if(!empty($comment->user->avatar))
                                    <img style="height: 65px;width:65px;border-radius:50%" class="img" src="{{ asset('backend/uploads/users/' . $comment->user->avatar) }}" />
                                    @else
                                    <img style="height: 65px;width:65px;border-radius:50%" class="img" src="{{ asset('backend/uploads/users/user.png') }}" />
                                    @endif
                                </td> --}}
                                <td>
                                    <a class="" href="{{ route('users.show' , $comment->user->id) }}">
                                        {{ $comment->user->name }}
                                    </a>
                                </td>
                                <td>
                                  {{  Str::limit($comment->comment , 20 , '..')}}
                                </td>

                                <td>
                                    <a class="" href="{{ route('posts.show' , $comment->post->id) }}">
                                        {{Str::limit($comment->post->title , 15 , '..')}}
                                    </a>
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


        {{-- <div class="col-lg-6 col-md-12">
          <div class="card">
            <div class="card-header card-header-tabs card-header-warning">
              <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                  <span class="nav-tabs-title">Tasks:</span>
                  <ul class="nav nav-tabs" data-tabs="tabs">
                    <li class="nav-item">
                      <a class="nav-link active" href="#profile" data-toggle="tab">
                        <i class="material-icons">bug_report</i> Bugs
                        <div class="ripple-container"></div>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#messages" data-toggle="tab">
                        <i class="material-icons">code</i> Website
                        <div class="ripple-container"></div>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#settings" data-toggle="tab">
                        <i class="material-icons">cloud</i> Server
                        <div class="ripple-container"></div>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="tab-content">
                <div class="tab-pane active" id="profile">
                  <table class="table">
                    <tbody>
                      <tr>
                        <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="" checked>
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>
                        <td>Sign contract for "What are conference organizers afraid of?"</td>
                        <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-white btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-white btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="">
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>
                        <td>Lines From Great Russian Literature? Or E-mails From My Boss?</td>
                        <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-white btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-white btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="">
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>
                        <td>Flooded: One year later, assessing what was lost and what was found when a ravaging rain swept through metro Detroit
                        </td>
                        <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-white btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-white btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="" checked>
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>
                        <td>Create 4 Invisible User Experiences you Never Knew About</td>
                        <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-white btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-white btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="tab-pane" id="messages">
                  <table class="table">
                    <tbody>
                      <tr>
                        <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="" checked>
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>
                        <td>Flooded: One year later, assessing what was lost and what was found when a ravaging rain swept through metro Detroit
                        </td>
                        <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-white btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-white btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="">
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>
                        <td>Sign contract for "What are conference organizers afraid of?"</td>
                        <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-white btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-white btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="tab-pane" id="settings">
                  <table class="table">
                    <tbody>
                      <tr>
                        <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="">
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>
                        <td>Lines From Great Russian Literature? Or E-mails From My Boss?</td>
                        <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-white btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-white btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="" checked>
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>
                        <td>Flooded: One year later, assessing what was lost and what was found when a ravaging rain swept through metro Detroit
                        </td>
                        <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-white btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-white btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="" checked>
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>
                        <td>Sign contract for "What are conference organizers afraid of?"</td>
                        <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-white btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-white btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div> --}}



    </div>
    </div>
  </div>



@endsection


@section('backend-scripts')
@endsection


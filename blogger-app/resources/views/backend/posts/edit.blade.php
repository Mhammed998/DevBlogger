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
                <h4 class="card-title">Edit Post</h4>
                <p class="card-category">Enter valid data to  edit post</p>
              </div>
            </div>
            <div class="card-body table-responsive">

                <form class="myform" action="{{route('posts.update' , $post->id)}}" method="POST" enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

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
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="bmd-label-floating">Post Title</label>
                                <textarea rows="5"  id="title" name="title"
                                 class=" form-control @error('title') is-invalid @enderror">{{ $post->title }}</textarea>


                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>


                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="bmd-label-floating">Post Content</label>
                                <textarea  id="editor" name="content"
                                class=" @error('description') is-invalid @enderror">
                                {!! $post->content !!}
                               </textarea>
                                @error('content')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">






                        <div class="col-md-6">
                            <div class="form-group bmd-form-group">
                                <select style="width: 100%" id="status" name="status" class="form-control basic-single-status">
                                    <option {{ $post->status == '1' ? 'selected' : '' }} value="1">Published</option>
                                    <option {{ $post->status == '0' ? 'selected' : '' }} value="0">Hidden</option>
                                </select>
                            </div>
                        </div>



                        <div class="col-md-6">
                            <div class="form-group bmd-form-group">
                                <input id="post_image" type="file" name="post_image" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group bmd-form-group">
                                <select style="width: 100%" id="category_id" name="category_id" class="form-control basic-single-category">
                                    @if($categories)
                                     @foreach ($categories as $cate )
                                     <option {{ $cate->id === $post->category->id ? 'selected' : '' }} value="{{ $cate->id }}">{{ $cate->name }}</option>
                                     @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="formgroup">
                                <input id="user_id" name="user_id" class="form-control" type="hidden" value="{{ auth()->user()->id }}">
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <select style="width: 100%" class="basic-multiple-for-tags" name="post_tags[]" multiple="multiple">
                                    @if($tags)
                                      @foreach ($tags as $tag )
                                         <option {{in_array($tag->id , $selectedTags) ? 'selected' : ''}}  value="{{$tag->id}}">{{ $tag->tag_name }}</option>
                                     @endforeach
                                    @endif
                                  </select>
                            </div>
                        </div>
                    </div>


                    <button type="submit" class="btn btn-primary pull-right">Update Post</button>
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


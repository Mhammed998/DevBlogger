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
                <h4 class="card-title">Show Post Details</h4>
                <p class="card-category">Show Post Details</p>
              </div>

              <div>
                @can('edit-posts')
                <a href="{{route('posts.edit' , $post->id)}}" class="text-primary control-btn">
                    <i class="fa fa-edit"></i>
                </a>
            @endcan


            @can('delete-posts')
                <form id="deleteUserForm"  action="{{route('posts.destroy' , $post->id)}}" method="post">
                    @csrf
                    @method('delete')
                    <button class="control-btn text-danger" type="submit">
                        <i class="fa fa-trash"></i>
                    </button>
                </form>
            @endcan
              </div>
            </div>
            <div class="card-body table-responsive">
                <div class="post-view">

                    <h2 class="posts-title">
                        {{ $post->title }}
                    </h2>

                <div class="post-info">
                  <span class="author">
                    <i class="fa fa-user"></i>
                    {{ $post->user->name }}
                  </span>


                  <span class="category">
                    <i class="fa fa-calendar"></i>
                    {{ $post->created_at }}
                  </span>

                  <span class="category">
                    <i class="fa fa-suitcase"></i>
                    {{ $post->category->name }}
                  </span>
                </div>

                @if(!empty($post->post_image))
                  <img class="img-thumbnail post-image" alt="post-image" src="{{ asset('backend/uploads/posts/' . $post->post_image) }}">
                @endif

                    <article>
                       {!! $post->content !!}
                    </article>



                    <div class="post-tags">
                        <span class="tags">
                            <i class="fa fa-tags"></i> Tags:
                        </span>

                    @if($post->tags->count() > 0)
                      @foreach ($post->tags as $tag )
                      <span class="badge">
                        <a href="">
                         #{{ $tag->tag_name }}
                        </a>
                     </span>
                      @endforeach
                    @endif



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
<script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );


</script>

@endsection


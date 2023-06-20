@extends('layouts.dashboard.dashboard-master')
@section('backend-title' , 'Tags Management')

@section('backend-styles')
@endsection

@section('backend-content')

<div class="content">
    <div class="container-fluid">


    <div class="row">

        <div class="col-md-8">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">Add New Tag</h4>
                    <p class="card-category">Enter Tag Information</p>
                </div>
                <div class="card-body">
                    <form class="myform" action="{{route('tags.store')}}" method="POST">

                        @csrf

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Tag Name</label>
                                    <input name="tag_name" type="text" class="form-control">
                                </div>
                            </div>

                        </div>





                        <button type="submit" class="btn btn-primary pull-right">Save Tag</button>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>


    </div>

    @endsection


    @section('backend-scripts')
    @endsection

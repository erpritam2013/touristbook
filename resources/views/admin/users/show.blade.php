@extends('admin.layouts.main')
@section('title', $title)
@section('admin_head_css')
    @parent
@endsection
@section('content')


    <div class="container-fluid">
        @include('admin.layout-parts.breadcrumbs')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ $title }}</h4>
                        <div align="right">
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary"><i
                                    class="fa fa-edit"></i> Edit</a>
                            <a href="{{ route('admin.users.index') }}" class="btn btn-dark"><i
                                    class="fa fa-arrow-right"></i> Back</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-xl-12 ">
                                <div class="card">

                                    <div class="col-md-12">
                                        <h1>{{ $user->name }}</h1>
                                        <h3>{{ $user->email }}</h3>
                                        <div>
                                            <span class="badge">Last updated
                                                {{ $user->updated_at->diffForHumans() }}</span>
                                            <div class="pull-right">

                                                @if ($user->is_active == 1)
                                                    <span class="label label-success">Active</span>
                                                @else
                                                    <span class="label label-danger">Inactive</span>
                                                @endif
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    @endsection
    @section('admin_jscript')
        @parent

    @endsection

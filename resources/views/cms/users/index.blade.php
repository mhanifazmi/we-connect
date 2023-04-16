@extends('cms.layouts.master')
@section('title', 'Basic DataTables')

@section('css')

@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
@endsection

@section('breadcrumb-title')
    <h3>{{ $page['title'] }}</h3>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Zero Configuration  Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0 card-no-border d-flex justify-content-between">
                        <h3 class="d-inline-block">{{ $page['subtitle'] }}</h3>
                        @can('Create Users')
                            <a href="{{ route('user.create') }}">
                                <button class="btn btn-primary">Create User</button>
                            </a>
                        @endcan
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display" id="basic-1">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Full Name</th>
                                        <th>URL</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $key => $user)
                                        <tr class="text-center">
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->full_name }}</td>
                                            <td><a target="_blank"
                                                    href="{{ route('index', $user->url) }}">{{ route('index', $user->url) }}</a>
                                            </td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                <ul class="action">
                                                    @can('Create Users')
                                                        <li class="show">
                                                            <a href="{{ route('user.show', $user->hash_id) }}">
                                                                <i class="icon-eye"></i>
                                                            </a>
                                                        </li>
                                                    @endcan
                                                    @can('Edit Users')
                                                        <li class="edit">
                                                            <a href="{{ route('user.edit', $user->hash_id) }}">
                                                                <i class="icon-pencil-alt"></i>
                                                            </a>
                                                        </li>
                                                    @endcan
                                                    @can('Delete Users')
                                                        <li class="delete">
                                                            <a href="{{ route('user.destroy', $user->hash_id) }}">
                                                                <i class="icon-trash"></i>
                                                            </a>
                                                        </li>
                                                    @endcan
                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Zero Configuration  Ends-->
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js') }}"></script>
@endsection

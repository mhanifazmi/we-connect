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
                        @can('Create Links')
                            <a href="{{ route('link.create') }}">
                                <button class="btn btn-primary">Create Link</button>
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
                                        <th>Description</th>
                                        <th>URL</th>
                                        <th>Icon</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user->links as $key => $link)
                                        <tr class="text-center">
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $link->name }}</td>
                                            <td>{{ $link->description }}</td>
                                            <td><a href="{{ $link->url }}">{{ $link->url }}</a></td>
                                            <td><i style="font-size: 30px" class="{{ $link->icon }}"></i></td>
                                            <td>
                                                <ul class="action">
                                                    @can('Create Links')
                                                        <li class="show">
                                                            <a href="{{ route('link.show', $link->hash_id) }}">
                                                                <i class="icon-eye"></i>
                                                            </a>
                                                        </li>
                                                    @endcan
                                                    @can('Edit Links')
                                                        <li class="edit">
                                                            <a href="{{ route('link.edit', $link->hash_id) }}">
                                                                <i class="icon-pencil-alt"></i>
                                                            </a>
                                                        </li>
                                                    @endcan
                                                    @can('Delete Links')
                                                        <li class="delete">
                                                            <a href="{{ route('link.destroy', $link->hash_id) }}">
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

@extends('cms.layouts.master')
@section('title', 'Edit Profile')

@section('css')
@endsection

@section('style')
    <style>
        .svg-box {
            width: 60px;
            height: 60px;
            background: #fff;
            box-shadow: 0px 71.2527px 51.5055px rgba(229, 229, 245, 0.189815), 0px 42.3445px 28.0125px rgba(229, 229, 245, 0.151852), 0px 21.9866px 14.2913px rgba(229, 229, 245, 0.125), 0px 8.95749px 7.16599px rgba(229, 229, 245, 0.0981481), 0px 2.03579px 3.46085px rgba(229, 229, 245, 0.0601852);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 10px
        }

        svg {
            vertical-align: baseline;
        }
    </style>
@endsection

@section('breadcrumb-title')
    <h3>{{ $page['title'] }}</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Users</li>
    <li class="breadcrumb-item active">Edit Profile</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="edit-profile">
            <div class="row">
                <div class="col-xl-12">
                    <form class="card" method="POST">
                        @csrf
                        <div class="card-header">
                            <h4 class="card-title mb-0">{{ $page['subtitle'] }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label">Name</label>
                                        <input value="{{ $link->name }}" name="name" class="form-control"
                                            type="text" placeholder="Name">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        <input value="{{ $link->description }}" name="description" class="form-control"
                                            type="text" placeholder="Description">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label">URL</label>
                                        <input value="{{ $link->url }}" name="url" class="form-control"
                                            type="text" placeholder="URL">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label">Icon</label>
                                        <div class="input-group">
                                            <input value="{{ $link->icon }}" name="icon" readonly
                                                class="form-control icon" type="text" placeholder="Select Icon"
                                                aria-label="Recipient's username" spellcheck="false" data-ms-editor="true">
                                            <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                                                data-bs-target="#exampleModalCenter">Select Icon</button>
                                        </div>
                                        <div class="svg-box text-center"
                                            style="background-color: #d8e1ff; font-size: 50px;">
                                            <i class="preview-icon {{ $link->icon }}" style="font-size: 50px"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                    </form>
                    @include('cms.links.icons')
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('.icon-lists div').click(function() {
            let preview = $(".preview-icon");
            $(".icon-lists").addClass('m-b-50');
            $(".fa-fa-icon-show-div").show();
            $(".fa-fa-icon-show-div").removeClass('opecity-0');
            var font_class = ($(this).children().attr('class'));
            $(".icon").val(font_class);
            preview.removeClass();
            preview.addClass('preview-icon');
            preview.addClass(font_class);
            $(".svg-box").removeClass('d-none');
            $('#exampleModalCenter').modal('toggle');
        });
    </script>
@endsection

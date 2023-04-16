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
                    <form class="card" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-header">
                            <h4 class="card-title mb-0">{{ $page['subtitle'] }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3 input">
                                        <label class="form-label">Name</label>
                                        <input name="name" class="form-control" type="text"
                                            value="{{ $user->name }}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3 input">
                                        <label class="form-label">Email</label>
                                        <input name="email" class="form-control" type="text"
                                            value="{{ $user->email }}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3 input">
                                        <label class="form-label">Full Name</label>
                                        <input name="full_name" class="form-control change-url" type="text"
                                            value="{{ $user->full_name }}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3 input">
                                        <label class="form-label">URL</label>
                                        <div class="input-group">
                                            <span class="input-group-text">{{ url('') }}/</span>
                                            <input name="url" class="form-control url-name" type="text"
                                                value="{{ $user->url }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3 input">
                                        <label class="form-label">Description</label>
                                        <input name="description" class="form-control" type="text"
                                            value="{{ $user->description }}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3 input">
                                        <label class="form-label">Role</label>
                                        <select name="role_id" class="form-select digits" id="exampleFormControlSelect9">
                                            @foreach ($roles as $key => $role)
                                                @if ($role->id == $user->role_id)
                                                    <option selected value="{{ $role->id }}">{{ $role->name }}
                                                    </option>
                                                @else
                                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3 input">
                                        <label class="form-label">Image</label>
                                        <input name="image" class="form-control" type="file">
                                        <img style="width: 25%; margin: 10px;"
                                            src="{{ asset('storage/images/' . $user->image) }}" />
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3 input">
                                        <label class="form-label">Background</label>
                                        <input name="background" class="form-control" type="file">
                                        <img style="width: 25%; margin: 10px;"
                                            src="{{ asset('storage/backgrounds/' . $user->background) }}" />

                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3 input">
                                        <label class="form-label">New Password</label>
                                        <input name="new_password" class="form-control" type="password">
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
            $(".icon-lists").addClass('m-b-50');
            $(".fa-fa-icon-show-div").show();
            $(".fa-fa-icon-show-div").removeClass('opecity-0');
            var font_class = ($(this).children().attr('class'));
            $(".icon").val(font_class);
            $(".preview-icon").addClass(font_class);
            $(".svg-box").removeClass('d-none');
            $('#exampleModalCenter').modal('toggle');
        });
    </script>
    <script>
        $('input').each(function() {
            var label = $(this).closest('.input').find('.form-label').html();
            $(this).attr('placeholder', label);
        });
    </script>
    <script>
        $('.change-url').on('propertychange input', function(e) {
            let data = {
                name: $(this).val(),
            }

            $.ajax({
                type: 'post',
                url: window.location.origin + '/api/url-name',
                cache: false,
                data: data,
                success: function(data) {
                    $('.url-name').val(data)
                },
                error: function(xhr, status, error) {
                    return 'Error';
                }
            });


        });
    </script>
@endsection

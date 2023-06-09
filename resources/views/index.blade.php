@extends('layouts.master', compact('image'))
@section('content')
    <!-- Container-fluid starts-->

    <div class="container-fluid">
        <div class="row widget-grid d-flex justify-content-center">
            <div class="col-xl-4 col-sm-6 col-xxl-3 col-ed-4 box-col-4" style="margin-top: 3rem">
                <div class="card social-profile">
                    <div class="card-body">
                        <div class="social-img-wrap">
                            <div class="social-img"><img src="{{ asset('storage/images/' . $user->image) }}" alt="profile">
                            </div>
                        </div>
                        <div class="social-details">
                            <h5 class="mb-1"><a href="social-app.html"><?= $user->full_name ?></a></h5><span
                                class="f-light">{{ $user->description }}</span>
                            {{-- <ul class="card-social">
                                <li><a href="https://www.facebook.com/" target="_blank"><i class="fa fa-facebook"></i></a>
                                </li>
                                <li><a href="https://accounts.google.com/" target="_blank"><i
                                            class="fa fa-google-plus"></i></a></li>
                                <li><a href="https://twitter.com/" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="https://www.instagram.com/" target="_blank"><i class="fa fa-instagram"></i></a>
                                </li>
                                <li><a href="https://rss.app/" target="_blank"><i class="fa fa-rss"></i></a></li>
                            </ul> --}}
                        </div>
                    </div>
                </div>
                @foreach ($user->links as $key => $link)
                    <a target="_blank" href="{{ route('go-to', ['type' => 'Link', 'foreign_key_id' => $link->hash_id]) }}">
                        <div class="light-card balance-card widget-hover bg-white mb-4" style="color: initial;">
                            <div class="svg-box" style="background-color: #d8e1ff; font-size: 30px;">
                                <i class="<?= $link->icon ?>"></i>
                            </div>
                            <div>
                                <h6 class="mt-1 mb-0"><?= $link->name ?></h6>
                                <span class="f-light"><?= $link->description ?></span>
                            </div>
                            {{-- <div class="ms-auto text-end">
                                <div class="dropdown icon-dropdown">
                                    <button class="btn dropdown-toggle" id="incomedropdown" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="icon-more-alt"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="incomedropdown">
                                        <a class="dropdown-item" href="#">Today</a>
                                        <a class="dropdown-item" href="#">Tomorrow</a>
                                        <a class="dropdown-item" href="#">Yesterday </a>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script>
        localStorage.clear();
        $(".page-wrapper").attr("class", "page-wrapper only-body");
        localStorage.setItem('page-wrapper', 'only-body');
    </script>
    <script src="{{ asset('assets/js/jquery.ui.min.js') }}"></script>
    <script src="{{ asset('assets/js/dragable/sortable.js') }}"></script>
    <script src="{{ asset('assets/js/dragable/sortable-custom.js') }}"></script>
@endsection

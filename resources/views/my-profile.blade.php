@extends('layouts.application')

@section('content')
  <div class="container-fluid no-padding">
    <div class="heading-slider-wrapper" style="
    height: 263px;
      background: url(http://localhost:8005/images/header-profile.jpg) no-repeat;
      background-size: cover;
      background-position: center;
    ">
      {{-- <div class="banner-video-wrapper">
        <video loop="" muted="" autoplay="" poster="" class="banner-video__video" src="https://ecs7.tokopedia.net/assets/media/careers/video-banner-small.mp4"></video>
      </div> --}}
      {{-- <div class="caption-job-header">
        <h1>{{Auth::user()->name}}</h1>
      </div> --}}

    </div>

      <div class="row justify-content-center" style="margin-top:-88px">
        @if (Auth::user()->photo_profile !== NULL)
          <img class="user-avatar rounded-circle" style="height: 162px;" src="{{Auth::user()->photo_profile}}" alt="User Avatar">
        @else
          <img class="user-avatar rounded-circle" style="height: 162px;" src="{{asset('images/male-blank.jpg')}}" alt="User Avatar">
        @endif

      </div>
      <div class="row justify-content-center" >
        <div class="col-md-4 text-center" style="margin-top: 21px;">
          <h3 style="text-transform:uppercase">{{Auth::user()->name}}</h3>
        </div>
      </div>
  </div>
@endsection

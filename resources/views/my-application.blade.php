@extends('layouts.application')

@section('content')
<div class="container-fluid no-padding">
  <div class="heading-slider-wrapper">
    {{-- <div class="banner-video-wrapper">
      <video loop="" muted="" autoplay="" poster="" class="banner-video__video" src="https://ecs7.tokopedia.net/assets/media/careers/video-banner-small.mp4"></video>
    </div> --}}
    <div class="caption-job-header">
      <h1>My Application</h1>
    </div>
  </div>
  <div class="">
    @if ($applies->count() !== 0)
    <div class="row justify-content-center background-grey-gradient" style="padding-top:20px">
        @foreach ($applies as $apply)
          <div class="col-md-10" style="">
            <div class="card-wrapper-job">
              <span class="card-job-title">
                {{strtoupper($apply->job->job_title)}}
              </span>
              <div class="job-time-criteria">
                <span class="fa fa-briefcase"></span>
                {{$apply->job->time_type}}
              </div>
              <div class="job-time-criteria">
                <span class="fa fa-map-marker"></span>
                {{$apply->job->work_location}}
              </div>
              <a href="{{route('job.desc',['id'=>$apply->job->id])}}" class="btn btn-warning">Detail</a>
            </div>
          </div>
        @endforeach

    </div>

  @else
    <div class="col-md-12 text-center" style="padding:100px">
      <h3>Apply Job yang tersedia <a href="{{route('home')}}">di sini</a></h3>
    </div>
  @endif


  </div>
</div>
@endsection
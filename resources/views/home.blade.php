@extends('layouts.application')

@section('content')
<div class="container-fluid no-padding">
  <div class="main-slider-wrapper">
    {{-- <div class="banner-video-wrapper">
      <video loop="" muted="" autoplay="" poster="" class="banner-video__video" src="https://ecs7.tokopedia.net/assets/media/careers/video-banner-small.mp4"></video>
    </div> --}}
    <div class="caption-job-header">
      <h1>Available Jobs</h1>
    </div>
  </div>
  <div class="">
    <div class="row justify-content-center background-grey-gradient" style="padding-top:20px">
      @foreach ($jobs as $job)
        <div class="col-md-4" style="">
          <div class="card-wrapper-job">
            <span class="card-job-title">
              {{strtoupper($job->job_title)}}
            </span>
            <div class="job-time-criteria">
              <span class="fa fa-briefcase"></span>
              {{$job->time_type}}
            </div>
            <div class="job-time-criteria">
              <span class="fa fa-map-marker"></span>
              {{$job->work_location}}
            </div>
            <a href="{{route('job.desc',['id'=>$job->id])}}" class="btn btn-warning">Detail</a>
          </div>
        </div>
      @endforeach

    </div>
  </div>
</div>
@endsection

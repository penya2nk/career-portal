@extends('layouts.application')

@section('content')
<div class="container-fluid no-padding">
  <div class="main-slider-wrapper">
    <div class="banner-video-wrapper">
      <video loop="" muted="" autoplay="" style="width:100%" poster="" class="banner-video__video" src="https://res.cloudinary.com/blst/video/upload/v1533287684/video-banner-blst.mp4"></video>
    </div>
    <div class="caption-job-header">
      <h1>Available Jobs <br> {{$jobs->count()}}</h1>
    </div>
  </div>
  <div class="container-fluid background-grey-gradient" style="padding-bottom:80px">
    <div class="row justify-content-center " style="padding-top:20px">
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

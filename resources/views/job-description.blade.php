@extends('layouts.application')

@section('content')
<div class="container-fluid no-padding">
  <div class="main-slider-wrapper" style="
  height: 263px;
    background: url({{asset('images/header-profile.jpg')}}) no-repeat;
    background-size: cover;
    background-position: center;
  ">
    {{-- <div class="banner-video-wrapper">
      <video loop="" muted="" autoplay="" style="width:100%" poster="" class="banner-video__video" src="https://res.cloudinary.com/blst/video/upload/v1533287684/video-banner-blst.mp4"></video>
    </div> --}}

  </div>
  <div class="job-desc">
    <div class="col-md-12">
      <div class="row" style="padding-top:20px">
        <div class="col-md-8">
          {{-- title Head --}}
          <div class="row">
            <div class="col-md-12">
              <span class="badge badge-secondary company-blst">{{$job->company->name_company}}</span>
              <h1 style="margin-top: 20px;"><b>{{$job->job_title}}</b></h1>
            </div>
          </div>
          {{-- Sub Judul  --}}
          <div class="row">
            <div class="col-md-12">
              <div class="detail-job-sub-container">
                <div class="detail-job-sub" data-toggle="tooltip" data-placement="top" title="Pekerjaan">
                  <span class="fa fa-briefcase"></span> {{$job->time_type}}
                </div>
                <div class="detail-job-sub">
                  <span class="fa fa-map-marker"></span> {{$job->work_location}}
                </div>
              </div>
            </div>
          </div>

          {{-- Description --}}
          <div class="row">
            <div class="col-md-12">
              <div class="job-description">
                <h3>Deskripsi</h3>
                {!! $job->job_description !!}
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="job-description">
                <h3>Kebutuhan</h3>
                {!! $job->skill_requirement !!}
              </div>
            </div>
          </div>

        </div>

        <div class="col-md-4">
          <div class="row">
            <div class="col-md-12 text-center">

              @if ($job->deadline->greaterThan(Carbon\Carbon::now()))
                <div class="apply-button">
                  <a href="{{route('job.desc.apply',['id'=>$job->id])}}" class="btn btn-warning btn-square btn-block btn-lg"><span class="fa fa-briefcase"></span> Apply</a>
                </div>
                <small>Deadline : {{$job->deadline->format('d F Y')}} <br> ({{$job->deadline->diffforHumans()}})</small>
              @else
                <div class="apply-button">
                  <a href="#" class="btn btn-secondary btn-square btn-block btn-lg" style="border-bottom: 9px solid #4d4d4d;"><span class="fa fa-lock"></span> Closed</a>
                </div>
              @endif

            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="job-description">
                <h5>Kemampuan yang dibutuhkan</h5>
                <ul>
                  @foreach (explode(',',$job->skill_tag) as $element)
                    <li>{{$element}}</li>
                  @endforeach
                </ul>
              </div>
            </div>
          </div>
          {{-- <div class="row text-center">
            <div class="col-md-12">
              <p>Mencari Pekerjaan Lain ?</p>
              <a href="#">Pekerjaan yang tersedia</a>
            </div>
          </div> --}}
        </div>
      </div>
    </div>
  </div>
</div>

@if (session()->has('status'))
<script type="text/javascript">
    swal({
                  title:'Success!',
                  text:'{{session()->get('status')}}',
                  type:'success'
                },
              )

</script>
@endif

@if (session()->has('error'))
<script type="text/javascript">
    swal({
                  title:'Error!',
                  text:'{{session()->get('error')}}',
                  type:'Error'
                },
              )

</script>
@endif
@endsection

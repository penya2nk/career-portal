@extends('layouts.application')

@section('content')
<div class="container-fluid no-padding">
  <div class="main-slider-wrapper">
    {{-- <div class="banner-video-wrapper">
      <video loop="" muted="" autoplay="" poster="" class="banner-video__video" src="https://ecs7.tokopedia.net/assets/media/careers/video-banner-small.mp4"></video>
    </div> --}}

  </div>
  <div class="job-desc">
    <div class="col-md-12">
      <div class="row" style="padding-top:20px">
        <div class="col-md-8">
          {{-- title Head --}}
          <div class="row">
            <div class="col-md-12">
              <span class="badge badge-secondary company-blst">Agri Lestari Indonesia</span>
              <h1 style="margin-top: 20px;"><b>Product Analyst</b></h1>
            </div>
          </div>
          {{-- Sub Judul  --}}
          <div class="row">
            <div class="col-md-12">
              <div class="detail-job-sub-container">
                <div class="detail-job-sub" data-toggle="tooltip" data-placement="top" title="Pekerjaan">
                  <span class="fa fa-briefcase"></span> Function
                </div>
                <div class="detail-job-sub">
                  <span class="fa fa-map-marker"></span> Location
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
            <div class="col-md-12">
              <div class="apply-button">
                <a href="{{route('job.desc.apply',['id'=>$job->id])}}" class="btn btn-warning btn-square btn-block btn-lg"><span class="fa fa-briefcase"></span> Apply</a>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="job-description">
                <h5>Kemampuan</h5>
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
@endsection

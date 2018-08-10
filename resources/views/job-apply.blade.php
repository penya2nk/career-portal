@extends('layouts.application')

@section('content')
<link rel="stylesheet" href="{{asset('js/raty/jquery.raty.css')}}">
<script src="{{asset('js/raty/jquery.raty.js')}}"></script>

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
  <form class="" action="{{route('job.desc.post',['id'=>$jobs->id])}}" method="post">
    {{ csrf_field() }}
    <div class="job-desc">
    <div class="col-md-12">
      <div class="row" style="padding-top:20px">
        <div class="col-md-8">
          <div class="parameter-need">
            <div class="row">
              <div class="col-md-12">
                <h2><b>Skill</b></h2>
                <small>Berikan nilai seberapa besar kemampuan anda</small>
              </div>
            </div>


            @foreach (explode(",",$jobs->skill_tag) as $element)
              <div class="row" style="margin-top: 15px;">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-3" style="padding: 12px;">
                      <h4>{{$element}}</h4>
                    </div>
                    <div class="col-md-6">
                      {{-- <div id="" class="rating">
                      </div> --}}
                      <div class="">
                        <input type="radio" name="skill[{{$element}}]" value="1" /><label for="star5" title="5 star">1</label>
                        <input type="radio" name="skill[{{$element}}]" value="2" /><label for="star4" title="4 star">2</label>
                        <input type="radio" name="skill[{{$element}}]" value="3" /><label for="star3" title="3 star">3</label>
                        <input type="radio" name="skill[{{$element}}]" value="4" /><label for="star2" title="2 star">4</label>
                        <input type="radio" name="skill[{{$element}}]" value="5" /><label for="star1" title="1 star">5</label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            @endforeach
            {{-- <script type="text/javascript">
              $('.rating').raty({ path: '{{asset('js/raty/images')}}' });
            </script> --}}

          </div>
        </div>

        <div class="col-md-4">
          <div class="row">
            <div class="col-md-12">
              <div class="apply-button">
                <button type="submit" class="btn btn-warning btn-square btn-block btn-lg">
                  <span class="fa fa-briefcase"></span> Apply
                </button>
                {{-- <a href="" class="btn btn-warning btn-square btn-block btn-lg"><span class="fa fa-briefcase"></span> Apply</a> --}}
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
  </form>
</div>

@if (session()->has('status'))
<script type="text/javascript">
    swal({
                  title:'Gagal!',
                  text:'{{session()->get('status')}}',
                  type:'error'
                },
              )

</script>
@endif
@endsection

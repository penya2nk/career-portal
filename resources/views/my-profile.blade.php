@extends('layouts.application')

@section('content')
  <div class="container-fluid no-padding">
    <div class="heading-slider-wrapper" style="
    height: 263px;
      background: url({{asset('images/header-profile.jpg')}}) no-repeat;
      background-size: cover;
      background-position: center;
    ">
      {{-- <div class="banner-video-wrapper">
        <video loop="" muted="" autoplay="" poster="" class="banner-video__video" style="width:100%" src="https://res.cloudinary.com/blst/video/upload/v1533287684/video-banner-blst.mp4"></video>
      </div> --}}
      {{-- <div class="caption-job-header">
        <h1>{{Auth::user()->name}}</h1>
      </div> --}}

    </div>

      <div class="container">
        <div class="row justify-content-center" style="margin-top:-88px">
          <div class="col-md-2">
            @if (Auth::user()->profpic !== NULL)
              <div class="image-profpic-2" >
                <img class="profpic-2 " src="{{Auth::user()->profpic}}" alt="User Avatar">
              </div>
            @else
              <img class="user-avatar rounded-circle" style="height: 162px;" src="{{asset('images/male-blank.jpg')}}" alt="User Avatar">
            @endif
            <div class="row" style="margin-top:30px">
              <div class="col-md-12 text-center">
                <a href="{{route('profile.edit')}}" class="btn btn-warning">Edit</a>
              </div>
            </div>
          </div>
          <div class="col-md-8">
            <div class="row">
              <div class="col-md-12">
                <div class="" style="margin-top: 21px;color:white; display:block; height:69px">
                  <h1 style="text-transform:uppercase">{{Auth::user()->name}}</h1>
                </div>
              </div>
            </div>
            <div class="row" style="margin-top:20px">
              <div class="col-md-12">
                <table class="table">
                  <tbody>
                    <tr>
                        <td>
                          <span class="fa fa-birthday-cake" style="margin-right:20px"></span>
                          <span>
                            {{Auth::user()->born_date !== NULL ? Auth::user()->born_date->format('d-M-Y') : ''}} ({{Auth::user()->born_date !== NULL ? Auth::user()->born_date->age : ''}} Tahun)
                          </span>
                        </td>
                        <td>
                            <span class="fa fa-graduation-cap " style="margin-right:20px"></span>
                            <span>
                              {{Auth::user()->institution}} ({{Auth::user()->year}})
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                          <span class="fa fa-mobile" style="margin-right:20px"></span>
                          <span>
                            {{Auth::user()->phone}}
                          </span>
                        </td>
                        <td>
                            <span class="fa fa-paper-plane " style="margin-right:20px"></span>
                            <span>
                              {{Auth::user()->major}} (GPA: {{Auth::user()->gpa}}/{{Auth::user()->gpa_max}})
                            </span>
                        </td>
                    </tr>
                    <tr>
                      <td>
                        <span class="fa fa-facebook-square" style="margin-right:20px"></span>
                        <span>
                        <a href="{{Auth::user()->facebook !== NULL ? 'https://www.facebook.com/'.Auth::user()->facebook : '#'}}" target="_blank" class="btn btn-sm btn-primary">Facebook</a>
                        </span>
                      </td>
                      <td>
                        <span class="fa fa-instagram" style="margin-right:20px"></span>
                        <span>
                        <a href="{{Auth::user()->instagram !== NULL ? 'https://www.instagram.com/'.Auth::user()->instagram : '#'}}" target="_blank" class="btn btn-sm btn-warning">Instagram</a>
                        </span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <span class="fa fa-id-card" style="margin-right:20px"></span>
                        <span>
                        CV:  <a href="{{Auth::user()->resume !== NULL ? Auth::user()->resume : '#'}}" target="_blank" class="btn btn-sm btn-success">Download</a>
                        </span>
                      </td>
                    </tr>

                  </tbody>
                </table>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <p>{{Auth::user()->about}}</p>
              </div>
            </div>
            <div class="row" style="margin-top:30px">
              <div class="col-md-12">
                <h3>
                  Experience
                  <a href="{{route('experience.add.index')}}" class="btn btn-sm btn-success">
                    Add Experience
                  </a>
                </h3>
                <hr>
              </div>
            </div>

            @if (Auth::user()->experiences()->count() !== 0)
              @foreach (Auth::user()->experiences as $experience)
                <div class="row">
                  <div class="col-md-12">
                    <div class="card-wrapper-job" style="background:#ededed">
                      <div class="row">
                        <div class="col-md-6">
                          <span class="card-job-title" style="font-size:21pt">
                            {{$experience->cv_position}}
                          </span>
                          <div class="job-time-criteria">
                            <span class="fa fa-briefcase"></span>
                            {{$experience->cv_company}}
                          </div>
                          <div class="job-time-criteria">
                            <span class="fa fa-map-marker"></span>
                            {{$experience->cv_city}}
                          </div>
                          <div class="job-time-criteria">
                            <span class="fa fa-calendar"></span>
                            {{$experience->y1_sdmcv->format('d F Y')}} - {{$experience->y2_sdmcv->format('d F Y')}}
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="Deskripsi" style="font-size: 10pt; color: gray;">
                            <p>
                              {{$experience->cv_description}}
                            </p>
                          </div>
                        </div>
                      </div>
                      <form class="" style="position: absolute; right: 10px; bottom: 10px; opacity: 0.4;" action="{{route('experience.add.edit')}}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="id_exp" value="{{$experience->id}}">
                        <button type="submit" class="btn btn-secondary btn-sm">
                          Edit
                        </button>
                      </form>
                      <form class="" style="position: absolute; right: 64px; bottom: 10px; opacity: 0.4;" action="{{route('experience.add.delete')}}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="id_exp" value="{{$experience->id}}">
                        <button type="button" class="btn btn-sm btn-default delete-button">
                          Delete
                        </button>
                      </form>
                    </div>
                  </div>
                </div>
              @endforeach
            @endif


          </div>
        </div>
      </div>


      <div class="row justify-content-center" >

      </div>
      <div class="row justify-content-center" style="margin-top:20px">
        <div class="col-md-8 text-center">

        </div>
      </div>
  </div>

  <div class="modal fade" id="tes" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id=""></h4>
        </div>
        <div class="modal-body">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary"></button>
        </div>
      </div>
    </div>
  </div>



  @if (session()->has('success'))
  <script type="text/javascript">
      swal({
                    title:'Success !',
                    text:'{{session()->get('success')}}',
                    type:'success'
                  },
                )

  </script>
  @endif

  <script type="text/javascript">
                $('.delete-button').on('click', function() {
                  swal({
                    title: "Hapus ?",
                    text: "Apakah anda yakin ingin menghapus ?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#f44336",
                    confirmButtonText: "Ya, Saya Yakin !",
                    cancelButtonText: "Cancel"

                  }).then((result) => {
                if (result.value) {
                  $(this).parent().submit();
                }
              });


                });
              </script>
@endsection

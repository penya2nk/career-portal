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
          <div class="col-md-6">
            <div class="row">
              <div class="col-md-12">
                <div class="" style="margin-top: 21px;color:white; display:block; height:69px">
                  <h1 style="text-transform:uppercase">{{Auth::user()->name}}</h1>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="row" style="margin-top:20px">
                  <div class="col-md-12">

                    <form class="" @if(isset($status)) action="{{route('experience.add.update')}}" @else action="{{route('experience.add.post')}}" @endif  method="post">
                      {{ csrf_field() }}
                      <h3>Add Experience</h3>
                      <hr>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="">Type:</label>
                            <select class="form-control" name="cv_type" required>
                              <option  @if(isset($status) && $exp->cv_type == "job") selected @endif  value="job" >Work</option>
                              <option  @if(isset($status) && $exp->cv_type == "org") selected @endif value="org" >Organization</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="">Nama Perusahaan / Organisasi</label>
                            <input type="text"  @if(isset($status)) value="{{$exp->cv_company}}" @endif name="cv_company" required class="form-control" id="" placeholder="">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="">Posisi</label>
                            <input type="text" class="form-control" @if(isset($status)) value="{{$exp->cv_position}}" @endif name="cv_position" value="" required>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="">Tempat</label>
                            <input type="text" class="form-control" @if(isset($status)) value="{{$exp->cv_city}}" @endif name="cv_city" value="" required>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="">Dari Tanggal</label>
                            <div class="input-group">
                              <input type="date" class="form-control tanggal" @if(isset($status)) value="{{$exp->y1_sdmcv->format('Y-m-d')}}" @endif name="y1_sdmcv" required>
                              <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="">Hingga Tanggal</label>
                              <div class="input-group">
                                <input type="date" class="form-control tanggal" @if(isset($status)) value="{{$exp->y2_sdmcv->format('Y-m-d')}}" @endif name="y2_sdmcv" required>
                                <span class="input-group-addon">
                                  <span class="glyphicon glyphicon-calendar"></span>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <label for="description" class="control-label">Deskripsi Kerja</label>
                                <textarea class="form-control" name="cv_description" rows="8" cols="80" required>@if(isset($status)){{$exp->cv_description}}@endif</textarea>
                                <span class="help-block with-errors"></span>
                              </div>
                            </div>
                          </div>

                          @if(isset($status))
                            <input type="hidden" name="id_exp" value="{{$exp->id}}">
                          @endif

                          <div class="row">
                            <div class="col-md-12">
                              <button type="sumbit" class="btn btn-success">
                                Submit
                              </button>
                            </div>
                          </div>
                    </form>



                  </div>
                </div>
              </div>
            </div>
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

  <div class="modal fade" id="add-experience" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
     <div class="modal-dialog">
       <div class="modal-content isimodal">
         <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
           <h3>Add Career History</h3>
         </div>
         <div class="modal-body">
           <div class="form-horizontal">



         </div>
       </div>
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
@endsection

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

  <div class="modal fade" id="add-work" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
     <div class="modal-dialog">
       <div class="modal-content isimodal">
         <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
           <h3>Add Career History</h3>
         </div>
         <div class="modal-body">
           <div class="form-horizontal">


           <form class="form-group" id="add-history" action="{{route('experience.add')}}" method="post" data-toggle="validator" role="form">

             <div class="form-group">
               <label for="type" class="col-sm-2 control-label">Jenis:</label>
               <div class="col-sm-3">
               <select class="form-control" name="cv_type" required>
                   <option value="job" >Work</option>
                   <option value="org" >Organization</option>
                 </select> <span class="help-block with-errors"></span>
               </div>
             </div>

           <div class="form-group">
           <label for="institutionname" class="col-sm-2 control-label">Company Name</label>
           <div class="col-sm-10"><input type="text" class="form-control" name="cv_company" value="" required ><span class="help-block with-errors"></span></div>
           </div>

           <div class="form-group">
           <label for="institutionname" class="col-sm-2 control-label">Position</label>
           <div class="col-sm-10"><input type="text" class="form-control" name="cv_position" value="" required><span class="help-block with-errors"></span></div>
           </div>

           <div class="form-group">
           <label for="cvcity" class="col-sm-2 control-label">Place</label>
           <div class="col-sm-10"><input type="text" class="form-control" name="cv_city" value="" required><span class="help-block with-errors"></span></div>
           </div>

          <div class="row">
             <div class="form-group">
           <label for="datein" class="col-sm-2 control-label">Start Date</label>
           <div class="col-sm-4">
           <div class="input-group">
             <input type="text" class="form-control tanggal" name="y1_sdmcv" value=""  required>
             <span class="input-group-addon">
             <span class="glyphicon glyphicon-calendar"></span></div>
             </span> <span class="help-block with-errors"></span>
           </div>

          </div>

           <div class="form-group">
           <label for="datein" class="col-sm-2 control-label">End Date</label>
           <div class="col-sm-4">
           <div class="input-group">
             <input type="text" class="form-control tanggal" name="y2_sdmcv" value="" required>
             <span class="input-group-addon">
             <span class="glyphicon glyphicon-calendar"></span></div>
             </span> <span class="help-block with-errors"></span>
           </div>

           </div>

           <div class="form-group">
           <label for="description" class="col-sm-2 control-label">Job Description</label>
           <div class="col-sm-10"><textarea class="form-control" name="cv_description" rows="8" cols="80" required></textarea><span class="help-block with-errors"></span></div>
           </div>

            </div>
          </div>
         <div class="modal-footer">
           <div class="">
           {{ csrf_field()}}
           <button type="submit" class="btn btn-success btn-lg" name="submit">Save</button>
           <a class="btn btn-danger  btn-lg" role-"button" data-dismiss="modal">Cancel</a>
           </form>
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

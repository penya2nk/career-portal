@extends('layouts.adminlayout')

@section('title')
Add Job Vacancy
@endsection

@section('header-script')
  <link href="{{asset('summernote/summernote.css')}}" rel="stylesheet">
  <script src="{{asset('summernote/summernote.js')}}"></script>

  {{-- Auto Tagging --}}
  <link  href="{{asset('js/tagging/bootstrap-tagsinput.css')}}" rel="stylesheet">
  <script src="{{asset('js/tagging/bootstrap-tagsinput.js')}}"></script>

  <style media="screen">
  span.tag.label.label-info {
  background: grey;
  font-size: 10pt;
  margin: 0px;
  padding:  8px;
  line-height: 3;
  border-radius: 18px;
}
  </style>

@endsection

@section('right-header')
  <a href="{{route('admin.jobvacancy.index')}}" style="margin: 10px;" class="btn btn-warning">Back</a>
  <button type="button" id="save-button" class="btn btn-info">
    Save
  </button>
@endsection

@section('content')
<form data-toggle="validator" id="job-editor" class="" @if(!isset($status)) action="{{route('admin.jobvacancy.create')}}" @else action="{{route('admin.jobvacancy.postedit', ['id'=>$job->id])}}" @endif  method="post">
  {{ csrf_field() }}
  {{-- Modul SDM BLST --}}
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <strong>Super Admin</strong>
          <small>person yang bisa menilai dan melihat nilai dan bisa menenentukan tahap mana menilai</small>
        </div>
        <div class="card-body card-block">
          <div class="form-group">
            <select multiple class="form-control select2" name="id_blst[]">
              @foreach ($tbluser as $user)
                <option
                  @if(isset($status) && $job->admins()->count() !== 0) @if(in_array($user->id_user, $job->admins->pluck('id_blst')->toArray())) selected @endif @endif
                  value="{{$user->id_user}}">{{$user->name_user}}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <strong>Daftar Penilai</strong>
          <small>person yang hanya bisa menilai</small>
        </div>
        <div class="card-body card-block">
          <div class="form-group">
            <select multiple class="form-control select2" name="appraiser[]">
              @foreach ($tbluser as $user)
                <option
                  @if(isset($status) && $job->appraiser()->count() !== 0) @if(in_array($user->id_user, $job->appraiser->pluck('id_blst')->toArray())) selected @endif @endif
                  value="{{$user->id_user}}">{{$user->name_user}}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <strong>Perusahaan</strong>
        </div>
        <div class="card-body card-block">
          <div class="form-group">
            <select class="form-control select2" name="company_id">
              @foreach (App\models\company::all() as $company)
                <option @if(isset($status)) @if($job->company_id == $company->id_company) selected @endif @endif value="{{$company->id_company}}">{{$company->name_company}} ({{$company->comt_data}})</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <strong>Status</strong>
        </div>
        <div class="card-body card-block">
          <div class="form-group">
            <select class="form-control" name="published">
              <option @if(isset($status)) @if($job->published == "1") selected @endif @endif value="1">Published</option>
              <option @if(isset($status)) @if($job->published == "0") selected @endif @endif value="0">Draft</option>
            </select>
          </div>

          <div class="form-group">
            <label for="">Deadline Submission</label>
            <input type="date" @if(isset($status)) @if($job->deadline->format('dmY') == "3011-0001") value="{{Carbon\Carbon::now()->addDays(29)->format('Y-m-d')}}" @else value="{{$job->deadline->format('Y-m-d')}}" @endif @else value="{{Carbon\Carbon::now()->addDays(29)->format('Y-m-d')}}" @endif name="deadline" class="form-control" id="" placeholder="">
          </div>
        </div>
      </div>
    </div>
  </div>
    <div class="row">
      <div class="col-lg-6">
        <div class="card">
          <div class="card-header"><strong>Job</strong> Basic Information</div>
          <div class="card-body card-block">
            <div class="form-group">
              <label for="company" class=" form-control-label">Job Title</label>
              <input type="text" required id="job-title" name="job_title" @if(isset($status)) value="{{$job->job_title}}" @endif  placeholder="Enter the Job Title" class="form-control">
                <div class="help-block with-errors"></div>
              </div>
              <div class="form-group">
                <label for="">Time Criteria</label>
                <select required class="form-control" id="time-type" name="time_type">
                  <option @if(isset($status)) @if($job->time_type == "Full Time") selected @endif @endif value="Full Time">Full Time</option>
                    <option @if(isset($status)) @if($job->time_type == "Part Time") selected @endif @endif value="Part Time">Part Time</option>
                    </select>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="">Work Location</label>
                    <input type="text" @if(isset($status)) value="{{$job->work_location}}" @endif name="work_location" class="form-control" required id="" placeholder="">
                    </div>
                    <div class="form-group">
                      <label for="">Years of experience</label>
                      <div class="input-group">
                        <input type="number" @if(isset($status)) value="{{$job->min_experience}}" @endif name="min_experience" min="0" required class="form-control" id="" placeholder="">
                          <span class="input-group-addon">Year</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-lg-6">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="card">
                        <div class="card-header"><strong>Skill</strong> Parameter <small style="color:grey">(Press Comma , to Add More)</small></div>

                        <div class="card-body card-block">
                          <div class="form-group">
                            <label for=""></label>
                            <input required type="text" @if(isset($status)) value="{{$job->skill_tag}}" @endif class="form-control tag-input" data-role="tagsinput" name="skill_tag" value="">
                              <div class="help-block with-errors"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="card">
                          <div class="card-header"><strong>Tahap</strong> Seleksi <small style="color:grey">(Please check below)</small></div>
                          <div class="card-body card-block">
                            @if (App\models\stage::all()->count() == 0)
                              Buat Tahapan Seleksi Terlebih dahulu pada menu <a href="{{route('stage.index')}}">"Tahapan Seleksi"</a>
                            @endif
                            @foreach (App\models\stage::all() as $stages)
                              <div class="checkbox">
                                <label><input type="checkbox" @if(isset($status) && unserialize($job->stages_list) !== NULL &&  isset($status)) @if(in_array($stages->id,unserialize($job->stages_list))) checked @endif @endif name="stage[]" value="{{$stages->id}}"> {{$stages->stage_name}}</label>
                              </div>
                            @endforeach
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>
    </div>


  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header"><strong>Job</strong> Description</div>
        <div class="card-body card-block">
          <div class="form-group">
            <textarea required name="job_description" class="form-control wy-note" rows="8" cols="80">@if(isset($status)){{$job->job_description}}@endif</textarea>
            <div class="help-block with-errors"></div>
          </div>
        </div>
      </div>

    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header"><strong>Skill</strong> Requirements</div>
        <div class="card-body card-block">
          <div class="form-group">
            <textarea required  name="skill_requirement"  class="form-control wy-note" rows="8" cols="80">@if(isset($status)){{$job->skill_requirement}}@endif</textarea>
          </div>
        </div>
      </div>
    </div>
  </div>



  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <button type="submit" class="btn btn-info">Save</button>
      </div>
    </div>
  </div>

</form>


  @section('script')
    {{-- <script type="text/javascript">
      jQuery(document).ready(function($) {
        $('.tag-input').tagsinput({
          confirmKeys: [13, 44]
        });
      });
    </script> --}}

    <script type="text/javascript">
    jQuery(document).ready(function($) {
      $('.wy-note').summernote(
        {
          tabsize: 2,
          width: "90%",                 // set editor height
          minHeight: null,             // set minimum height of editor
          maxHeight: null,             // set maximum height of editor
          dialogsInBody: true,
          height: 250,
          popover: {
           image: [],
           link: [],
           air: []
         }
        }
      );
      });
    </script>

    <script type="text/javascript">
      $('#save-button').on('click', function() {
        $('#job-editor').submit();
      });
    </script>



  @endsection

@endsection

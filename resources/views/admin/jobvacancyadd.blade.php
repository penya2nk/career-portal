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
@endsection

@section('content')
<form data-toggle="validator" class="" @if(!isset($status)) action="{{route('admin.jobvacancy.create')}}" @else action="{{route('admin.jobvacancy.postedit', ['id'=>$job->id])}}" @endif  method="post">
  {{ csrf_field() }}
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
        <button type="submit" class="btn btn-warning">Save</button>
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





  @endsection

@endsection

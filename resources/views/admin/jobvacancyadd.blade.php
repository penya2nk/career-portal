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
<form class="" action="{{route('admin.jobvacancy.create')}}" method="post">
  {{ csrf_field() }}
  <div class="row">
    <div class="col-lg-6">
      <div class="card">
        <div class="card-header"><strong>Job</strong> Basic Information</div>
        <div class="card-body card-block">
          <div class="form-group">
            <label for="company" class=" form-control-label">Job Title</label>
            <input type="text" id="job-title" name="job_title" placeholder="Enter the Job Title" class="form-control">
          </div>
          <div class="form-group">
            <label for="">Time Criteria</label>
            <select class="form-control" id="time-type" name="time_type">
              <option value="fulltime">Full Time</option>
              <option value="parttime">Part Time</option>
            </select>
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
            <input type="text" class="form-control tag-input" data-role="tagsinput" name="skill_tag" value="">
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
            <textarea  name="job_description" class="form-control wy-note" rows="8" cols="80"></textarea>
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
            <textarea  name="skill_requirement"  class="form-control wy-note" rows="8" cols="80"></textarea>
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

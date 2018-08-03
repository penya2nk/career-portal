@extends('layouts.adminlayout')



@section('title')

{{$user->name}}
  {{-- <a  href="{{route('profile.print',['id'=>$user->id])}}" class="btn btn-sm btn-default" style="margin-left:10px">
    <span class="menu-icon fa fa-print"></span>
  </a> --}}

@endsection

@section('right-header')
  <a href="{{route('admin.jobvacancy.add')}}" style="margin: 10px;" class="btn btn-success">add Admin</a>
@endsection

@section('content')
  <style media="screen">
    .justify-content-center {
      -webkit-box-pack: center !important;
      -ms-flex-pack: center !important;
      justify-content: center !important;
    }

    button.dt-button.buttons-excel.buttons-html5 {
      background: #ffc107;
      border-radius:  24px;
      border: none;
    }

    .seleksi-wrapper{
      background: #dee0db;
      padding: 34px;
      position: fixed;
      padding-top:10px;
      padding-bottom:10px;
      bottom: 0px;
      width: 75%;
    }

    span.help-block.with-errors {
      color: white;
      background: #ff6262;
      text-align: center;
      display:  block;
    }

  </style>

  <link href="{{asset('assets/css/gsdk-bootstrap-wizard.css')}}" rel="stylesheet" />


  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-2">
        @if ($user->profpic !== NULL)
          <div class="image-profpic-2">
            <img class="profpic-2" style="height: 162px;" src="{{$user->profpic}}" alt="User Avatar">
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
            <div class="" style="margin-top: 21px;color:black; display:block; height:69px">
              <h1 style="text-transform:uppercase">{{$user->name}}</h1>
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
                        {{$user->born_date !== NULL ? $user->born_date->format('d-M-Y') : ''}} ({{$user->born_date !== NULL ? $user->born_date->age : ''}} Tahun)
                      </span>
                    </td>
                    <td>
                        <span class="fa fa-graduation-cap " style="margin-right:20px"></span>
                        <span>
                          {{$user->institution}} ({{$user->year}})
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>
                      <span class="fa fa-mobile" style="margin-right:20px"></span>
                      <span>
                        {{$user->phone}}
                      </span>
                    </td>
                    <td>
                        <span class="fa fa-paper-plane " style="margin-right:20px"></span>
                        <span>
                          {{$user->major}} (GPA: {{$user->gpa}}/{{$user->gpa_max}})
                        </span>
                    </td>
                </tr>
                <tr>
                  <td>
                    <span class="fa fa-id-card" style="margin-right:20px"></span>
                    <span>
                    CV:  <a href="{{$user->resume !== NULL ? $user->resume : '#'}}" target="_blank" class="btn btn-sm btn-success">Download</a>
                    </span>
                  </td>
                </tr>

              </tbody>
            </table>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <p>{{$user->about}}</p>
          </div>
        </div>
        <div class="row" style="margin-bottom:200px">
          <div class="col-md-6">
            @if (isset($_GET['seleksi']) && isset($_GET['job']))
              @php
              $app = App\models\applier::where([['user_id', $_GET['seleksi']],['job_id', $_GET['job']]])->first();
              $skills = unserialize($app->skill);
              @endphp
              <table class="table">
                <tbody>
                  @foreach ($skills as $key => $skill)
                    <tr>
                      <td>{{$key}}</td>
                      <td style="color:orange">
                        @for ($i = 0; $i<=$skill; $i++)
                          <i class="fa fa-star" aria-hidden="true"></i>
                        @endfor
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Komponen Penilaian --}}

  @if (isset($_GET['seleksi']) && isset($_GET['job']))
    <div class="seleksi-wrapper" >
      <div class="row">
        <div class="col-md-12 text-center">
          <button class="btn btn-fill btn-block btn-default" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            Penilaian
          </button>
        </div>
      </div>
      <div class="collapse" id="collapseExample" style="overflow: scroll !important; max-height: 600px !important;">
        @php
          $job = App\models\job::find($_GET['job']);
        @endphp

        @foreach (App\models\stage::whereIn('id', unserialize($job->stages_list))->get() as $stage)
          <div class="row">
            <div class="col-md-12">
              <h5>{{$stage->stage_name}}</h5>
              <hr>
            </div>
          </div>
          @foreach ($stage->parameters()->get()->chunk(6) as $parameters)
            <div class="">
              <div class="row">
                @foreach ($parameters as $parameter)
                  <div class="col-md-2">
                    <div class="form-group">
                      <label style="font-size: 10pt; font-weight: 100;" for="">{{$parameter->parameter_name}} (0-{{$parameter->skala}})</label>

                      <div class="">

                        <form class="" action="{{route('score.each.save')}}" method="post" style="display: inherit;">
                          {{ csrf_field() }}

                          <input class="form-control input-sm parameter-seleksi" min="0"
                          max="{{$parameter->skala}}"
                          step="0.01"
                          name="{{$parameter->id}}"
                          @if ($user->parameters()->where('parameter_id', $parameter->id)->first() !== NULL)
                            @if ($user->parameters()->where('parameter_id', $parameter->id)->first()->pivot->lock == "1")
                              disabled
                              {{-- type="password" --}}
                              type="number"
                            @else
                              type="number"
                            @endif
                          @else
                            type="number"
                          @endif
                          value="{{$user->parameters()->where([['parameter_id', $parameter->id],['job_id',$_GET['job']]])->first() !== NULL ? $user->parameters()->where('parameter_id', $parameter->id)->first()->pivot->score : '0'}}"
                          id="" placeholder="">

                          <input
                          {{-- type="text" --}}
                          class="form-control"
                          placeholder="komentar"
                          style="font-size:8pt"
                          name="comment"
                          value="{{$user->parameters()->where('parameter_id', $parameter->id)->first() !== NULL ? $user->parameters()->where('parameter_id', $parameter->id)->first()->pivot->comment : ''}}"
                          @if ($user->parameters()->where('parameter_id', $parameter->id)->first() !== NULL)
                            @if ($user->parameters()->where('parameter_id', $parameter->id)->first()->pivot->lock == "1")
                              disabled
                              {{-- type="password" --}}
                              type="text"
                            @else
                              type="text"
                            @endif
                          @else
                            type="text"
                          @endif
                          >

                          <input type="hidden" name="parameter_id" value="{{$parameter->id}}">
                          <input type="hidden" name="user_id" value="{{$user->id}}">
                          <input type="hidden" name="job_id" value="{{$_GET['job']}}">

                          @if ($user->parameters()->where('parameter_id', $parameter->id)->first() == NULL || $user->parameters()->where('parameter_id', $parameter->id)->first()->pivot->lock == "0")
                            <button type="submit" class="btn btn-sm btn-block btn-fill btn-success">
                              Save
                            </button>
                          @endif



                        </form>

                        @if ($user->parameters()->where('parameter_id', $parameter->id)->first() !== NULL)
                          @if ($user->parameters()->where('parameter_id', $parameter->id)->first()->pivot->lock == "0")
                            <span class="grup-lock">
                              <form class="" action="{{route('score.lock')}}" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="parameter_id" value="{{$parameter->id}}">
                                <input type="hidden" name="user_id" value="{{$user->id}}">

                                <button type="submit" class="btn btn-block btn-sm btn-fill btn-default lock-this">
                                  Lock
                                </button>
                              </form>
                            </span>
                          @endif
                        @endif

                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
          @endforeach

        @endforeach
      </div>

        {{-- <div class="row">
          <div class="col-md-12">
            <button type="button" id="save-score" class="btn btn-block btn-default">
              Save
            </button>
          </div>
        </div> --}}
    </div>
    <script type="text/javascript">
      $(document).ready(function() {
        $('#save-score').on('click', function() {
          var nilai = $('.parameter-seleksi').serialize();
          console.log(nilai)

          $.ajax({
            url: '{{route('score.save')}}',
            type: 'POST',
            dataType: 'json',
            data: {
              "_token": "{{ csrf_token() }}",
              "score": nilai,
              "user_id":{{$user->id}}
            }
          })
          .done(function() {
            console.log("success");
          })
          .fail(function() {
            console.log("error");
          })
          .always(function() {
            console.log("complete");
          });




        });
      });
    </script>
  @endif

  @section('script')

    @if (session()->has('saved'))
      <script type="text/javascript">
        swal({
            title:'{{session()->get('saved')}}',
            type:'success'
          },
        );
      </script>
    @endif

  @endsection

@endsection

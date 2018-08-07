@extends('layouts.adminlayout')

@section('title')
Applier {{$job->job_title}}
@endsection

@section('right-header')
  <a href="{{route('admin.jobvacancy.add')}}" style="margin: 10px;" class="btn btn-success">add Admin</a>
@endsection

<link rel="stylesheet" href="{{asset('datatables/css/jquery.dataTables.css')}}">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css">



@section('content')
  <div class="container">
    @if (unserialize($job->stages_list) == NULL)
      <div class="row">
        <div class="alert alert-warning">Mohon untuk Memilih tahapan seleksi dari data lowongan ini</div>
      </div>
    @endif
    <div class="row">
      <div class="col-md-12">

        <table class="table table-striped datatable">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>E-mail</th>
              <th>IPK</th>
              <th>Kampus</th>
              <th>Tahapan</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @php
              $i = 1;
            @endphp

            @if ($job->appliers()->count() !== 0)
              @foreach ($job->appliers()->get() as $applier)
                <tr>
                  <td>{{$i++}}</td>
                  <td>{{$applier->user->name}}</td>
                  <td>{{$applier->user->email}}</td>
                  <td>{{$applier->user->gpa}} / {{$applier->user->gpa_max}}</td>
                  <td>{{$applier->user->institution}}</td>
                  <td>{{$applier->stage !== NULL ? $applier->stage->stage_name : 'Submit'}}</td>
                  <td>
                    <a href="{{route('admin.candidate.preview',['id'=>$applier->user->id,'seleksi'=>$applier->user->id,'job'=>$job->id])}}" class="btn btn-sm btn-primary">Preview</a>
                  </td>
                </tr>
              @endforeach
            @endif
          </tbody>
        </table>
      </div>
    </div>
    <div class="row" style="margin-top:80px">
      <div class="col-md-12">
        <h4>Nilai Seleksi</h4>
        <hr>
        <table class="table table-striped datatable">
          <thead>
            <tr>
              <th rowspan="2">No</th>
              <th rowspan="2">Nama</th>
              <th rowspan="2">IPK</th>
              <th rowspan="2">Kampus</th>
              <th rowspan="2">Tahapan</th>


              @if (unserialize($job->stages_list) !== NULL && App\models\stage::whereIn('id', unserialize($job->stages_list))->count() !== 0)
                  @foreach (App\models\stage::whereIn('id', unserialize($job->stages_list))->get() as $stage)
                    <th colspan="{{$stage->parameters()->count()}}" style="background:orange; color:black">
                      {{$stage->stage_name}}
                      <br>
                      ({{$stage->percentage}} %)
                    </th>
                  @endforeach
              @else
                <th>NULL</th>
              @endif

              <th rowspan="2">Masuk Tahap</th>
            </tr>

            <tr>
                @if (unserialize($job->stages_list) !== NULL && App\models\parameter::all()->count() !== 0)
                  @php
                    $stages = App\models\stage::whereIn('id', unserialize($job->stages_list))->get();
                    foreach ($stages as $key => $stage) {
                      foreach ($stage->parameters()->get() as $key => $parameter) {
                        $par[]= $parameter->id;
                      }
                    }
                  @endphp


                  @foreach (App\models\parameter::whereIn('id', $par)->get() as $parameter)
                    <th style="font-size:9pt;background:grey">
                      {{$parameter->parameter_name}}
                      <br>
                      ({{$parameter->percentage}} %)

                    </th>
                  @endforeach
                @endif
              </tr>

          </thead>
          <tbody>
            @php
              $i = 1;
            @endphp
            @foreach ($job->appliers()->get() as $applier)
              <tr>
                <td>{{$i++}}</td>
                <td>{{$applier->user->name}}</td>
                <td>{{$applier->user->gpa}} / {{$applier->user->gpa_max}}</td>
                <td>{{$applier->user->institution}}</td>
                <td>{{$applier->stage !== NULL ? $applier->stage->stage_name : 'Submit'}}</td>


                @if (unserialize($job->stages_list) !== NULL && App\models\parameter::all()->count() !== 0)
                    @foreach (App\models\parameter::whereIn('id', $par)->get() as $parameter)
                      @php
                      // Parameter Nilai
                      // dd($applier->user);
                        $check = $applier->user->parameters()->where([['parameter_id',$parameter->id],['job_id', $job->id]])->first();
                        if ($check == NULL) {
                          $score = '-';
                          $stamp = '';
                        }else{
                          $score = $check->pivot->score;
                          $stamp = $check->pivot->user_submit.' <br> '.$check->pivot->updated_at;
                        }
                      @endphp

                      <td>{{$score}}<br>
                        <span style="
                        background: #bfbfbf;
                        display: inline-block;
                        font-size: 5pt;
                        color: white;
                        ">{!!$stamp!!}</span>
                      </td>
                    @endforeach
                @endif
                <td>
                  @if (unserialize($job->stages_list) !== NULL && App\models\stage::whereIn('id', unserialize($job->stages_list))->count() !== 0)
                    <input type="hidden" class="user_id" name="" value="{{$applier->user->id}}">
                    <select class="seleksi-tahap" name="seleksi_tahap" data-search="Done">
                      @foreach (App\models\stage::whereIn('id', unserialize($job->stages_list))->get() as $stage)
                      <option
                        {{$status_candidate = $applier->where([['user_id', $applier->user->id],['job_id',$job->id]])->first()}}
                        @if($status_candidate !== NULL)
                          @if($status_candidate->stage_id == $stage->id)
                            selected
                          @endif
                        @endif
                        value="{{$stage->id}}" class="form-control">{{$stage->stage_name}}
                      </option>
                      @endforeach
                    </select>
                  @endif
                </td>


              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>








  @section('script')

    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables-colvis/1.1.2/js/dataTables.colVis.js"></script>


    @if (session()->has('status'))
      <script type="text/javascript">
      swal({
                  title:'{{session()->get('status')}}',
                  type:'success'
                },
              );
      </script>
    @endif

    <script type="text/javascript">
      $('.delete-job').on('click', function() {
        swal({
          title: "Are you sure?",
          text: "But you will still be able to retrieve this action.",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#f44336",
          confirmButtonText: "Yes, Delete it!",
          cancelButtonText: "No, cancel please!",

        }).then((result) => {
      if (result.value) {
            $(this).parent().submit();
          }
        });
      });
  </script>

  <script>
    $(document).ready(function() {
        $('.datatable').DataTable({
          "sDom": 'B<"clear">lfrtip',
          buttons: [
          // 'copy',
          // 'csv',
          'excel',
          // 'pdf',
          // 'print'
        ],


        });
    });

  </script>

  <script type="text/javascript">
      @if(App\models\stage::all()->count() !== 0)
      // Ajax untuk perubahan status seleksi
      $('.seleksi-tahap').on('change', function() {
        var user_id = $(this).parent().find('.user_id').val();
        var stage_id = $(this).parent().find('.seleksi-tahap').val();
        var job_id = {{$job->id}};

        $.ajax({
          url: '{{route('stage.status.save')}}',
          type: 'POST',
          context:this,
          dataType: 'json',
          data: { "_token": "{{ csrf_token() }}",
                 "user_id": user_id,
                 "stage_id": stage_id,
                 "job_id": job_id
                      },
        })
        .done(function(data) {

          if (data.status == "success") {
            swal({
                title:'Berhasil Mengubah Status '+data.name+' ke tahap '+data.stage+'',
                type:'success'
              },
            );
          }
        })
        .fail(function() {
          console.log("error");
        })
        .always(function() {
          console.log("complete");
        });


      });
      @endif
  </script>




  @endsection

@endsection

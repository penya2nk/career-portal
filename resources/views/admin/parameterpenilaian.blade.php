@extends('layouts.adminlayout')

@section('title')
Parameters Selection
@endsection

@section('content')

  @if ($stages->count()== 0)
    <div class="row">
      <div class="col-md-12 text-center">
        <div class="alert alert-primary" role="alert">
          <h5>Tahapan Seleksi belum dibuat. Silahkan mengisi data tahapan seleksi pada menu
            <a href="{{route('stage.index')}}">"tahapan seleksi"</a>
            </h5>
        </div>
      </div>
    </div>

    @else
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">Add Parameters</div>
            <div class="card-body card-block">

              <form class="" action="{{route('parameter.post')}}" method="post">
                {{ csrf_field() }}
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="">Induk Tahapan Seleksi</label>
                      <select class="form-control" name="stage_id">
                        @foreach ($stages as $stage)
                          <option value="{{$stage->id}}">{{$stage->stage_name}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <div class="input-group">
                        <input type="text" id="email-admin" name="parameter" placeholder="Nama Parameter Penilaian" class="form-control">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <div class="input-group">
                        <input type="number" id="skala-admin" name="skala" placeholder="Skala Skor Maksimum" class="form-control">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">

                      <div class="input-group">
                        <input type="number" id="percentage-admin" name="percentage" placeholder="Persentase Bobot" class="form-control">
                        <span class="input-group-addon">%</span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-actions form-group">
                  <button type="submit" id="add-admin" class="btn btn-success btn-sm">Add</button>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>

  @endif

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          Parameter
        </div>
        <div class="card-body card-block">
          <table class="table table-hover">
            <thead>
              <th>No</th>
              <th>Parameter</th>
              <th>Tahapan Seleksi</th>
              <th>Skala Maksimum</th>
              <th>Presentase Bobot</th>
              <th>Action</th>
            </thead>
            <tbody>
              @php
                $i = 1;

              @endphp
              @if ($parameters->count() !== 0)
                @foreach ($parameters as $parameter)
                  <tr>
                    <td>{{$i++}}</td>
                    <td>{{$parameter->parameter_name}}</td>
                    <td>{{$parameter->stage['stage_name']}}</td>
                    <td>{{$parameter->skala}}</td>
                    <td>{{$parameter->percentage}} %</td>
                    <td>
                      <button type="button" data-toggle="modal" data-target="#edit-{{$parameter->id}}" class="btn btn-sm btn-warning">
                        Edit
                      </button>
                      <form class="" style="display:inline" action="{{route('parameter.delete')}}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="parameter_id_delete" value="{{$parameter->id}}">
                        <button type="button" id="" class="btn btn-sm btn-danger delete-button">
                          Delete
                        </button>
                      </form>
                      <form class="" style="display:inline" action="{{route('unlock.all')}}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="parameter_id" value="{{$parameter->id}}">
                        <button type="submit" id="" class="btn btn-sm btn-primary">
                          Unlock All
                        </button>
                      </form>
                      <form class="" style="display:inline" action="{{route('lock.all')}}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="parameter_id" value="{{$parameter->id}}">
                        <button type="submit" id="" class="btn btn-sm btn-success">
                          Lock All
                        </button>
                      </form>
                    </td>
                  </tr>
                @endforeach
              @endif

              <script type="text/javascript">
                $('.delete-button').on('click', function() {
                  event.preventDefault();
                  /* Act on the event */

                  swal({
                    title: "Apakah Anda yakin?",
                    text: "Penghapusan parameter berakibat terhapusnya data penilaian ?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#f44336",
                    confirmButtonText: "Ya, Saya Yakin !",
                    cancelButtonText: "Cancel",

                  }).then((result) => {
                if (result.value) {
                  $(this).parent().submit();



                }
              });


                });
              </script>

            </tbody>
            <tfoot>
              @if ($parameters->count() !== 0)
                <th colspan="4" style="text-align:right">Total</th>
                <th style="{{$parameter->sum('percentage') > 100 ? 'color:red' : ''}}">{{$parameter->sum('percentage')}} % {{$parameter->sum('percentage') > 100 ? '' : ''}}</th>
              @endif
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="row">



  </div>



  @section('script')

    @foreach ($parameters as $parameter)
      <div class="modal fade" id="edit-{{$parameter->id}}" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">

            <form class="" action="{{route('parameter.edit')}}" method="post">
              {{ csrf_field() }}
            <div class="modal-header">
              <h4 class="modal-title" id="">Edit Parameter</h4>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="">Tahapan Seleksi</label>
                      <select class="form-control" name="stage_id">
                        @foreach ($stages as $stage)
                          <option value="{{$stage->id}}" {{$parameter->stage_id == $stage->id ? 'selected' :false}}>{{$stage->stage_name}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <input type="hidden" class="form-control" name="parameter_edit_id"  id="" value="{{$parameter->id}}" placeholder="">
                      <input type="text" class="form-control" name="parameter_name" id="" value="{{$parameter->parameter_name}}" placeholder="">
                    </div>
                    <div class="form-group">
                      <label for="">Skala</label>
                      <input type="number" class="form-control" name="skala" id="" value="{{$parameter->skala}}" placeholder="">
                    </div>
                    <div class="form-group">
                      <label for="">Persentase Bobot Penilaian</label>
                      <div class="input-group">
                        <input type="number" class="form-control" name="percentage" id="" value="{{$parameter->percentage}}" placeholder="">
                        <span class="input-group-addon">%</span>
                      </div>
                    </div>
                  </div>
                </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save</button>
            </div>

          </form>
          </div>
        </div>
      </div>
    @endforeach
    {{-- <script src="{{asset('admin-ui/assets/js/vendor/jquery-2.1.4.min.js')}}"></script> --}}

    @if (session()->has('alert'))
      <script type="text/javascript">
        swal({
            title:'Berhasil {{session()->get('alert')}} Parameter!',
            type:'success'
          },
        );
      </script>
    @endif

    @if (session()->has('alert_delete'))
      <script type="text/javascript">
        swal({
            title:'Berhasil Menghapus Parameter!',
            type:'success'
          },
        );
      </script>
    @endif

  @endsection

@endsection

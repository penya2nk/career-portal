@extends('layouts.adminlayout')

@section('title')
stages Selection
@endsection

@section('content')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.2/css/bootstrap-colorpicker.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.2/js/bootstrap-colorpicker.js"></script>
  <script src="{{asset('js/validator.js')}}"></script>

  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header">Add Stages</div>
        <div class="card-body card-block">

          <form class="" data-toggle="validator" role="form" action="{{route('stage.post')}}" method="post">
            {{ csrf_field() }}
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <span class="label">Nama Tahapan Seleksi</span>
                  <div class="input-group">
                    <input required type="text" id="email-admin" name="stage" placeholder="Ex: Administrasi" class="form-control">
                  </div>
                  <span class="help-block with-errors"></span>
                </div>
              </div>
              {{-- <div class="col-md-3">
                <div class="form-group">
                  <span class="label">Tanggal Mulai</span>
                  <div class="input-group">
                    <input type="date" id="skala-admin" name="start_date" placeholder="Tanggal Mulai" class="form-control">
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <span class="label">Tanggal Selesai</span>
                  <div class="input-group">
                    <input type="date" id="skala-admin" name="end_date" placeholder="Tanggal Selesai" class="form-control">
                  </div>
                </div>
              </div> --}}
              {{-- <div class="col-md-2">
                <div class="form-group">
                  <span class="label">Warna</span>
                  <div class="input-group">
                    <input type="text" id="skala-admin" name="color" placeholder="Warna" class="form-control mycp">
                  </div>
                </div>
              </div> --}}
              <div class="col-md-6">
                <div class="form-group">
                  <span class="label">Presentase</span>
                  <div class="input-group">
                    <input type="number" id="" required min="0" max="100" name="percentage" placeholder="Persentase" class="form-control">
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

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          stage
        </div>
        <div class="card-body card-block">
          <table class="table table-hover">
            <thead>
              <th>No</th>
              <th>stage</th>
              {{-- <th>Tanggal Mulai</th>
              <th>Tanggal Selesai</th> --}}
              <th>Persentase</th>
              <th>Action</th>
            </thead>
            <tbody>
              @php
                $i = 1;

              @endphp
              @if ($stages->count() !== 0)
                @foreach ($stages as $stage)
                  <tr>
                    <td>{{$i++}}</td>
                    <td>{{$stage->stage_name}}</td>
                    {{-- <td>{{$stage->start_date !== NULL ? $stage->start_date->format('d-m-Y'): ''}}</td>
                    <td>{{$stage->end_date !== NULL ? $stage->end_date->format('d-m-Y'): ''}} </td> --}}
                    {{-- <td style="background:{{$stage->color}};">{{$stage->color}} </td> --}}
                    <td>{{$stage->percentage}} %</td>
                    <td>
                      <button type="button" data-toggle="modal" data-target="#edit-{{$stage->id}}" class="btn btn-warning">
                        Edit
                      </button>
                      <form class="" style="display:inline" action="{{route('stage.delete')}}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="stage_id_delete" value="{{$stage->id}}">
                        <button type="button" id="" class="btn btn-danger delete-button">
                          Delete
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
                    text: "Penghapusan stage berakibat terhapusnya data penilaian ?",
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
              @if ($stages->count() !== 0)
                <th colspan="4" style="text-align:right">Total</th>
                <th style="{{$stages->sum('percentage') > 100 ? 'color:red' : ''}}">{{$stages->sum('percentage')}} % {{$stages->sum('percentage') > 100 ? '' : ''}}</th>
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

    @foreach ($stages as $stage)
      <div class="modal fade" id="edit-{{$stage->id}}" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">

            <form class="" action="{{route('stage.edit')}}" method="post">
              {{ csrf_field() }}
            <div class="modal-header">
              <h4 class="modal-title" id="">Edit stage</h4>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <input type="hidden" class="form-control" name="stage_edit_id"  id="" value="{{$stage->id}}" placeholder="">
                      <input type="text" class="form-control" name="stage_name" id="" value="{{$stage->stage_name}}" placeholder="">
                    </div>
                    <div class="form-group">
                      <label for="">Tanggal Mulai</label>
                      <input type="date" class="form-control" name="start_date" id="" value="{{$stage->start_date !== NULL ? $stage->start_date->format('Y-m-d'): ''}}" placeholder="">
                    </div>
                    <div class="form-group">
                      <label for="">Tanggal Selesai</label>
                      <input type="date" class="form-control" name="end_date" id="" value="{{$stage->end_date !== NULL ? $stage->end_date->format('Y-m-d'): ''}}" placeholder="">
                    </div>
                    <div class="form-group">
                      <label for="">Persentase</label>
                      <div class="input-group">
                        <input type="number" id="" min="0" max="100" value="{{$stage->percentage}}" name="percentage" placeholder="Persentase" class="form-control">
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

    <script type="text/javascript">
      $(document).ready(function() {
        $('.mycp').colorpicker();
      });
    </script>

    @if (session()->has('alert'))
      <script type="text/javascript">
        swal({
            title:'Berhasil {{session()->get('alert')}} tahapan seleksi!',
            type:'success'
          },
        );
      </script>
    @endif

    @if (session()->has('alert_delete'))
      <script type="text/javascript">
        swal({
            title:'Berhasil Menghapus tahapan seleksi!',
            type:'success'
          },
        );
      </script>
    @endif

  @endsection

@endsection

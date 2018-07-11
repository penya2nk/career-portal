@extends('layouts.adminlayout')

@section('title')
Members Registered
@endsection

@section('css-section')

  <link rel="stylesheet" href="{{asset('datatables/css/jquery.dataTables.css')}}">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css">
  {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables-colvis/1.1.2/css/dataTables.colVis.css"> --}}

@endsection

@section('content')

  <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body card-block">
            <table class="table">
              <tbody>
                <tr>
                  <td style="background:#bdbdbd">Belum Dinilai Sama Sekali</td>
                  <td style="background:#ffc300">Sudah Dinilai Belum Dilock</td>
                  <td style="background:#41b849">Sudah Dilock</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
  </div>
  {{-- <div class="row">
    <div class="col-md-3">
      <div class="card">
          <a class="toggle-vis btn btn-sm btn-warning" data-column="0">Nama</a>
          <a class="toggle-vis btn btn-sm btn-warning" data-column="1">Email</a>
          <a class="toggle-vis btn btn-sm btn-warning" data-column="2">Universitas</a>

      </div>
    </div>
    <div class="col-md-3">
      <div class="card">

          <a class="toggle-vis btn btn-sm btn-warning" data-column="3">Semester</a>
          <a class="toggle-vis btn btn-sm btn-warning" data-column="5">Kelengkapan Data</a>
          <a class="toggle-vis btn btn-sm btn-warning" data-column="6">Status</a>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card">

          <a class="toggle-vis btn btn-sm btn-warning" data-column="7">Gender</a>
          <a class="toggle-vis btn btn-sm btn-warning" data-column="8">Register Date</a>

      </div>
    </div>
  </div> --}}

  <div class="row">
    <div class="col-md-12">


      <div class="card">

        {{-- <div class="card-header">Member</div> --}}
        <div class="card-body card-block">
            <table class="datatable mdl-data-table dataTable compact hover table-striped" cellspacing="0"
            width="100%" role="grid" style="width: 100%;">
            <thead>
              <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Univ.</th>
                <th>Semester</th>
                <th>Phone</th>
                <th>Kelengkapan Data</th>
                <th>Status</th>
                <th>Gender</th>
                <th>Register</th>
                <th>Status Score</th>
                {{-- @if (App\models\parameter::all()->count() !== 0)
                  @foreach (App\models\parameter::all() as $parameter)
                    <th>{{$parameter->parameter_name}}</th>
                  @endforeach
                @endif --}}
                {{-- <th>Country</th>
                <th>Salary</th> --}}
              </tr>
            </thead>
            <tbody>
              @php
                $i = 1;
              @endphp
              @foreach ($users as $user)
                @php
                $institution = $user->institution['institution_name'];
                if ($institution !== NULL) {
                  $institution = explode('(',$institution);
                  $institution = "-".str_replace(')', '',$institution[1])."-";
                }else {
                  $institution = '';
                }

                if ($user->generation !== NULL) {
                  $year = $user->generation;
                  $semt_1 = Carbon\Carbon::createFromDate($user->generation,9,1,'Asia/Jakarta');
                  $now = Carbon\Carbon::now();
                  $diff = $semt_1->diffInMonths($now);

                  if ($diff < 6) {
                    $semester = 1;
                  }elseif ($diff < 12) {
                    $semester = 2;
                  }elseif ($diff < 18) {
                    $semester = 3;
                  }elseif ($diff < 24) {
                    $semester = 4;
                  }elseif ($diff < 30) {
                    $semester = 5;
                  }elseif ($diff < 36) {
                    $semester = 6;
                  }elseif ($diff < 42) {
                    $semester = 7;
                  }elseif ($diff < 48) {
                    $semester = 8;
                  }elseif ($diff < 54) {
                    $semester = 9;
                  }else {
                    $semester = ">9";
                  }

                }else {
                  $semester = "-";
                }

                $validation = app('App\Http\Controllers\admin\ValidationController')->count_null($user->email);

                if ($validation['fill_percent'] == 100) {
                   $bar_progress = 'progress-bar-success';
                 }elseif ($validation['fill_percent'] >80) {
                   $bar_progress = 'progress-bar-info';
                 }elseif ($validation['fill_percent'] > 40) {
                   $bar_progress = 'progress-bar-warning';
                 }else {
                   $bar_progress = 'progress-bar-danger';
                 }

                 $progress_bar = '<div class="progress"><div class="progress-bar progress-bar-striped '.$bar_progress.' active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:'.$validation['fill_percent'].'%">'.$validation['fill_percent'].' %</div></div>';

                 // dd($progress_bar);
                 if ($user->gender = "L") {
                   $gender = "Laki-Laki";
                 }elseif ($user->gender = "P") {
                   $gender = "Perempuan";
                 }else {
                   $gender= "";
                 }

                @endphp
                <tr>
                  <td>{{$i++}}</td>
                  <td>{{$user->name}}</td>
                  <td>{{$user->email}}</td>
                  <td>{{$institution}}</td>
                  <td>{{$semester}}</td>
                  <td>{{$user->phone}}</td>
                  <td>{!!$progress_bar!!}</td>
                  <td><a href="/admin/profile/view/{{$user->id}}?seleksi=true" target="_blank" class="btn btn-sm btn-info"> View </a></td>
                  <td>{{$gender}}</td>
                  <td>{{$user->created_at->format('d-M')}}</td>
                  <td>
                    @if (App\models\stage::all()->count() !== 0)
                      @foreach (App\models\stage::all() as $stage)
                        <span><b>{{$stage->stage_name}}</b></span>
                        <hr style="margin:0">
                        <ul>
                          @foreach ($stage->parameters()->get() as $parameter)
                            @php
                              $s = $user->parameters()->where('parameter_id', $parameter->id)->first();
                              if ($s == NULL) {
                                $color_status = "#bdbdbd";
                              }elseif ($s->pivot->lock == 0) {
                                $color_status = "#ffc300";
                              }elseif ($s->pivot->lock == 1) {
                                $color_status = "#41b849";
                              }
                            @endphp

                              <li

                              style="background:{{$color_status}}; cursor:pointer"
                              data-toggle="tooltip"
                              data-html="true"
                              title="Bagus Dwi UTama"
                              {{-- data-original-title="Bagus Dwi Utama" --}}
                              >

                                {{-- <span class="btn btn-fill btn-primary fa fa-user"></span> --}}
                                {{$parameter->parameter_name}}
                              </li>
                          @endforeach
                        </ul>
                      @endforeach
                    @endif

                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  @section('script')
    {{-- <script src="{{asset('admin-ui/assets/js/vendor/jquery-2.1.4.min.js')}}"></script> --}}
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



  <script>
    $(document).ready(function() {
        var tablenya = $('.datatable').DataTable({
          "sDom": 'C<"clear">lfrtip',

      // membuat beberapa data tidak muncul dulu
      'columnDefs': [
       { targets: 2, visible:false },
       { targets: 5, visible:false },
       { targets: 8, visible:false },
       { targets: 9, visible:false },
     ],
     "fnDrawCallback": function( oSettings ) {
       $('[data-toggle="tooltip"]').tooltip();
       // $('[data-toggle="tooltip"]').tooltip();
       // $('body').tooltip({selector: '[data-toggle="tooltip"]'});
       // alert( 'DataTables has redrawn the table' );
     },

        });


    $('a.toggle-vis').on( 'click', function (e) {
      e.preventDefault();
      $(this).toggleClass('btn-warning','btn-default');
      // Get the column API object
      var column = tablenya.column( $(this).attr('data-column') );
      console.log($(this).attr('data-column'))
      console.log(column)
      // Toggle the visibility
      column.visible( ! column.visible() );
    } );

    });

  </script>

    <script>
    $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip();
    });
    </script>



  @endsection

@endsection

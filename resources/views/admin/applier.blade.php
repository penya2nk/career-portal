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
  <div class="row">
    <div class="col-md-12">
      {{-- <small>
        Admin :
      </small>
      <span class="badge badge-secondary">Halo</span> --}}
      <table class="table table-striped datatable">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>E-mail</th>
            <th>IPK</th>
            <th>Kampus</th>
            <th>Tahapan</th>
            {{-- <th>CV</th> --}}
            <th>Action</th>
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
              <td>{{$applier->user->email}}</td>
              <td>{{$applier->user->gpa}} / {{$applier->user->gpa_max}}</td>
              <td>{{$applier->user->institution}}</td>
              <td>Seleksi Berkas</td>
              {{-- <td>
                <a href="" target="_blank" class="btn btn-sm btn-warning">Download</a>
              </td> --}}
              <td>
                <a href="{{route('admin.candidate.preview',['id'=>$applier->user->id,'seleksi'=>true,'job'=>$job->id])}}" class="btn btn-sm btn-primary">Preview</a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
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
        var tablenya = $('.datatable').DataTable({
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




  @endsection

@endsection

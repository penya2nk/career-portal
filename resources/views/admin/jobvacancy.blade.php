@extends('layouts.adminlayout')

@section('title')
Job Vacancy
@endsection

@section('right-header')
  <a href="{{route('admin.jobvacancy.add')}}" style="margin: 10px;" class="btn btn-success">add</a>
@endsection

@section('content')
  <div class="row">


  </div>

  <div class="row">

  </div>

    @foreach ($jobs->chunk(3) as $jobnya)
      <div class="row">
        @foreach ($jobnya as $job)
          <div class="col-md-4">
              <aside class="profile-nav alt">
                  <section class="card">
                    <a href="#">
                      <div class="card-header user-header alt bg-dark">
                        <div class="media">
                          {{-- <a href="#">
                          <img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;" alt="" src="images/admin.jpg">
                        </a> --}}
                        <div class="media-body">
                          <h2 class="text-light display-6">{{$job->job_title}}</h2>
                          <p>{{$job->time_type}}</p>
                          <div class="button-edit">
                            <form class="" action="{{route('admin.jobvacancy.edit',['id'=>$job->id])}}" method="post">
                              {{ csrf_field() }}
                              <button type="submit" class="btn btn-warning btn-sm">Edit</button>
                            </form>
                            <div class="delete-button-header">
                              <form class="" action="{{route('admin.jobvacancy.delete',['id'=>$job->id])}}" method="post">
                                {{ csrf_field() }}
                                <button type="button" class="btn delete-job btn-default btn-sm">X</button>
                              </form>
                            </div>
                            {{-- <a href="#" class="btn btn-danger btn-sm">Delete</a> --}}
                          </div>
                        </div>
                      </div>
                    </div>
                    </a>

                      <ul class="list-group list-group-flush">
                          <li class="list-group-item">
                              <a href="#"> <i class="fa fa-envelope-o"></i> Applier <span class="badge badge-primary pull-right">0</span></a>
                          </li>
                          <li class="list-group-item">
                              <a href="#"> <i class="fa fa-tasks"></i> To Director <span class="badge badge-danger pull-right">0</span></a>
                          </li>
                          <li class="list-group-item">
                              <a href="#"> <i class="fa fa-bell-o"></i> Candidate <span class="badge badge-success pull-right">0</span></a>
                          </li>
                          {{-- <li class="list-group-item">
                              <a href="#"> <i class="fa fa-comments-o"></i> Message <span class="badge badge-warning pull-right r-activity">03</span></a>
                          </li> --}}
                      </ul>
                  </section>
              </aside>
          </div>
        @endforeach
      </div>
    @endforeach




  @section('script')


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




  @endsection

@endsection

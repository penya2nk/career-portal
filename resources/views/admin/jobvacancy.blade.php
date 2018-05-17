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
  <div class="row">

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
                    <h2 class="text-light display-6">Content Writer</h2>
                    <p>Full Time</p>
                    <div class="button-edit">
                      <a href="#" class="btn btn-warning btn-sm">Edit</a>
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


  </div>

  @section('script')







  @endsection

@endsection

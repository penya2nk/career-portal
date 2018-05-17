@extends('layouts.adminlayout')

@section('title')
Perusahaan
@endsection

@section('content')
  <div class="row">

    @foreach ($companies as $company)
      <a href="#">
        <div class="col-md-4">
          <div class="feed-box text-center">
            <section class="card">
              <div class="card-body">
                <div class="corner-ribon blue-ribon">
                  <i class="fa fa-twitter"></i>
                </div>
                <a href="#">
                  <img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;" alt="" src="https://system.ipbsciencetechnopark.com/images/imagecompany/{{$company->linkphoto}}">
                </a>
                <h4>{{$company->name_company}}</h4>
                {{-- <p>Just got a pretty neat project via <a href="#">@ooomf</a> - Give it a try <a href="#">http://t.co/e02DwGEeOJ</a></p> --}}
              </div>
            </section>
          </div>
        </div>
      </a>
    @endforeach





  </div>
  <div class="row">



  </div>

  @section('script')







  @endsection

@endsection

@extends('layouts.application')

@section('content')

  <script src="{{asset('js/jquery.mask.js')}}"></script>

  <script type="text/javascript">
  $(document).ready(function() {
    $('.handphone').mask('+6200000000000000')
  });
  </script>


<div class="container-fluid">

  <form class="" action="{{ route('register') }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="row" style="padding:50px">
      <div class="col-md-6">
        <div class="form-group">
          <label for=""><b>Personal Data</b></label>
          <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="Full Name" required autofocus>
          @if ($errors->has('name'))
              <span class="invalid-feedback">
                  <strong>{{ $errors->first('name') }}</strong>
              </span>
          @endif
        </div>
        <div class="form-group">
          <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="E-mail" name="email" value="{{ old('email') }}" required>
          @if ($errors->has('email'))
              <span class="invalid-feedback">
                  <strong>{{ $errors->first('email') }}</strong>
              </span>
          @endif
        </div>
        <div class="form-group">
          <input id="password" type="password" placeholder="Password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
          @if ($errors->has('password'))
              <span class="invalid-feedback">
                  <strong>{{ $errors->first('password') }}</strong>
              </span>
          @endif
        </div>
        <div class="form-group">
          <input id="password-confirm" placeholder="Confirm Password" type="password" class="form-control" name="password_confirmation" required>
        </div>

        <div class="form-group">
          <input type="text" name="born_date" id="datetimepicker5" data-toggle="datetimepicker" data-target="#datetimepicker5" class="form-control" id="" placeholder="Born Date">
        </div>
        <script type="text/javascript">
            $(function () {
                $('#datetimepicker5').datetimepicker({
                  format: 'DD-MM-YYYY',
                  locale: 'id'
                });
            });
        </script>

        <div class="form-group">
          <input type="text" name="phone" class="form-control handphone" id="" placeholder="Phone Number">
        </div>

        <div class="form-group">
          <label for=""><b>Gender</b></label>
          <select class="form-control" name="gender" required>
            <option value="L">Male</option>
            <option value="P">Female</option>
          </select>
        </div>

        <div class="form-group">
          <label for=""><b>Marital Status</b></label>
          <select class="form-control" name="marital_status" required>
            <option value="Single">Single</option>
            <option value="Married">Married</option>
          </select>
        </div>

        <div class="form-group">
          <textarea name="address" placeholder="Address" class="form-control"  rows="8" cols="80"></textarea>
        </div>

      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for=""><b>Profile Picture</b></label>
          <input type="file" class="form-control" accept=".jpg" name="profpic" value="" required>
        </div>
        <div class="form-group">
          <label for=""><b>Resume / CV</b></label>
          <input type="file" class="form-control" accept=".pdf" name="resume" value="" required>
        </div>
        <div class="form-group">
          <label for=""><b>Last Education</b></label>
          <select class="form-control" name="last_education" required>
            <option value="SMA">SMA</option>
            <option value="D1">D1</option>
            <option value="D2">D2</option>
            <option value="D3">D3</option>
            <option value="S1">S1</option>
            <option value="S2">S2</option>
          </select>
        </div>
        <div class="form-group">
          <input type="text" class="form-control" id="" name="institution" placeholder="School/University">
        </div>
        <div class="form-group">
          <input type="text" class="form-control" id="" placeholder="Year">
        </div>
        <div class="form-group">
          <input type="text" class="form-control" id="" name="major" placeholder="Major">
        </div>
        <div class="form-group">
          <input type="text" class="form-control" id="" name="graduation_year" placeholder="Graduation Year">
        </div>

        <div class="form-inline">
          <div class="form-group">
            <label for="">GPA </label>
            <input type="number" min="0" step="0.01" name="gpa" class="form-control" id="" placeholder="">
          </div>
          <div class="form-group">
            <label for="">From </label>
            <select class="form-control" name="gpa-max">
              <option value="4">4</option>
              <option value="5">5</option>

            </select>
          </div>
        </div>

        <div class="text-right" style="margin-top:50px">
          <button type="submit" class="btn btn-lg btn-warning">Submit</button>
        </div>

      </div>
    </div>
  </form>
</div>


{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection

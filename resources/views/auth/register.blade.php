@extends('layouts.app')

@section('content') 

          <div class="card card-success card-outline">
            <div class="card-header with-border">
              <h3 class="card-title">{{ __('memberregister.register') }}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="POST" action="{{ route('register') }}">
			@csrf

              <div class="card-body">
              	<div class="form-group">
               		<label for="username">{{ __('memberregister.username') }}<span style="color:red">*</span></label>
                   	<input id="username" size=50 type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" placeholder="username" required autofocus>
                    	@if ($errors->has('username'))
                			<span class="error invalid-feedback">
                  			<strong>{{ $errors->first('username') }}</strong>
         					</span>
     					@endif
                </div>         	
                <div class="form-group">
               		<label for="name">{{ __('memberregister.name') }}<span style="color:red">*</span></label>
                   	<input id="name" size=50 type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="name" required>
                    	@if ($errors->has('name'))
                			<span class="error invalid-feedback">
                  			<strong>{{ $errors->first('name') }}</strong>
         					</span>
     					@endif
                </div>
              	<div class="form-group">
               		<label for="email">{{ __('memberregister.email') }}<span style="color:red">*</span></label>
                   	<input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="email" required>
                    	@if ($errors->has('email'))
                			<span class="error invalid-feedback">
                  			<strong>{{ $errors->first('email') }}</strong>
         					</span>
     					@endif
                </div>
              	<div class="form-group">
               		<label for="password">{{ __('memberregister.password') }}<span style="color:red">*</span></label>
                   	<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>
                    	@if ($errors->has('password'))
                			<span class="error invalid-feedback">
                  			<strong>{{ $errors->first('password') }}</strong>
         					</span>
     					@endif
                </div>
              	<div class="form-group">
               		<label for="password-confirm">{{ __('memberregister.confirm_password') }}<span style="color:red">*</span></label>
                   	<input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
                </div>  
              <div class="form-group" >
			  	<label for="required"><span style="color:red">* {{ __('label.required') }}</span></label>
			  </div>                                              
              <div class="form-group" >
			  @if(env('GOOGLE_RECAPTCHA_KEY'))
					<div class="g-recaptcha"
						data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}">
					</div>
				@endif
			  </div>                                              
              </div>  
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-outline-success">{{ __('Register') }}</button>
              </div>
            </form> 
          </div>    
     

@endsection

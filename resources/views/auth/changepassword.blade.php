@extends('layouts.app')

@section('content') 
    @if ($message = Session::get('success')) 
	<div class="alert alert-success alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4><i class="icon fa fa-check"></i>{{ __('label.alert') }}</h4>
				{{ $message }}
	</div>        
        
    @endif    

          <div class="card card-primary card-outline">
            <div class="card-header with-border">
              <h3 class="card-title">{{ __('auth.change_pass') }}</h3>
            </div>
             

            <!-- /.card-header -->
            <!-- form start -->
            <form method="POST" action="{{ route('changePassword') }}">
			@csrf
              <div class="card-body"> 
              	<div class="form-group {{ $errors->has('current-password') ? ' is-invalid' : '' }}">
               		<label for="current-password">{{ __('auth.current_pass') }}<span style="color:red">*</span></label>
 					<input id="current-password" type="password" class="form-control" name="current-password" required autofocus>
                    	@if ($errors->has('current-password'))new_pass
                			<span class="error invalid-feedback">
                  			<strong>{{ $errors->first('current-password') }}</strong>
         					</span>
     					@endif
                </div>             
              	<div class="form-group {{ $errors->has('new-password') ? ' is-invalid' : '' }}">
               		<label for="new-password">{{ __('auth.new_pass') }}<span style="color:red">*</span></label>
 					<input id="new-password" type="password" class="form-control" name="new-password" required>
                    	@if ($errors->has('new-password'))
                			<span class="error invalid-feedback">
                  			<strong>{{ $errors->first('new-password') }}</strong>
         					</span>
     					@endif
                </div>             
              	<div class="form-group {{ $errors->has('new-password-confirm') ? ' is-invalid' : '' }}">
               		<label for="new-password-confirm">{{ __('auth.confirm_new_pass') }}<span style="color:red">*</span></label>
 					<input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation" required>
                    	@if ($errors->has('new-password-confirm'))
                			<span class="error invalid-feedback">
                  			<strong>{{ $errors->first('new-password-confirm') }}</strong>
         					</span>
     					@endif
                </div>   
                <div class="form-group" >
			  	<label for="required"><span style="color:red">* {{ __('label.required') }}</span></label>
			  </div>          
              </div>  
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{ __('auth.change_pass') }}</button>
              </div>
            </form> 
          </div>     
@endsection

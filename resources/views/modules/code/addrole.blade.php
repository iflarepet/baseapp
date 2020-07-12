@extends('layouts.app')

@section('content') 
<div class="container">
    <div class="row justify-content-center"> 

          <div class="card card-primary card-outline">
            <div class="card-header with-border">
              <h3 class="card-title">{{ __('role.Add Role') }}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="POST" action="{{ route('role.store') }}">
			@csrf
              <div class="card-body"> 
              	<div class="form-group {{ $errors->has('name') ? ' is-invalid' : '' }}">
               		<label for="name">{{ __('role.Name') }}<span style="color:red">*</span></label>
                   	<input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Name" required>
                    	@if ($errors->has('name'))
                			<span class="error invalid-feedback">
                  			<strong>{{ $errors->first('role.name') }}</strong>
         					</span>
     					@endif
                </div>
              	<div class="form-group {{ $errors->has('description') ? ' is-invalid' : '' }}">
               		<label for="description">{{ __('role.Description') }}</label>
                   	<input id="description" type="text" class="form-control" name="name" value="{{ old('description') }}" placeholder="Description">
                    	@if ($errors->has('description'))
                			<span class="error invalid-feedback">
                  			<strong>{{ $errors->first('description') }}</strong>
         					</span>
     					@endif
                </div>  
              	<div class="form-group {{ $errors->has('is_active') ? ' is-invalid' : '' }}">
               		<label for="is_active">{{ __('role.Is Active') }}<span style="color:red">*</span></label>
                  <select class="form-control" name="is_active" required>
                    <option value='Y'>YES</option>
                    <option value='N'>NO</option>
                  </select>     
                    	@if ($errors->has('is_active'))
                			<span class="error invalid-feedback">
                  			<strong>{{ $errors->first('is_active') }}</strong>
         					</span>
     					@endif                  					
                </div>                               
                                
              <div class="form-group" >
			  	<label for="required"><span style="color:red">* {{ __('label.Required') }}</span></label>
			  </div>
              </div>  
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{ __('button.Save') }}</button>
                
                <button class="btn btn-primary" onclick="window.history.back();">{{ __('button.Back') }}</button>         
              </div>
            </form> 
          </div>    
    
	</div>    
</div>          



@endsection

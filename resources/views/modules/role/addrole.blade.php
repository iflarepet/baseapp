@extends('layouts.app')

@section('content') 
          <div class="card card-primary card-outline">
            <div class="card-header with-border">
              <h3 class="card-title">{{ __('role.add_role') }}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="POST" action="{{ route('role.store') }}">
			@csrf
              <div class="card-body"> 
              	<div class="form-group">
               		<label for="name">{{ __('role.name') }}<span style="color:red">*</span></label>
                   	<input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="{{ __('role.name') }}" required>
                    	@if ($errors->has('name'))
                			<span class="error invalid-feedback">
                  			<strong>{{ $errors->first('role.name') }}</strong>
         					</span>
     					@endif
                </div>
              	<div class="form-group">
               		<label for="description">{{ __('role.description') }}</label>
                   	<input id="description" type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" value="{{ old('description') }}" placeholder="{{ __('role.description') }}">
                    	@if ($errors->has('description'))
                			<span class="error invalid-feedback">
                  			<strong>{{ $errors->first('description') }}</strong>
         					</span>
     					@endif
                </div>  
              	<div class="form-group">
               		<label for="is_active">{{ __('role.is_active') }}<span style="color:red">*</span></label>
                  <select class="form-control{{ $errors->has('is_active') ? ' is-invalid' : '' }}" name="is_active" required>
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
			  	<label for="required"><span style="color:red">* {{ __('label.required') }}</span></label>
			  </div>
              </div>  
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{ __('button.save') }}</button>
               <button type="button" class="btn btn-primary" onclick="window.location.href = '{{ route('role.index') }}';">{{ __('button.back') }}</button>
              </div>
            </form> 
          </div>    
@endsection

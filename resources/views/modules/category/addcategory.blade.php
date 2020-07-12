@extends('layouts.app')

@section('content') 
          <div class="card card-primary card-outline">
            <div class="card-header with-border">
              <h3 class="card-title">{{ __('category.add_category') }}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="POST" action="{{ route('category.store') }}">
			@csrf
              <div class="card-body"> 
              <div class="form-group">
                <label for="parent_id">{{ __('category.parent_id') }}</label>
                  <select class="form-control select2bs4{{ $errors->has('parent_id') ? ' is-invalid' : '' }}" style="width: 100%;" id='parent_id' name='parent_id'>
                    @php
                    echo HtmlUtil::categoryOption(null, Request::old('parent_id'))
                    @endphp
                  </select>
                    @if ($errors->has('parent_id'))
                			<span class="error invalid-feedback">
                  			<strong>{{ $errors->first('parent_id') }}</strong>
             					</span>
             					@endif
                </div>
              	<div class="form-group">
               		<label for="name">{{ __('category.name') }}<span style="color:red">*</span></label>
                   	<input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="{{ __('category.name') }}"  required>
                    	@if ($errors->has('name'))
                			<span class="error invalid-feedback">
                  			<strong>{{ $errors->first('name') }}</strong>
             					</span>
             					@endif
                </div>
              	<div class="form-group {{ $errors->has('description') ? ' is-invalid' : '' }}">
               		<label for="description">{{ __('category.description') }}</label>
                   	<input id="description" type="text" class="form-control" name="description" value="{{ old('description') }}" placeholder="{{ __('category.description') }}">
                    	@if ($errors->has('description'))
                			<span class="error invalid-feedback">
                  			<strong>{{ $errors->first('description') }}</strong>
         					</span>
     					@endif
                </div>  
              	<div class="form-group {{ $errors->has('is_active') ? ' is-invalid' : '' }}">
               		<label for="is_active">{{ __('role.is_active') }}<span style="color:red">*</span></label>
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
			  	<label for="required"><span style="color:red">* {{ __('label.required') }}</span></label>
			  </div>
              </div>  
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{ __('button.save') }}</button> 
                <button type="button" class="btn btn-primary" onclick="window.location.href = '{{ route('category.index') }}';">{{ __('button.back') }}</button>
              </div>
            </form> 
          </div>    


@endsection

@extends('layouts.app')

@section('content') 
          <div class="card card-primary card-outline">
            <div class="card-header with-border">
              <h3 class="card-title">{{ __('role.role_details') }}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
              <div class="card-body"> 
              	<div class="form-group">
               		<label for="name">{{ __('role.name') }}</label><br>
                   	 {{ $role->name}}
                </div>
              	<div class="form-group">
               		<label for="description">{{ __('role.description') }}</label><br>
                   	{{ $role->description}}
                </div>  
              	<div class="form-group">
               		<label for="is_active">{{ __('role.is_active') }}</label><br>
               		 {{ $role->is_active}}
                </div>                               
              </div>  
              <!-- /.card-body -->

              <div class="card-footer"> 
                <button type="submit" class="btn btn-primary" onclick="location.href = '{{ route('role.edit',$role->id) }}';">{{ __('button.update') }}</button>
               <button type="button" class="btn btn-primary" onclick="window.location.href = '{{ route('role.index') }}';">{{ __('button.back') }}</button>
            </form> 
          </div>    
@endsection

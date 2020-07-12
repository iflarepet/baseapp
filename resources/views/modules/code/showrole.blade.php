@extends('layouts.app')

@section('content') 
<div class="container">
    <div class="row justify-content-center">  

          <div class="card card-primary card-outline">
            <div class="card-header with-border">
              <h3 class="card-title">{{ __('role.Role Details') }}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
              <div class="card-body"> 
              	<div class="form-group">
               		<label for="name">{{ __('role.Name') }}</label><br>
                   	 {{ $role->name}}
                </div>
              	<div class="form-group">
               		<label for="description">{{ __('role.Desription') }}</label><br>
                   	{{ $role->description}}
                </div>  
              	<div class="form-group">
               		<label for="is_active">{{ __('role.Is Active') }}</label><br>
               		 {{ $role->is_active}}
                </div>                               
              </div>  
              <!-- /.card-body -->

              <div class="card-footer"> 
                <button type="submit" class="btn btn-primary" onclick="location.href = '{{ route('role.edit',$role->id) }}';">{{ __('button.Update') }}</button>
                <button class="btn btn-primary" onclick="window.history.back();">{{ __('button.Back') }}</button>         
            </form> 
          </div>    
    
	</div>    
</div>     



@endsection

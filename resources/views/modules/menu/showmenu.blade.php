@extends('layouts.app')

@section('content') 
          <div class="card card-primary card-outline">
            <div class="card-header with-border">
              <h3 class="card-title">{{ __('menu.menu_details') }}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
              <div class="card-body"> 
              	<div class="form-group">
               		<label for="name">{{ __('menu.parent_id') }}</label><br>
				    @if($menu->parent_id)                  		
                   	 {{ $menu->parent->name }}
                   	@endif	
                </div>
               	<div class="form-group">
               		<label for="name">{{ __('menu.name') }}</label><br>
                   	 {{ $menu->name}}
                </div>
              	<div class="form-group">
               		<label for="description">{{ __('menu.description') }}</label><br>
                   	{{ $menu->description}}
                </div>  
              	<div class="form-group">
               		<label for="description">{{ __('menu.url') }}</label><br>
                   	{{ $menu->url}}
                </div>  
              	<div class="form-group">
               		<label for="description">{{ __('menu.resource_id') }}</label><br>
                   	{{ $menu->resource_id}}
                </div>  
              	<div class="form-group">
               		<label for="description">{{ __('menu.icon_id') }}</label><br>
                   	{{ $menu->icon_id}}
                </div>  
              	<div class="form-group">
               		<label for="description">{{ __('menu.tag') }}</label><br>
                   	{{ $menu->tag}}
                </div>  
              	<div class="form-group">
               		<label for="is_active">{{ __('menu.is_active') }}</label><br>
               		 {{ $menu->is_active}}
                </div>                               
              </div>  
              <!-- /.card-body -->

              <div class="card-footer"> 
                <button type="submit" class="btn btn-primary" onclick="location.href = '{{ route('menu.edit',$menu->id) }}';">{{ __('button.update') }}</button>
                <button type="button" class="btn btn-primary" onclick="window.location.href = '{{ route('role.index') }}';">{{ __('button.back') }}</button>
            </form> 
          </div>    


@endsection

@extends('layouts.app')

@section('content') 
          <div class="card card-primary card-outline">
            <div class="card-header with-border">
              <h3 class="card-title">{{ __('category.category_details') }}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
              <div class="card-body"> 
                <div class="form-group">
               		<label for="name">{{ __('category.parent_id') }}</label><br>
                   	 {{($category->parent_id ? $category->parent->name : '')}}
                </div>
              
              	<div class="form-group">
               		<label for="name">{{ __('category.name') }}</label><br>
                   	 {{ $category->name}}
                </div>
              	<div class="form-group">
               		<label for="description">{{ __('category.description') }}</label><br>
                   	{{ $category->description}}
                </div>  
              	<div class="form-group">
               		<label for="is_active">{{ __('category.is_active') }}</label><br>
               		 {{ $category->is_active}}
                </div>                               
              </div>  
              <!-- /.card-body -->

              <div class="card-footer"> 
                <button type="submit" class="btn btn-primary" onclick="location.href = '{{ route('category.edit',$category->id) }}';">{{ __('button.update') }}</button>
                <button type="button" class="btn btn-primary" onclick="window.location.href = '{{ route('category.index') }}';">{{ __('button.back') }}</button>
            </form> 
          </div>    
@endsection

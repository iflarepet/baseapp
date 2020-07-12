@extends('layouts.app')

@section('content') 
          <div class="card card-primary card-outline">
            <div class="card-header with-border">
              <h3 class="card-title">{{ __('category.update_category') }}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="POST" action="{{ route('category.update',$category->id) }}">
			@csrf
			<input name="_method" type="hidden" value="PATCH">
              <div class="card-body"> 

                <div class="form-group"> 
                <label for="parent_id">{{ __('category.parent_id') }}</label>
                  <select class="form-control select2bs4{{ $errors->has('parent_id') ? ' is-invalid' : '' }}" style="width: 100%;" id='parent_id' name='parent_id'>
                    @php
                    echo HtmlUtil::categoryOption(null, $category->parent_id)
                    @endphp
                  </select>
                    @if ($errors->has('parent_id'))
                			<span class="error invalid-feedback">
                  			<strong>{{ $errors->first('parent_id') }}</strong>
             					</span>
             					@endif
                </div>
              	<div class="form-group {{ $errors->has('name') ? ' is-invalid' : '' }}">
               		<label for="name">{{ __('category.name') }}<span style="color:red">*</span></label>
                   	<input id="name" type="text" class="form-control" name="name" value="{{$category->name}}" placeholder="{{ __('category.name') }}" required>
                    	@if ($errors->has('name'))
                			<span class="error invalid-feedback">
                  			<strong>{{ $errors->first('name') }}</strong>
         					</span>
     					@endif
                </div>
              	<div class="form-group {{ $errors->has('description') ? ' is-invalid' : '' }}">
               		<label for="description">{{ __('category.description') }}</label>
                   	<input id="description" type="text" class="form-control" name="description" value="{{$category->description}}" placeholder="{{ __('category.description') }}">
                    	@if ($errors->has('description'))
                			<span class="error invalid-feedback">
                  			<strong>{{ $errors->first('description') }}</strong>
         					</span>
     					@endif
                </div>  
              	<div class="form-group {{ $errors->has('is_active') ? ' is-invalid' : '' }}">
               		<label for="is_active">{{ __('category.is_active') }}<span style="color:red">*</span></label>
                  <select class="form-control" name="is_active" required>
                    <option value='Y' @if ($category->is_active == 'Y') selected @endif>YES</option>
                    <option value='N' @if ($category->is_active == 'N') selected @endif>NO</option>
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
                <button type="submit" class="btn btn-primary">{{ __('button.update') }}</button>
                <button type="button" class="btn btn-primary" onclick="window.location.href = '{{ route('category.index') }}';">{{ __('button.back') }}</button>
              </div>
            </form> 
          </div>    

<script type="text/javascript">

//autocomplete script
$(document).on('focus','.autocomplete_txt',function(){ 
    $(this).autocomplete({
       minLength: 0,
       source: function( request, response ) {
            $.ajax({
                url: "{{ route('searchcategory') }}",
                dataType: "json",
                data: {
                    term : request.term, 
                },
                success: function(data) {
                    var array = $.map(data, function (item) {
                       return {
                           label: item['name'],
                           value: item['name'], 
                           data : item
                       }
                   });
                    response(array)
                }
             });
       },
       select: function( event, ui ) {
           var data = ui.item.data;           
           $('#parent_name').val(data.name);
           $('#parent_id').val(data.category_id);
           
       }
    });
    
});
</script>

@endsection

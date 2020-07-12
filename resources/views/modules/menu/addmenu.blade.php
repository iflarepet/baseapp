@extends('layouts.app')

@section('content') 
          <div class="card card-primary card-outline">
            <div class="card-header with-border">
              <h3 class="card-title">{{ __('menu.add_menu') }}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="POST" action="{{ route('menu.store') }}">
			@csrf 
              <div class="card-body"> 
              	<div class="form-group">
               		<label for="parent_id">{{ __('menu.parent_menu') }}</label>
		        	<input class="form-control autocomplete_txt{{ $errors->has('parent_id') ? ' is-invalid' : '' }}" type='text' data-type="parent_name" id='parent_name' name='parent_name' placeholder="{{ __('menu.parent_id') }}"/></td>
		        	<input class="form-control autocomplete_txt" type='hidden' data-type="parent_id" id='parent_id' name='parent_id'/> </td>
                </div>
              	<div class="form-group">
               		<label for="name">{{ __('menu.name') }}<span style="color:red">*</span></label>
                   	<input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="{{ __('menu.name') }}" required>
                    	@if ($errors->has('name'))
                			<span class="error invalid-feedback">
                  			<strong>{{ $errors->first('name') }}</strong>
         					</span>
     					@endif
                </div>
              	<div class="form-group">
               		<label for="description">{{ __('menu.description') }}</label>
                   	<input id="description" type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" value="{{ old('description') }}" placeholder="{{ __('menu.description') }}">
                    	@if ($errors->has('description'))
                			<span class="error invalid-feedback">
                  			<strong>{{ $errors->first('description') }}</strong>
         					</span>
     					@endif
                </div>  
              	<div class="form-group">
               		<label for="description">{{ __('menu.url') }}<span style="color:red">*</span></label>
                   	<input id="description" type="text" class="form-control{{ $errors->has('url') ? ' is-invalid' : '' }}" name="url" value="{{ old('url') }}" placeholder="{{ __('menu.description') }}" required>
                    	@if ($errors->has('url'))
                			<span class="error invalid-feedback">
                  			<strong>{{ $errors->first('url') }}</strong>
         					</span>
     					@endif
                </div>  
              	<div class="form-group">
               		<label for="resource_id">{{ __('menu.resource_id') }}</label>
                   	<input id="resource_id" type="text" class="form-control{{ $errors->has('resource_id') ? ' is-invalid' : '' }}" name="resource_id" value="{{ old('resource_id') }}" placeholder="{{ __('menu.resource_id') }}">
                    	@if ($errors->has('resource_id'))
                			<span class="error invalid-feedback">
                  			<strong>{{ $errors->first('resource_id') }}</strong>
         					</span>
     					@endif
                </div>  
              	<div class="form-group">
               		<label for="icon_id">{{ __('menu.icon_id') }}</label>
                   	<input id="icon_id" type="text" class="form-control{{ $errors->has('icon_id') ? ' is-invalid' : '' }}" name="icon_id" value="{{ old('icon_id') }}" placeholder="{{ __('menu.icon_id') }}">
                    	@if ($errors->has('icon_id'))
                			<span class="error invalid-feedback">
                  			<strong>{{ $errors->first('icon_id') }}</strong>
         					</span>
     					@endif
                </div>  
              	<div class="form-group">
               		<label for="tag">{{ __('menu.order_number') }}</label>
                   	<input id="tag" type="text" class="form-control{{ $errors->has('order_number') ? ' is-invalid' : '' }}" name="order_number" value="{{ old('order_number') }}" placeholder="{{ __('menu.order_number') }}">
                    	@if ($errors->has('order_number'))
                			<span class="error invalid-feedback">
                  			<strong>{{ $errors->first('order_number') }}</strong>
         					</span>
     					@endif
                </div>  
              	<div class="form-group">
               		<label for="tag">{{ __('menu.tag') }}</label>
                   	<input id="tag" type="text" class="form-control{{ $errors->has('tag') ? ' is-invalid' : '' }}" name="tag" value="{{ old('tag') }}" placeholder="{{ __('menu.tag') }}">
                    	@if ($errors->has('tag'))
                			<span class="error invalid-feedback">
                  			<strong>{{ $errors->first('tag') }}</strong>
         					</span>
     					@endif
                </div>  
              	<div class="form-group">
               		<label for="is_active">{{ __('menu.is_active') }}<span style="color:red">*</span></label>
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
               <button type="button" class="btn btn-primary" onclick="window.location.href = '{{ route('menu.index') }}';">{{ __('button.back') }}</button>
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
                url: "{{ route('searchmenu') }}",
                dataType: "json",
                data: {
                    term : request.term, 
                },
                success: function(data) {
                    if(!data.length){
                        $('#parent_name').val("");
                        $('#parent_id').val("");
                        var result = [
                            {
                            label: '{{ __('label.no_result') }}', 
                            value: response.term
                            }
                        ];
                        response(result);
                    } else {
                        var array = $.map(data, function (item) {
                            return {
                                label: item['name'],
                                value: item['name'],  
                                data : item
                            }
                        });
                        response(array)
                    }
                }
             });
       },
       select: function( event, ui ) {
           var data = ui.item.data;           
           $('#parent_name').val(data.name);
           $('#parent_id').val(data.parent_id);
           
       }
    });
    
});
</script>
 
@endsection

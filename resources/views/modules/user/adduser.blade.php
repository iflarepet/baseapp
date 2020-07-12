@extends('layouts.app')

@section('content') 

          <div class="card card-primary card-outline">
            <div class="card-header with-border">
              <h3 class="card-title">{{ __('user.add_user') }}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="POST" action="{{ route('user.store') }}">
			@csrf
              <div class="card-body">
              	<div class="form-group">
               		<label for="username">{{ __('user.username') }}<span style="color:red">*</span></label>
                   	<input id="username" size=50 type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" placeholder="{{ __('user.username') }}" required>
                    	@if ($errors->has('username'))
                			<span class="error invalid-feedback">
                  			<strong>{{ $errors->first('username') }}</strong>
         					</span>
     					@endif
                </div>              	
                <div class="form-group">
               		<label for="name">{{ __('user.name') }}<span style="color:red">*</span></label>
                   	<input id="name" size=50 type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="{{ __('user.name') }}" required>
                    	@if ($errors->has('name'))
                			<span class="error invalid-feedback">
                  			<strong>{{ $errors->first('name') }}</strong>
         					</span>
     					@endif
                </div>
              	<div class="form-group">
               		<label for="email">{{ __('user.email') }}<span style="color:red">*</span></label>
                   	<input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="{{ __('user.email') }}" required>
                    	@if ($errors->has('email'))
                			<span class="error invalid-feedback">
                  			<strong>{{ $errors->first('email') }}</strong>
         					</span>
     					@endif
                </div>  
              	<div class="form-group">
               		<label for="email">{{ __('user.role') }}<span style="color:red">*</span></label>
                   	@php
                   	$list = App\Model\Role::where('is_Active', 'Y')->where('name', '!=', 'SU')->pluck('name', 'id'); 
                   	@endphp                   	
					{{ Form::select('role_id', $list, '3', ['class' => 'form-control'.($errors->has('role_id') ? ' is-invalid' : '')]) }}
                    	@if ($errors->has('role_id'))
                			<span class="error invalid-feedback">
                  			<strong>{{ $errors->first('role_id') }}</strong>
         					</span>
     					@endif
                </div>
                <div class="form-group">
               		<label for="name">{{ __('profile.dob') }}</label>
                	<div class="input-group">
						<div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="far fa-calendar-alt"></i>
                            </span>
                          </div>
                  		<input type="text" class="form-control pull-right{{ $errors->has('dob') ? ' is-invalid' : '' }}" id="dob" name="dob" value="{{ old('dob') }}">
                  		@if ($errors->has('dob'))
                			<span class="error invalid-feedback">
                  			<strong>{{ $errors->first('dob') }}</strong>
         					</span>
     					@endif
                	</div>                 	     					
                </div>
                <div class="form-group">
               		<label for="origin">{{ __('profile.origin') }}</label>
                   	<input id="origin" size=50 type="text" class="form-control autocomplete_origin{{ $errors->has('origin') ? ' is-invalid' : '' }}" name="origin" value="{{ old('origin') }}" placeholder="{{ __('profile.origin') }}"/>
					<input class='form-control origin' type='hidden' id='origin_id' name='origin_id' value="{{ old('origin_id') }}"/>
                    	@if ($errors->has('origin'))
                			<span class="error invalid-feedback">
                  			<strong>{{ $errors->first('origin') }}</strong>
         					</span>
     					@endif
				</div>  			
                <div class="form-group">
               		<label for="phone">{{ __('profile.phone') }}</label>
                   	<input id="phone" size=50 type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" placeholder="{{ __('profile.phone') }}">
                    	@if ($errors->has('phone'))
                			<span class="error invalid-feedback">
                  			<strong>{{ $errors->first('phone') }}</strong>
         					</span>
     					@endif
                </div>  
                <div class="form-group">
               		<label for="address1">{{ __('profile.address1') }}</label>
                   	<input id="address1" size=50 type="text" class="form-control{{ $errors->has('address1') ? ' is-invalid' : '' }}" name="address1" value="{{ old('address1') }}" placeholder="{{ __('profile.address1') }}">
                    	@if ($errors->has('address1'))
                			<span class="error invalid-feedback">
                  			<strong>{{ $errors->first('address1') }}</strong>
         					</span>
     					@endif
                </div>          
                <div class="form-group">
               		<label for="address2">{{ __('profile.address2') }}</label>
                   	<input id="address2" size=50 type="text" class="form-control{{ $errors->has('address2') ? ' is-invalid' : '' }}" name="address2" value="{{ old('address2') }}" placeholder="{{ __('profile.address2') }}">
                    	@if ($errors->has('address2'))
                			<span class="error invalid-feedback">
                  			<strong>{{ $errors->first('address2') }}</strong>
         					</span>
     					@endif
                </div>          
                <div class="form-group">
               		<label for="address3">{{ __('profile.address3') }}</label>
                   	<input id="address3" size=50 type="text" class="form-control{{ $errors->has('address3') ? ' is-invalid' : '' }}" name="address3" value="{{ old('address3') }}" placeholder="{{ __('profile.address3') }}">
                    	@if ($errors->has('address3'))
                			<span class="error invalid-feedback">
                  			<strong>{{ $errors->first('address3') }}</strong>
         					</span>
     					@endif
                </div>          
                <div class="form-group">
               		<label for="postal_code">{{ __('profile.postal_code') }}</label>
                   	<input id="postal_code" size=50 type="text" class="form-control{{ $errors->has('postal_code') ? ' is-invalid' : '' }}" name="postal_code" value="{{ old('postal_code') }}" placeholder="{{ __('profile.postal_code') }}">
                    	@if ($errors->has('postal_code'))
                			<span class="error invalid-feedback">
                  			<strong>{{ $errors->first('postal_code') }}</strong>
         					</span>
     					@endif
                </div>   
              	<div class="form-group">
               		<label for="origin_city">{{ __('competition.city') }}</label>
						<input class='form-control city{{ $errors->has('city') ? ' is-invalid' : '' }}' type='text' id='city' name='city' placeholder='{{ __('competition.city') }}' value="{{ old('city') }}"/></td>
						<input class='form-control city' type='hidden' id='city_id' name='city_id' value="{{ old('city_id') }}"/>
                    	@if ($errors->has('city'))
                			<span class="error invalid-feedback">
                  			<strong>{{ $errors->first('city') }}</strong>
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
                <button type="button" class="btn btn-primary" onclick="window.location.href = '{{ route('user.index') }}';">{{ __('button.back') }}</button>    
            </div>
            </form>
          </div>    

<script type="text/javascript">
//Date picker
$('#dob').datepicker();

$(document).on('focus','.autocomplete_origin',function(){ 
	type = 'CITYCOUNTRY'; 
	country = ""; 
    $(this).autocomplete({
       minLength: 0,
       source: function( request, response ) {
            $.ajax({
                url: "{{ route('search') }}",
                dataType: "json",
                data: {
                    term : request.term, 
                    type : type,      
                },
                success: function(data) {
                    if(!data.length){
                        $('#origin').val("");
                        $('#origin_id').val("");
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
           $('#origin').val(data.name);
           $('#origin_id').val(data.code); 
       }
    });  
});

$(document).on('focus','.city',function(){ 
	type = 'CITYCOUNTRY'; 
	country = ""; 
    $(this).autocomplete({
       minLength: 0,
       source: function( request, response ) {
            $.ajax({
                url: "{{ route('search') }}",
                dataType: "json",
                data: {
                    term : request.term, 
                    type : type,
                    country : country,       
                },
                success: function(data) {
                    if(!data.length){
                        $('#city').val("");
                        $('#city_id').val("");
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
           $('#city').val(data.name);
           $('#city_id').val(data.code); 
       }
    });  
});
</script>
     
@php
function dateFormat($strDate) {
	if ($strDate!=null) {
		$date = explode('-', $strDate);
		return $date[1] . '/' . $date[2] . '/' . $date[0];
	} 
	return "";
}
@endphp
@endsection

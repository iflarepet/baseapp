@extends('layouts.app')

@section('content') 
          <div class="card card-primary card-outline">
            <div class="card-header with-border">
              <h3 class="card-title">{{ __('profile.update_profile') }}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="POST" action="{{ route('profile.update',$user->id) }}">
			@csrf
			<input name="_method" type="hidden" value="PATCH">
              <div class="card-body">
              	<div class="form-group">
               		<label for="username">{{ __('user.username') }}</label><br>
					{{$user->username}}
                </div>
                <div class="form-group">
               		<label for="name">{{ __('user.name') }}<span style="color:red">*</span></label>
                   	<input id="name" size=50 type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{$user->name}}" placeholder="{{ __('user.name') }}" required autofocus>
                    	@if ($errors->has('name'))
                			<span class="error invalid-feedback">
                  			<strong>{{ $errors->first('name') }}</strong>
         					</span>
     					@endif
                </div>          
                <div class="form-group">
               		<label for="dob">{{ __('profile.dob') }}</label>
                	<div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="far fa-calendar-alt"></i>
                            </span>
                          </div>
                  		<input type="text" class="form-control pull-right{{ $errors->has('dob') ? ' is-invalid' : '' }}" id="dob" name="dob" value="{{dateFormat($user->profile?$user->profile->dob:'')}}">
                  		@if ($errors->has('dob'))
                			<span class="error invalid-feedback">
                  			<strong>{{ $errors->first('dob') }}</strong>
         					</span>
     					@endif
                	</div>                 	     					
                </div>          
                <div class="form-group">
               		<label for="origin">{{ __('profile.origin') }}</label>
                   	<input id="origin" size=50 type="text" class="form-control autocomplete_origin{{ $errors->has('origin') ? ' is-invalid' : '' }}" name="origin" value="{{($user->profile&&$user->profile->origin?$user->profile->origin->name:'')}}" placeholder="{{ __('profile.origin') }}">
					<input class='form-control origin_id' type='hidden' id='origin_id' name='origin_id' value="{{($user->profile&&$user->profile->origin?$user->profile->origin_id:'')}}"/>
                    	@if ($errors->has('origin'))
                			<span class="error invalid-feedback">
                  			<strong>{{ $errors->first('origin') }}</strong>
         					</span>
     					@endif
                </div>          
                <div class="form-group">
               		<label for="phone">{{ __('profile.phone') }}</label>
                   	<input id="phone" size=50 type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{($user->profile?$user->profile->phone:'')}}" placeholder="{{ __('profile.phone') }}">
                    	@if ($errors->has('phone'))
                			<span class="error invalid-feedback">
                  			<strong>{{ $errors->first('phone') }}</strong>
         					</span>
     					@endif
                </div>          
                <div class="form-group">
               		<label for="address1">{{ __('profile.address1') }}</label>
                   	<input id="address1" size=50 type="text" class="form-control{{ $errors->has('address1') ? ' is-invalid' : '' }}" name="address1" value="{{($user->profile?$user->profile->address1:'')}}" placeholder="{{ __('profile.address1') }}">
                    	@if ($errors->has('address1'))
                			<span class="error invalid-feedback">
                  			<strong>{{ $errors->first('address1') }}</strong>
         					</span>
     					@endif
                </div>          
                <div class="form-group">
               		<label for="address2">{{ __('profile.address2') }}</label>
                   	<input id="address2" size=50 type="text" class="form-control{{ $errors->has('address2') ? ' is-invalid' : '' }}" name="address2" value="{{($user->profile?$user->profile->address2:'')}}" placeholder="{{ __('profile.address2') }}">
                    	@if ($errors->has('address2'))
                			<span class="error invalid-feedback">
                  			<strong>{{ $errors->first('address2') }}</strong>
         					</span>
     					@endif
                </div>          
                <div class="form-group">
               		<label for="address3">{{ __('profile.address3') }}</label>
                   	<input id="address3" size=50 type="text" class="form-control{{ $errors->has('address3') ? ' is-invalid' : '' }}" name="address3" value="{{($user->profile?$user->profile->address3:'')}}" placeholder="{{ __('profile.address3') }}">
                    	@if ($errors->has('address3'))
                			<span class="error invalid-feedback">
                  			<strong>{{ $errors->first('address3') }}</strong>
         					</span>
     					@endif
                </div>          
                <div class="form-group">
               		<label for="postal_code">{{ __('profile.postal_code') }}</label>
                   	<input id="postal_code" size=50 type="text" class="form-control{{ $errors->has('postal_code') ? ' is-invalid' : '' }}" name="postal_code" value="{{($user->profile?$user->profile->postal_code:'')}}" placeholder="{{ __('profile.postal_code') }}">
                    	@if ($errors->has('postal_code'))
                			<span class="error invalid-feedback">
                  			<strong>{{ $errors->first('postal_code') }}</strong>
         					</span>
     					@endif
                </div>   
              	<div class="form-group">
               		<label for="origin_city">{{ __('competition.city') }}</label>
						<input class='form-control city{{ $errors->has('city') ? ' is-invalid' : '' }}' type='text' id='city' name='city' placeholder='{{ __('competition.city') }}' value="{{($user->profile? ($user->profile->city?$user->profile->city->name:''):'')}}"/></td>
						<input class='form-control city' type='hidden' id='city_id' name='city_id' value="{{($user->profile?$user->profile->city_id:'')}}"/>
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
                <button type="submit" class="btn btn-primary">{{ __('button.update') }}</button> 
				<button type="button" class="btn btn-primary" onclick="window.location.href = '{{ route('profile.index') }}';">{{ __('button.back') }}</button>
                        
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

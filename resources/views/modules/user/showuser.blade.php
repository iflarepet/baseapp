@extends('layouts.app')

@section('content') 
          <div class="card card-primary card-outline">
            <div class="card-header with-border">
              <h3 class="card-title">{{ __('user.user_details') }}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
 
			<input name="_method" type="hidden" value="PATCH">
              <div class="card-body">
              	<div class="form-group">
               		<label for="username">{{ __('user.username') }}</label><br>
					{{$user->username}}
                </div>       
                <div class="form-group">
               		<label for="name">{{ __('user.name') }}</label><br>
                   	{{$user->name}}
                </div>
              	<div class="form-group">
               		<label for="email">{{ __('user.email') }}</label><br>
                   	{{ $user->email }}
          		</div>
                <div class="form-group">
               		<label for="is_active">{{ __('user.is_active') }}</label><br>
                    {{ $user->is_active }}           					
                </div>                               
                <div class="form-group">
               		<label for="locked">{{ __('user.locked') }}</label><br>
                    {{ $user->locked }}                					
                </div>   		               
                <div class="form-group">
               		<label for="locked">{{ __('user.role') }}</label><br>
                    {{ (count($user->roles)>0?$user->roles[0]['name']:'') }}                					
                </div> 
                <div class="form-group {{ $errors->has('dob') ? ' is-invalid' : '' }}">
               		<label for="name">{{ __('profile.dob') }}</label><br>
                	{{dateFormat($user->profile?$user->profile->dob:'')}}               	     					
                </div>          
                <div class="form-group {{ $errors->has('origin') ? ' is-invalid' : '' }}">
               		<label for="origin">{{ __('profile.origin') }}</label><br>
                    {{($user->profile&&$user->profile->origin?$user->profile->origin->name:'')}}
                </div>          
                <div class="form-group {{ $errors->has('phone') ? ' is-invalid' : '' }}">
               		<label for="phone">{{ __('profile.phone') }}</label><br>
               		{{($user->profile?$user->profile->phone:'')}}
                </div>          
                <div class="form-group {{ $errors->has('address1') ? ' is-invalid' : '' }}">
               		<label for="address1">{{ __('profile.address1') }}</label><br>
               		{{($user->profile?$user->profile->address1:'')}}
                </div>          
                <div class="form-group {{ $errors->has('address2') ? ' is-invalid' : '' }}">
               		<label for="address2">{{ __('profile.address2') }}</label><br>
               		{{($user->profile?$user->profile->address2:'')}}
                </div>          
                <div class="form-group {{ $errors->has('address3') ? ' is-invalid' : '' }}">
               		<label for="address3">{{ __('profile.address3') }}</label><br>
               		{{($user->profile?$user->profile->address3:'')}}
                </div>          
                <div class="form-group {{ $errors->has('postal_code') ? ' is-invalid' : '' }}">
               		<label for="postal_code">{{ __('profile.postal_code') }}</label><br>
               		{{($user->profile?$user->profile->postal_code:'')}}
                </div>   
                <div class="form-group {{ $errors->has('city') ? ' is-invalid' : '' }}">
               		<label for="country">{{ __('profile.city') }}</label><br>
               		{{($user->profile&&$user->profile->city?$user->profile->city->name:'')}}
                </div>                   
              </div>  
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary" onclick="location.href = '{{ route('user.edit',$user->id) }}';">{{ __('button.update') }}</button>
                <button type="button" class="btn btn-primary" onclick="window.location.href = '{{ route('user.index') }}';">{{ __('button.back') }}</button>
              </div> 
          </div>    
     
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

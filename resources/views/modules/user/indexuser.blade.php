@extends('layouts.app')

@section('content') 
    @if ($message = Session::get('success')) 
	<div class="alert alert-success alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4><i class="icon fa fa-check"></i>{{ __('label.alert') }}</h4>
				{{ $message }}
	</div>     
    @endif 
          <div class="card card-primary card-outline">
            <div class="card-header with-border">
              <h3 class="card-title">{{ __('user.user_maintenance') }}</h3>
            </div> 
            <div class="card-body">                      
            <form method="GET" action="{{ route('user.index') }}">
			@csrf          
                <div class="input-group input-group-sm">
                	<input type="text" name="keyword" value="{{ Request::get('keyword') }}" class="form-control" placeholder="{{ __('search.keyword') }}" >
                    <span class="input-group-append">
                      <button type="submit" class="btn btn-primary btn-flat">{{ __('button.search') }}</button>
                    </span>
              	</div>
            </form>                       
                <div class="card-footer"> 
                   <button type="submit" class="btn btn-primary" onclick="location.href = '{{ route('user.create') }}'">
                   <i class="fa fa-plus"></i> {{ __('button.add') }}</button>
                </div>         

            </div>   
            
			<div class="card-header">
              <h3 class="card-title">{{ __('user.user_listing') }}</h3>
            </div>
            <div class="card-body overflow" style="overflow: auto;">
              <table id="tabledata" class="table table-bordered table-hover">
                <thead>
                <tr> 
                  <th>{{ __('label.no') }}</th>
                  <th>{{ __('user.username') }}</th>
                  <th>{{ __('user.name') }}</th> 
                  <th>{{ __('user.email') }}</th>
                  <th>{{ __('user.role') }}</th>
                  <th>{{ __('user.is_active') }}</th>
                  <th>{{ __('user.locked') }}</th>
                  <th>{{ __('label.action') }}</th>
                </tr>
                </thead>
                <tbody>
                @php
                	$i = 1 + ($users->perPage() * ($users->currentPage()-1));
                @endphp
    				@foreach ($users as $user)
				    <tr>
				        <td>{{ $i++ }}</td>
				        <td><a href="{{ route('user.show',$user->id) }}">{{ $user->username}}</a></td>
				        <td>{{ $user->name}}</td>
				        <td>{{ $user->email}}</td>
				        <td>
				    	@php
				    	$role_name = "";
				    	if(count($user->roles)) {
	                   		$role_name = $user->roles[0]['name'];
				    	}               		                   	
                   		@endphp 
                   		{{$role_name}}
				        </td>
				        <td>{{ $user->is_active}}</td>
				        <td>
				        @if ($user->locked == 'Y')
				        <form method="post" action="{{ route('locked',$user->id) }}" onSubmit="return confirm('{{ __('user.unlocked_message') }}');" style="display:inline">
				        @else 
				        <form method="post" action="{{ route('locked',$user->id) }}" onSubmit="return confirm('{{ __('user.locked_message') }}');" style="display:inline">
				        @endif
				        <input type="hidden" name="_method" value="PATCH"/>
				        @csrf 
				        @if ($user->locked == 'Y')
				        <input type="hidden" name="locked" value="N"/>
				        <button type="submit" class="btn btn-danger btn-xs">
                   		<i class="fa fa-lock"></i></button>				        
				        @else 
				        <input type="hidden" name="locked" value="Y"/>
				        <button type="submit" class="btn btn-primary btn-xs">
                   		<i class="fa fa-unlock"></i></button>				        
				        @endif
				        </form>   
				        </td>
				        <td>
				        <a class="btn btn-primary btn-xs" href="{{ route('user.edit',$user->id) }}"><i class="fa fa-edit"></i></a> 
				        </form>  
				        </td>
				    </tr>
    @endforeach

              </table>  
                  {{$users->links()}}
            </div>
          </div>  
<script>
  $(function () { 
    $('#tabledata').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    })
  })
</script> 
@endsection

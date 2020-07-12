@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center"> 
    @if ($message = Session::get('success')) 
	<div class="alert alert-success alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4><i class="icon fa fa-check"></i>{{ __('label.alert') }}</h4>
				{{ $message }}
	</div>     
    @endif
    
    
          <div class="card card-primary card-outline">
            <div class="card-header with-border">
              <h3 class="card-title">{{ __('role.Role Maintenance') }}</h3>
            </div> 
            <div class="card-body">                      
            <form method="POST" action="{{ route('role.index') }}">
			@csrf          
                <div class="input-group input-group-sm">
                	<input type="text" name="keyword" value="{{ old('keyword') }}" class="form-control" placeholder="{{ __('search.Keyword') }}" >
                    <span class="input-group-append">
                      <button type="submit" class="btn btn-info btn-flat">{{ __('search.Search') }}</button>
                    </span>
              	</div>
            </form>                       
                <div class="card-footer"> 
                   <button type="submit" class="btn btn-primary" onclick="location.href = '{{ route('role.create') }}'">
                   <i class="fa fa-plus"></i> {{ __('role.Add Role') }}</button>
                </div>         

            </div>   
            
			<div class="card-header">
              <h3 class="card-title">{{ __('role.Role Listing') }}</h3>
            </div>
            <div class="card-body overflow" style="overflow: auto;">
              <table id="tabledata" class="table table-bordered table-hover">
                <thead>
                <tr> 
                  <th>{{ __('label.No') }}</th>
                  <th>{{ __('role.Name') }}</th>
                  <th>{{ __('role.Description') }}</th> 
                  <th>{{ __('role.Is Active') }}</th>
                  <th>{{ __('label.Action') }}</th>
                </tr>
                </thead>
                <tbody>
                @php
                	$i =1 ;
                @endphp
    				@foreach ($roles as $role)
				    <tr>
				        <td>{{ $i++ }}</td>
				        <td><a href="{{ route('role.show',$role->id) }}">{{ $role->name}}</a></td>
				        <td>{{ $role->description}}</td>
				        <td>{{ $role->is_active}}</td>
				        <td>
				        <a class="btn btn-primary" href="{{ route('role.edit',$role->id) }}"><i class="fa fa-edit"></i></a> 
				        <form method="post" action="{{ route('role.destroy',$role->id) }}" style="display:inline">
				        @csrf 
				        <input type="hidden" name="_method" value="DELETE"/>
				        <button type="submit" class="btn btn-danger">
                   		<i class="fas fa-trash-alt"></i></button>
				        </form>  
				        </td>
				    </tr>
    @endforeach

              </table>  
                  {{$roles->links()}}
            </div>
          </div>    
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

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
              <h3 class="card-title">{{ __('role.role_maintenance') }}</h3>
            </div> 
            <div class="card-body">                      
            <form method="POST" action="{{ route('role.index') }}">
			@csrf          
                <div class="input-group input-group-sm">
                	<input type="text" name="keyword" value="{{ old('keyword') }}" class="form-control" placeholder="{{ __('search.keyword') }}" >
                    <span class="input-group-append">
                      <button type="submit" class="btn btn-primary btn-flat">{{ __('button.search') }}</button>
                    </span>
              	</div>
            </form>                       
                <div class="card-footer"> 
                   <button type="submit" class="btn btn-primary" onclick="location.href = '{{ route('role.create') }}'">
                   <i class="fa fa-plus"></i> {{ __('button.add') }}</button>
                </div>         

            </div>   
            
			<div class="card-header">
              <h3 class="card-title">{{ __('role.role_listing') }}</h3>
            </div>
            <div class="card-body overflow" style="overflow: auto;">
              <table id="tabledata" class="table table-bordered table-hover">
                <thead>
                <tr> 
                  <th>{{ __('label.no') }}</th>
                  <th>{{ __('role.name') }}</th>
                  <th>{{ __('role.description') }}</th> 
                  <th>{{ __('role.is_active') }}</th>
                  <th>{{ __('label.action') }}</th>
                </tr>
                </thead>
                <tbody>
                @php
                	$i = 1 + ($roles->perPage() * ($roles->currentPage()-1));
                @endphp
    				@foreach ($roles as $role)
				    <tr>
				        <td>{{ $i++ }}</td>
				        <td><a href="{{ route('role.show',$role->id) }}">{{ $role->name}}</a></td>
				        <td>{{ $role->description}}</td>
				        <td>{{ $role->is_active}}</td>
				        <td>
				        <a class="btn btn-primary btn-xs" href="{{ route('role.edit',$role->id) }}"><i class="fa fa-edit"></i></a> 
				        <a class="btn btn-primary btn-xs" href="{{ route('rolemenu.edit',$role->id) }}"><i class="fa fa-list"></i></a> 
				        <form method="post" action="{{ route('role.destroy',$role->id) }}" onSubmit="return confirm('{{ __('label.delete_message') }}');" style="display:inline">
				        @csrf 
				        <input type="hidden" name="_method" value="DELETE"/>
				        <button type="submit" class="btn btn-danger btn-xs">
                   		<i class="fas fa-trash-alt"></i></button>
				        </form>  
				        </td>
				    </tr>
    @endforeach

              </table>  
                  {{$roles->links()}}
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

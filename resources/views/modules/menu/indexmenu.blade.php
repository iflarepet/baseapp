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
              <h3 class="card-title">{{ __('menu.menu_maintenance') }}</h3>
            </div> 
            <div class="card-body">                      
            <form method="GET" action="{{ route('menu.index') }}">
			@csrf          
                <div class="input-group input-group-sm">
                 	<input type="text" name="keyword" value="{{ Request::get('keyword') }}" class="form-control" placeholder="{{ __('search.keyword') }}" >
                   <span class="input-group-append">
                      <button type="submit" class="btn btn-primary btn-flat">{{ __('button.search') }}</button>
                    </span>
              	</div>
            </form>                       
                <div class="card-footer"> 
                   <button type="submit" class="btn btn-primary" onclick="location.href = '{{ route('menu.create') }}';">
                   <i class="fa fa-plus"></i> {{ __('button.add') }}</button>
                </div>         

            </div>   
            
			<div class="card-header">
              <h3 class="card-title">{{ __('menu.menu_listing') }}</h3>
            </div>
            <div class="card-body overflow" style="overflow: auto;">
              <table id="tabledata" class="table table-bordered table-hover">
                <thead>
                <tr> 
                  <th>{{ __('label.no') }}</th>
                  <th>{{ __('menu.parent_id') }}</th>
                  <th>{{ __('menu.name') }}</th>
                  <th>{{ __('menu.description') }}</th> 
                  <th>{{ __('menu.url') }}</th> 
                  <th>{{ __('menu.resource_id') }}</th> 
                  <th>{{ __('menu.icon_id') }}</th> 
                  <th>{{ __('menu.order_number') }}</th>  
                  <th>{{ __('menu.tag') }}</th>  
                  <th>{{ __('menu.is_active') }}</th>
                  <th>{{ __('label.action') }}</th>
                </tr>
                </thead>
                <tbody> 
		
                @php
                	$i = 1 + ($menus->perPage() * ($menus->currentPage()-1));
                @endphp
    				@foreach ($menus as $menu)
				    <tr>
				        <td>{{ $i++ }}</td> 
				        <td>
				        @if($menu->parent_id)
				        <a href="{{ route('menu.show',$menu->parent_id) }}">
						{{ $menu->parent->name }}			        									        
				        </a>
				        @else
				        {{ $menu->parent_id}}
				        @endif				        				        
				        </td>
				        <td><a href="{{ route('menu.show',$menu->id) }}">{{ $menu->name}}</a></td>
				        <td>{{ $menu->description}}</td>
				        <td>{{ $menu->url}}</td>
				        <td>{{ $menu->resource_id}}</td>
				        <td>{{ $menu->icon_id}}</td>
				        <td>{{ $menu->order_number}}</td>
				        <td>{{ $menu->tag}}</td>
				        <td>{{ $menu->is_active}}</td>
				        <td>
				        <a class="btn btn-primary btn-xs" href="{{ route('menu.edit',$menu->id) }}"><i class="fa fa-edit"></i></a> 
				        <form method="post" action="{{ route('menu.destroy',$menu->id) }}" onSubmit="return confirm('{{ __('label.delete_message') }}');" style="display:inline">
				        @csrf 
				        <input type="hidden" name="_method" value="DELETE"/>
				        <button type="submit" class="btn btn-danger btn-xs">
                   		<i class="fas fa-trash-alt"></i></button>
				        </form>  
				        </td>
				    </tr>
    @endforeach

              </table>  
                  {{$menus->links()}}
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

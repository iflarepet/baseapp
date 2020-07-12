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
              <h3 class="card-title">{{ __('category.category_maintenance') }}</h3>
            </div> 
            <div class="card-body">                      
            <form method="GET" action="{{ route('category.index') }}">
			@csrf          
                <div class="input-group input-group-sm">
                	<input type="text" name="keyword" value="{{ Request::get('keyword') }}" class="form-control" placeholder="{{ __('search.keyword') }}" >
                    <span class="input-group-append">
                      <button type="submit" class="btn btn-primary btn-flat">{{ __('button.search') }}</button>
                    </span>
              	</div>
            </form>                       
                <div class="card-footer"> 
                   <button type="submit" class="btn btn-primary" onclick="location.href = '{{ route('category.create') }}'">
                   <i class="fa fa-plus"></i> {{ __('button.add') }}</button>
                </div>         

            </div>   
            
			<div class="card-header">
              <h3 class="card-title">{{ __('category.category_listing') }}</h3>
            </div>
            <div class="card-body overflow" style="overflow: auto;">
              <table id="tabledata" class="table table-bordered table-hover">
                <thead>
                <tr> 
                  <th>{{ __('label.no') }}</th>
                  <th>{{ __('category.parent_id') }}</th>
                  <th>{{ __('category.name') }}</th>
                  <th>{{ __('category.description') }}</th> 
                  <th>{{ __('category.is_active') }}</th>
                  <th>{{ __('label.action') }}</th>
                </tr>
                </thead>
                <tbody>
                @php
                	$i = 1 + ($categories->perPage() * ($categories->currentPage()-1));
                @endphp
    				@foreach ($categories as $category)
				    <tr>
				        <td>{{ $i++ }}</td>
				        <td>
				        
				        @if($category->parent_id)
 				        <a href="{{ route('category.show',$category->parent_id) }}">
						{{ $category->parent->name }}			        
				        </a>
				        @else
				        {{ $category->parent_id}}
				        @endif
				        </td>
				        <td><a href="{{ route('category.show',$category->id) }}">{{ $category->name}}</a></td>
				        <td>{{ $category->description}}</td>
				        <td>{{ $category->is_active}}</td>
				        <td>
				        <a class="btn btn-primary btn-xs" href="{{ route('category.edit',$category->id) }}"><i class="fa fa-edit"></i></a> 
				        <form method="post" action="{{ route('category.destroy',$category->id) }}" onSubmit="return confirm('{{ __('label.delete_message') }}');" style="display:inline">
				        @csrf 
				        <input type="hidden" name="_method" value="DELETE"/>
				        <button type="submit" class="btn btn-danger btn-xs">
                   		<i class="fas fa-trash-alt"></i></button>
				        </form>  
				        </td>
				    </tr>
    @endforeach

              </table>  
                  {{$categories->links()}}
            </div>
          </div>    
		
</script> 
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

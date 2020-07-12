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
              <h3 class="card-title">{{ __('notification.notification_maintenance') }}</h3>
            </div> 
            <div class="card-body">                      
            <!-- <form method="POST" action="{{asset('profile/notification')}}">
			@csrf          
                <div class="input-group input-group-sm">
                	<input type="text" name="keyword" value="{{ Request::get('keyword') }}" class="form-control" placeholder="{{ __('search.keyword') }}" >
                    <span class="input-group-append">
                      <button type="submit" class="btn btn-primary btn-flat">{{ __('button.search') }}</button>
                    </span>
              	</div>
            </form>                -->

            </div>   
            
			<div class="card-header">
              <h3 class="card-title"><a href="{{asset('profile/notification/allread')}}">{{ __('notification.all_read') }}</a></h3>
            </div>
            <div class="card-body overflow" style="overflow: auto;">
              <table id="tabledata" class="table table-bordered table-hover">
                <thead>
                <tr> 
                  <th>{{ __('label.no') }}</th> 
                  <th>{{ __('notification.message') }}</th> 
                  <th>{{ __('notification.date') }}</th>  
                  <th>{{ __('label.action') }}</th>
                </tr>
                </thead>
                <tbody>
                @php
                	$i = 1 + ($notifications->perPage() * ($notifications->currentPage()-1));
                @endphp
    				@foreach ($notifications as $notification)
				    <tr>
				        <td>{{ $i++ }}</td> 
				        <td><a href="{{asset('profile/notification/show/'.$notification->id)}}"><?php echo NotificationHelper::show($notification->id)?></a></td> 
				        <td>{{ $notification->timestamp()}}</td> 
				        <td>
				        @if ($notification->status == 'NEW')
				        <form method="post" action="{{ route('read',$notification->id) }}"> 
				        <input type="hidden" name="_method" value="PATCH"/>
				        @csrf 				        
				        <button type="submit" class="btn btn-xs">
                   		<i class="fa fa-eye"></i></button>				        
				        @endif
				        </form> 				        
				        
				        
				        
				        </td>
				    </tr>
    @endforeach

              </table>  
                  {{$notifications->links()}}
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

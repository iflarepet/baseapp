@extends('layouts.app')

@section('content') 

<div class="container-fluid">
  @if ($message = Session::get('success')) 
	<div class="alert alert-success alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4><i class="icon fa fa-check"></i>{{ __('label.alert') }}</h4>
				{{ $message }}
	</div>      
    @endif

    <div class="row">
      <div class="col-md-3">

        <!-- Profile Image -->
        <div class="card card-primary card-outline">
          <div class="card-body box-profile">
            <div class="text-center">
              <img class="profile-user-img img-responsive img-circle" src="{{ $user->avatar() }}">
            </div>

            <h3 class="profile-username text-center">{{ $user->name }}</h3>

            <p class="text-muted text-center"></p>
            
            <ul class="list-group list-group-unbordered mb-3">
              <li class="list-group-item">
                <b>{{ __('profile.followers') }}</b>
                  <a href="{{ route('profile.follower',$user->id) }}" class="float-right">{{count($user->followers)}}
                  </a>
              </li>
              <li class="list-group-item">
                <b>{{ __('profile.following') }}</b>
                <a href="{{ route('profile.following',$user->id) }}" class="float-right">{{count($user->following)}}
                </a>
              </li> 
            </ul>
            @if (Auth::user()&&$user->id!=Auth::user()->id)            
              @php
              $isFollowing = false;
              foreach($user->followers as $follower) {
                if ($follower->follower_id == Auth::user()->id) {
                  $isFollowing = true;
                  break;
                }
              }
              @endphp 
              @if ($isFollowing) 
                <button type="submit" class="btn btn-primary btn-block" onclick="location.href = '{{ route('profile.follow',$user->id) }}';"><b>{{ __('button.unfollow') }}</b></button>
              @else
                <button type="submit" class="btn btn-primary btn-block" onclick="location.href = '{{ route('profile.follow',$user->id) }}';"><b>{{ __('button.follow') }}</b></button>
              @endif
            @endif
          </div>
        </div>

            <!-- About Me Box -->
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">About Me</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

              <strong><i class="fa fa-trophy margin-r-5" style="color:gold"></i>Stats</strong>

              <p class="text-muted">
              <table border="0">
              <tr>
              	<td width='30'><i class="fa fa-trophy" style="color:gold"></i></td>
              	<td>{{count($userData)>0&&$userData[0]->p1st>0 ? $userData[0]->p1st : '-'}} 1st</td>
              </tr>
              <tr>
              	<td width='30'><i class="fa fa-trophy" style="color:silver"></i></td>
              	<td>{{count($userData)>0&&$userData[0]->p2nd>0 ? $userData[0]->p2nd : '-'}} 2nd</td>
              </tr>
              <tr>
              	<td width='30'><i class="fa fa-trophy" style="color:bronze"></i></td>
              	<td>{{count($userData)>0&&$userData[0]->p3rd>0 ? $userData[0]->p3rd: '-'}} 3rd</td>
              </tr>
              </table>
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> {{ __('profile.location') }}</strong>

              <p class="text-muted">{{($user->profile && $user->profile->origin ? $user->profile->origin->name.' ('. $user->profile->origin->country->name .')' : '-')}}</p> 
                <hr>
              </div>
              <!-- /.card-body -->
            </div>
      </div>


      <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#registrations" data-toggle="tab">{{ __('profile.registrations') }}</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="registrations">
                    <!-- Post -->
                    <div class="card-header">
	              <h3 class="card-title">{{ __('registration.registration_listing') }}</h3>
	            </div>
		            <div class="card-body overflow" style="overflow: auto;">
                <table id="tabledata" class="table table-bordered table-hover dataTable dtr-inline collapsed">
		                <thead>
		                <tr> 
		                  <th>{{ __('label.no') }}</th>
		                  <th data-priority="1">{{ __('registration.comp_name') }}</th>
		                  <th data-priority="2">{{ __('registration.registration_id')}}</th>
		                  <th>{{ __('registration.number_of_entrances') }}</th> 
		                </tr>
		                </thead>
		                <tbody> 
		                @php
		                	$i =1 ;
		                @endphp
		    				@foreach ($registrations as $registration)
		    				                
		                <tr>
		                	<td>{{$i++}}</td>
		                	<td>{{$registration->competition->name}}</td>
		                	<td><a href="{{ route('dashboard.viewshow', $registration->id) }}">{{$registration->registration_id}}</a></td>
		                	<td>{{count($registration->classRegistration)}}</td> 
		                </tr>
		                   @endforeach 
						</tbody>
		              </table>   
		              {{$registrations->links()}}
		            </div>
            	</div>  
    </div>
</div><!-- /.container-fluid -->





<div class="modal fade" id="modal-default-selectImage">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header"> 
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button> 
              </div>
              <div class="modal-body"> 
              <form method="POST" id="regForm" action="{{ route('profile.update' , $user->id) }}" enctype="multipart/form-data"> 
				@csrf
				<input name="_method" type="hidden" value="PATCH">
				<input name="type" type="hidden" value="avatar">
	          	<div class="card-body"> 
	              	<div class="form-group {{ $errors->has('image') ? ' is-invalid' : '' }}">
	               		<label for="max_entry_per_name">{{ __('competition.image') }}</label>
	               		<input type="file" id="image" name="image" accept=".jpeg,.jpg,.png,.svg"> 
	                     	@if ($errors->has('image'))
	                			<span class="error invalid-feedback">
	                  			<strong>{{ $errors->first('image') }}</strong>
	         					</span>
	     					@endif
	                </div>  
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary pull-left">{{ __('button.upload') }}</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
                    			
	            </div>
	            </form>      
              </div>
              <div class="modal-footer">
				Copyright &copy; 2018 <a href="https://adminlte.io">Ultimate Pet Championship</a></strong> 
				All right reserveds.
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>            
        <script>
  $(function () { 
    $('#tabledata').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,
      "responsive"  : true,
	  columnDefs: [
        { responsivePriority: 1, targets: 0 },
        { responsivePriority: 2, targets: 0 },
    ]
    });
  })
</script> 


@endsection

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
                    <a href="#modal-default-selectImage" data-toggle="modal"><img class="profile-user-img img-responsive img-circle" src="{{ Auth::user()->avatar() }}" alt="User profile picture"></a>
            </div>

            <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>

            <p class="text-muted text-center"></p>
            
            <ul class="list-group list-group-unbordered mb-3">
              <li class="list-group-item">
              </li>             
            </ul>
            <button type="submit" class="btn btn-primary btn-block" onclick="location.href = '{{ route('profile.edit',Auth::user()->id) }}';"><b>{{ __('button.update') }}</b></button>
          </div>
        </div>

            <!-- About Me Box -->
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">About Me</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <strong><i class="fa fa-map-marker margin-r-5"></i> {{ __('profile.location') }}</strong>

              <p class="text-muted">{{(Auth::user()->profile && Auth::user()->profile->origin ? Auth::user()->profile->origin->name.' ('. Auth::user()->profile->origin->country->name .')' : '-')}}</p> 
                <hr>
              </div>
              <!-- /.card-body -->
            </div>
      </div>


      <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#registrations" data-toggle="tab">Menu 1</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="registrations">
                    <!-- Post -->
                    <div class="card-header">
    	                <h3 class="card-title">Menu 1</h3>
		                </div>
                  </div>  
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
              <form method="POST" id="regForm" action="{{ route('profile.update' , Auth::user()->id) }}" enctype="multipart/form-data"> 
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

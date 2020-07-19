<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Tk Rahmania</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link href='//fonts.googleapis.com/css?family=Peralta' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="{{asset('css/style.css')}}">
  

<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>

  <script src="https://js.pusher.com/3.1/pusher.min.js"></script>
@guest
@else
<!--notification-->
<?php 
  $notifications =  NotificationHelper::getNewList(Auth::user()->id);
  $countNotification = $notifications->total();
?>
@endguest


</head>
<body class="hold-transition sidebar-mini sidebar-collapse">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand  navbar-dark navbar-success">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../../index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">About Us</a>
      </li>
    </ul>


    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->

      @guest           
        <li class="nav-item d-sm-inline-block">
        <a class="nav-link" href="{{ route('login') }}">{{__('login.sign_in')}}</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
        <a class="nav-link" href="{{ route('register') }}">{{ __('login.register') }}</a>
        </li>
      @else

      <!-- Notifications Dropdown Menu -->
      <li class="dropdown dropdown wrapper-notifications">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge notif-count">{{$countNotification>0?$countNotification:''}}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: -60px;">          
          <span class="dropdown-item dropdown-header"><span class="notif-count">{{$countNotification}}</span> Notifications</span>
          <span class="notif-data">
          @foreach ($notifications as $notification)
          <div class="dropdown-divider"></div>
          <a href="{{asset('profile/notification/show/'.$notification->id)}}" class="dropdown-item">
          <p class="text-sm"><?php echo NotificationHelper::show($notification->id)?><br></p>
          <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>({{$notification->timestamp()}})</p>
          </a>
          @endforeach            
          </span>
          <div class="dropdown-divider"></div>
          <a href="{{asset('profile/notification')}}" class="dropdown-item dropdown-footer">{{ __('main.view_all')}}</a>
        </div>
      </li>

      <li class="nav-item" style="width:42px;">
          <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle"><i class="fas fa-user"></i></a>
          <div class="dropdown-menu dropdown-menu-right">
            <div class="dropdown-divider"></div>
            <p class="dropdown-item"><img src="{{ Auth::user()->avatar() }}" class="img-circle elevation-2" width=20 heigt=20>&nbsp;{{ Auth::user()->name }}<br>
            </p>
            <a href="profile" class="dropdown-item">My Profie</a>
            <div class="dropdown-divider"></div>
            <a href="{{asset('changePassword')}}" class="dropdown-item">Change Password</a>
            <div class="dropdown-divider"></div>
            <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();"
                   {{ __('Logout') }}"><i class="fa fa-power-off"></i> <b>{{ __('label.logout') }}</b>
                   </a>
                   <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                   @csrf
                   </form>
          </a>
            
            </div>
        </li>
@endguest
      <!-- Language Dropdown Menu -->
      <li class="nav-item dropdown d-sm-inline-block">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-language fa-lg"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right p-0">
          <a href="{{route('lang', 'en')}}" class="dropdown-item active">
            <i class="flag-icon flag-icon-gb mr-2"></i> English
          </a>
          <a href="{{route('lang', 'id')}}" class="dropdown-item">
            <i class="flag-icon flag-icon-id mr-2"></i> Indonesian
          </a>
        </div>
      </li> 

    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-primary elevation-4 brand-logo-primary">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
      <img src="{{asset('dist/img/kb-tk-islam-rahmania_200x200.png')}}"
           alt="TK Rahmania"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">
      <span class="color">TK</span> <span class="color1">R</span><span class="color2">A</span><span class="color3">H</span><span class="color4">M</span><span class="color1">A</span><span class="color2">N</span><span class="color3">I</span><span class="color4">A</span>

      </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      @guest           
      @else        
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ Auth::user()->avatar() }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name}}</a>
        </div>
      </div>
      @endguest      

      <!-- Sidebar Menu -->
      @include('layouts.menu')
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1></h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
    @yield('content')    
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <b>Connect With Us:</b> <br>
    <a href="https://www.facebook.com/flare.pets.3" class="text-gray" target="_blank">
    <i class="fab fa-facebook fa-2x" style="color:#3b5998"></i>
    </a>
    <a href="https://twitter.com/FlarePet" class="text-gray" target="_blank">
    <i class="fab fa-twitter fa-2x" style="color:#00acee"></i>
    </a>
    <a href="https://www.youtube.com/channel/UC5So6V7x7569VPsJzNUqzPg?app=desktop" class="text-gray" target="_blank">
    <i class="fab fa-youtube fa-2x" style="color:red"></i>
    </a>
    <a href="https://www.instagram.com/explore/locations/661799096/tk-rahmania-ragunan/?hl=en" class="text-gray" target="_blank">
    <i class="fab fa-instagram fa-2x" style="color:#E1306C"></i>
    </a>    
    <br>

<a href="{{asset('about')}}" class="text-gray">About Us</a>&nbsp;|&nbsp;
<a href="{{asset('help')}}" class="text-gray">Help</a>&nbsp;|&nbsp;
<a href="{{asset('view/privacypolicy')}}" class="text-gray">Privacy Policy</a><br>
<strong>Copyright &copy; 2020 <a href="http://www.flare.pet">TK Rahmania</a></strong> All rights
    reserved.
  </footer>


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->



@guest
@else
<script type="text/javascript">  

  var notificationsCount     = {{$countNotification}};
  var notificationsWrapper   = $('.wrapper-notifications');
  var notifications          = notificationsWrapper.find('.notif-data'); 

  var pusher = new Pusher('{{env('PUSHER_APP_KEY')}}', {
  cluster: '{{env('PUSHER_APP_CLUSTER')}}',
  encrypted: true
  });

  // Subscribe to the channel we specified in our Laravel Event
  var channel = pusher.subscribe('notification-channel-{{(Auth::user()->id)}}');

  // Bind a function to a Event (the full Laravel class)
  channel.bind('App\\Events\\NotificationEvent', function(data) {
    var existingNotifications = notifications.html();
    var newNotificationHtml = `
          <div class="dropdown-divider"></div>
          <a href="{{asset('profile/notification/show')}}/`+data.id+`" class="dropdown-item">
          <p class="text-sm">`+data.message+`<br></p>
          <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>`+data.timestamp+`</p>
          </a>
    `;
    
    notifications.html(newNotificationHtml + existingNotifications);
    console.log(notifications.html());
    notifications.show();
    notificationsCount += 1;
    notificationsWrapper.find('.notif-count').text(notificationsCount);
    notificationsWrapper.show();
    $(document).Toasts('create', {
        title: data.timestamp,
        autohide: true,
        delay: 6000,
        body: data.message
      })

  });
</script>
@endguest



</body>
</html>

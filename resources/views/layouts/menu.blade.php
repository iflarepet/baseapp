      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

@php
		$url = Request::path(); 
		$role_id = '4';
		if (Auth::user() && count(Auth::user()->roles)>0) {
			$role_id =  Auth::user()->roles[0]['id'];		
		} 
		echo showmenu($role_id, null, $url);
@endphp 
        
@guest           
@else          
		<li class="nav-item">
            <a href="{{ route('logout') }}"  onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();"
                   {{ __('Logout') }}"" class="nav-link">
              <i class="nav-icon fa fa-power-off"></i>
              <p>
                Logout
              </p>
            </a>
			<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
					@csrf
			</form>
		</li>

@endguest		
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
@php
function showmenu($role_id, $parent=null, $url) {

$list = null;

if ($role_id=='1') {
	if ($parent==null) { 
		$list = DB::table('menus')
			->where('is_Active', 'Y')
			->whereNull('menus.deleted_at')      	
			->whereNull('parent_id') 
			->orderBy('order_number', 'asc')            
			->get();   
	} else { 
		$list = DB::table('menus')
			->where('is_Active', 'Y')
			->whereNull('menus.deleted_at')      	
			->where('parent_id', $parent) 
			->orderBy('order_number', 'asc')            
			->get();    
	}

} else {
	if ($parent==null) { 
		$list = DB::table('menus')
			->select('menus.*', 'menu_role.role_id')
			->Join('menu_role', 'menu_role.menu_id', '=', 'menus.id')
			->where('is_Active', 'Y')
			->whereNull('menu_role.deleted_at')      	
			->whereNull('menus.deleted_at')      	
			->whereNull('parent_id') 
			->where('role_id', $role_id)
			->orderBy('order_number', 'asc')            
			->get();   
	} else { 
		$list = DB::table('menus')
			->select('menus.*', 'menu_role.role_id')
			->Join('menu_role', 'menu_role.menu_id', '=', 'menus.id')
			->where('is_Active', 'Y')
			->whereNull('menu_role.deleted_at')      	
			->whereNull('menus.deleted_at')      	
			->where('parent_id', $parent) 
			->where('role_id', $role_id)
			->orderBy('order_number', 'asc')            
			->get();    
	}
}


$strMenu = "";
if ($parent && count($list)) {
		$strMenu .= '<ul class="nav nav-treeview">'; 
}
		  
foreach ($list as $m) { 
	$active = "";
	$isSubTreeActive = isSubTreeActive($role_id, $m->id, $url);
	if (strpos($url, $m->url) === 0) { 
		$active = "active";
	} else if ($isSubTreeActive) {
		$active = "active";
	} 
	
	if ($isSubTreeActive) {
		$strMenu .= '<li class="nav-item has-treeview menu-open">';				    		
	} else if ($m->url=='#') {
		$strMenu .= '<li class="nav-item has-tree">';				    		
	} else {
		$strMenu .= '<li class="nav-item">';
	}
	
	//$strMenu .= '<a href="' . asset($m->url) . '"><i class="nav-icon fa ' . ($m->icon_id? $m->icon_id : 'fa-circle-o') . '"></i><span>' . $m->name . '</span>';
	$strMenu .=  '<a href="' . asset($m->url) . '" class="nav-link '.$active.'">';
    $strMenu .=  '<i class="nav-icon' . ($m->icon_id? ' fa '. $m->icon_id : ' far '. 'fa-circle') . '"></i>';
    $strMenu .=  '<p>';
	$strMenu .=  $m->name;
    $strMenu .=  '</p>';
	$strMenu .=  '</a>';

	$strMenu .= showmenu($role_id, $m->id, $url);
	
	$strMenu .= '</li>';  
}
if ($parent && count($list)) {
		$strMenu .= '</ul>'; 
}
return $strMenu;
}

function isSubTreeActive($role_id, $parent=null, $url) {

$list = null;

if ($role_id=='1') {
	if ($parent==null) { 
		$list = DB::table('menus')
			->where('is_Active', 'Y')
			->whereNull('menus.deleted_at')      	
			->whereNull('parent_id') 
			->orderBy('order_number', 'asc')            
			->get();   
	} else { 
		$list = DB::table('menus')
			->where('is_Active', 'Y')
			->whereNull('menus.deleted_at')      	
			->where('parent_id', $parent) 
			->orderBy('order_number', 'asc')            
			->get();    
	}

} else {
	if ($parent==null) { 
		$list = DB::table('menus')
			->select('menus.*', 'menu_role.role_id')
			->Join('menu_role', 'menu_role.menu_id', '=', 'menus.id')
			->where('is_Active', 'Y')
			->whereNull('menu_role.deleted_at')      	
			->whereNull('menus.deleted_at')      	
			->whereNull('parent_id') 
			->where('role_id', $role_id)
			->orderBy('order_number', 'asc')            
			->get();   
	} else { 
		$list = DB::table('menus')
			->select('menus.*', 'menu_role.role_id')
			->Join('menu_role', 'menu_role.menu_id', '=', 'menus.id')
			->where('is_Active', 'Y')
			->whereNull('menu_role.deleted_at')      	
			->whereNull('menus.deleted_at')      	
			->where('parent_id', $parent) 
			->where('role_id', $role_id)
			->orderBy('order_number', 'asc')            
			->get();    
	}
}
foreach ($list as $m) { 

	if (strpos($url, $m->url) === 0) { 
		return true;
	} else {
		if (isSubTreeActive($role_id, $m->id, $url)) {
			return true;
		}
	}
}
return false;
}	  

 
@endphp 
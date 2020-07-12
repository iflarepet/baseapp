@extends('layouts.app')

@section('content') 
          <div class="card card-primary card-outline">
            <div class="card-header with-border">
              <h3 class="card-title">{{ __('rolemenu.maintenance') }}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="POST" action="{{ route('rolemenu.update', $id) }}">
			@csrf
			<input name="_method" type="hidden" value="PATCH"> 
              <div class="card-body">  
              	<div class="form-group">
				@php
					echo printmenu($id, null);
				@endphp 
                </div>             
              </div>  
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{ __('button.save') }}</button>    
                <button class="btn btn-primary" onclick="location.href = '{{ route('role.index') }}'">{{ __('button.back') }}</button>         
              </div>
            </form> 
          </div>

@php
function printmenu($role_id, $parent=null) {

	$list = null;
	if ($parent==null) { 
		$list = DB::table('menus')
			->select('menus.*', 'menu_role.role_id')
            ->leftJoin('menu_role', function($join) use ($role_id) {
				    $join->on('menu_role.menu_id', '=', 'menus.id') ->where('menu_role.role_id', '=', $role_id)
           			->whereNull('menu_role.deleted_at');      	
			})            
            ->where('is_Active', 'Y') 
            ->whereNull('menus.deleted_at')      	
            ->whereNull('parent_id')
            ->orderBy('id', 'asc')
            ->get();   
            
	} 
	
	else { 
		$list = DB::table('menus')
			->select('menus.*', 'menu_role.role_id')
            ->leftJoin('menu_role', function($join) use ($role_id) {
				    $join->on('menu_role.menu_id', '=', 'menus.id') ->where('menu_role.role_id', '=', $role_id)
				    ->whereNull('menu_role.deleted_at');      	
				    
			})            
            ->where('is_Active', 'Y') 
            ->whereNull('menu_role.deleted_at')      	
            ->whereNull('menus.deleted_at')      	
            ->where('parent_id', $parent)
            ->orderBy('id', 'asc')
            ->get();            	
 }
	
	if (count($list)) {	
		echo "<ul>";
		foreach ($list as $m) {
			echo '<li>' ;
			if ($m->role_id) 
				echo ' <input type="checkbox" checked name="menu[]" value="'. $m->id .'">';
			else 
				echo ' <input type="checkbox" name="menu[]" value="'. $m->id .'">';
			echo $m->name;
						
			printmenu($role_id, $m->id);
			echo '</li>';
		}
		echo "</ul>";
	}
}
@endphp 

@endsection

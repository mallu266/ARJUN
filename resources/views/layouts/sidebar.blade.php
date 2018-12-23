
<?php
$role_id = auth()->user()->myrole->role_id;
$permissioncontroller = new ARJUN\ADMIN\FUNCTIONS\ADMINSERVICE();
$segment = request()->segment(1);
$mymenus = $permissioncontroller->mypermissions($role_id);
?>
<div class="list-group">
    <a href="{{url('dashboard')}}" class="list-group-item list-group-item-action {{($segment=='dashboard')?'active':NULL}}">
        Dashboard
    </a>
    @foreach($mymenus as $menu)
    <?php $menu = $permissioncontroller->permission($menu->permission_id); ?>
    <a href="{{url($menu->slug.'/index')}}" class="list-group-item list-group-item-action {{($segment=='acl')?'active':NULL}}">{{$menu->name}}</a>
    @endforeach
</div>
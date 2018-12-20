
<?php
$segment = request()->segment(2);
$route = 'admin/';
?>
<div class="list-group">
    <a href="{{url($route.'dashboard')}}" class="list-group-item list-group-item-action {{($segment=='dashboard')?'active':NULL}}">
        Dashboard
    </a>
    <a href="{{url($route.'acl')}}" class="list-group-item list-group-item-action {{($segment=='acl')?'active':NULL}}">ACL (Roles and Permissions)</a>
    <a href="{{url($route.'users')}}" class="list-group-item list-group-item-action {{($segment=='users')?'active':NULL}}">User Management</a>
    <a href="{{url($route.'settings')}}" class="list-group-item list-group-item-action {{($segment=='settings')?'active':NULL}}">Settings</a>
    <a href="#" class="list-group-item list-group-item-action">Porta ac consectetur ac</a>
    <a href="#" class="list-group-item list-group-item-action disabled">Vestibulum at eros</a>
</div>
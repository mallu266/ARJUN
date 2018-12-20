<?php

namespace ARJUN\ADMIN\CONTROLLERS\ACL;

use ARJUN\ADMIN\MODELS\ACL\PERMISSIONS;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use ARJUN\ADMIN\MODELS\ACL\ROLES;

class PERMISSIONCONTROLLER extends Controller {

    protected $package;

    public function __construct() {
        $this->package = 'admin';
        // $this->ftpbase = Storage::disk('ftp');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id = '') {
        $data['roles'] = ROLES::all();
        $data['permission'] = PERMISSIONS::find($id);
        $data['permissions'] = PERMISSIONS::all();
        return view($this->package . '::acl/permissions/index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {
        $id = $request->id;
        if ($id) {
            $permission = PERMISSIONS::findOrFail($id);
        } else {
            $permission = new PERMISSIONS();
        }
        $role_ids = json_encode($request->role_ids);
        foreach ($request->all() as $key => $value) {
            if ($key != '_token' || $key = 'role_ids') {
                $permission->$key = $value;
            }
        }
        $permission->role_ids = $role_ids;
        if ($permission->save()) {
            $data['status'] = 'success';
            return back()->with($data);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Permissions  $permissions
     * @return \Illuminate\Http\Response
     */
    public function show(PERMISSIONS $permissions) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Permissions  $permissions
     * @return \Illuminate\Http\Response
     */
    public function edit(PERMISSIONS $permissions) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Permissions  $permissions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PERMISSIONS $permissions) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Permissions  $permissions
     * @return \Illuminate\Http\Response
     */
    public function destroy(PERMISSIONS $permissions) {
        //
    }

}

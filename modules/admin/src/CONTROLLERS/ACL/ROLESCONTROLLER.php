<?php

namespace ARJUN\ADMIN\CONTROLLERS\ACL;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ARJUN\ADMIN\MODELS\ACL\ROLES;

class ROLESCONTROLLER extends Controller {

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
        $data['role'] = ROLES::find($id);
        $data['roles'] = ROLES::all();
        return view($this->package . '::acl/roles/index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {
        $id = $request->id;
        if ($id) {
            $role = ROLES::findOrFail($id);
        } else {
            $role = new Roles();
        }

        foreach ($request->all() as $key => $value) {
            if ($key != '_token') {
                $role->$key = $value;
            }
        }
        if ($role->save()) {
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
     * @param  \App\Roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function show(ROLES $roles) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function edit(ROLES $roles) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Roles $roles) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function destroy(Roles $roles) {
        //
    }

}

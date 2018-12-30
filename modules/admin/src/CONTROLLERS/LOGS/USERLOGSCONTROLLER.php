<?php

namespace ARJUN\ADMIN\CONTROLLERS\LOGS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use ARJUN\ADMIN\TRAITS\LOGS\IPADDRESSDETAILS;
use ARJUN\ADMIN\TRAITS\LOGS\USERAGENTDETAILS;
use App\User;
use ARJUN\ADMIN\MODELS\LOGS\LOGGER;
use ARJUN\ADMIN\MODELS\ADMIN;

class USERLOGSCONTROLLER extends Controller {

    use IPADDRESSDETAILS,
        USERAGENTDETAILS;

    protected $package;

    public function __construct() {
        $this->package = 'admin';
    }

    public function index() {
        $data['resources'] = LOGGER::all();
        return view($this->package . '::logs.users')->with($data);
    }

    public function getDatatable(Request $request) {
        $records = LOGGER::
                select('methodType', 'description', 'userType', 'userId', 'route', 'ipAddress', 'referer', 'created_at', 'id')
                ;
        return $response = Datatables::of($records)
                ->editColumn('methodType', function ($records) {
                    return $records->methodType;
                })
                ->editColumn('id', function ($records) {
                    return "<a href='" . url('admin/logs/users/log/' . $records->id) . "' class='btn btn-xs btn-success'>View</a>";
                })
                ->make();
    }

    public function viewlog($id) {
        $data = array();
        if ($id) {
            $activity = LOGGER::findOrFail($id);
            if ($activity->guard == 'admin') {
                $userDetails = ADMIN::find($activity->userId);
                $guard = 'admin';
            } else {
                $guard = 'web';
                $userDetails = User::find($activity->userId);
            }

            $userAgentDetails = USERAGENTDETAILS::details($activity->useragent);
            $ipAddressDetails = IPADDRESSDETAILS::checkIP($activity->ipAddress);
//            $langDetails = UserAgentDetails::localeLang($activity->locale);
            $eventTime = Carbon::parse($activity->created_at);
            $timePassed = $eventTime->diffForHumans();
            $data = [
                'activity' => $activity,
                'userDetails' => $userDetails,
                'ipAddressDetails' => $ipAddressDetails,
                'timePassed' => $timePassed,
                'userAgentDetails' => $userAgentDetails,
                'guard' => $guard,
//                'langDetails' => $langDetails,
                'isClearedEntry' => false,
            ];
        }
        return view($this->package . '::logs.userlog')->with($data);
    }

}

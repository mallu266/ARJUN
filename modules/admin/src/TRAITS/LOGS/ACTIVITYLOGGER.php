<?php

namespace ARJUN\ADMIN\TRAITS\LOGS;

use Illuminate\Support\Facades\Auth;
use ARJUN\ADMIN\MODELS\LOGS\LOGGER;

trait ACTIVITYLOGGER {

    /**
     * Laravel Logger Log Activity.
     *
     * @param string $description
     *
     * @return void
     */
    public static function activity($guard) {
        $userType = 'Guest';
        $userId = null;
        if (Auth::guard('admin')->check() && $guard == 'admin') {
            $userType = 'Registered';
            $guard = 'admin';
            $userId = Auth::guard('admin')->user()->id;
        } else if (Auth::check() && $guard == 'web') {
            $guard = 'web';
            $userType = 'Registered';
            $userId = Auth::user()->id;
        }
        switch (strtolower(\Request::method())) {
            case 'post':
                $verb = "Posted";
                break;

            case 'patch':
            case 'put':
                $verb = "PUT and PATCH";
                break;

            case 'delete':
                $verb = "Deleted";
                break;

            case 'get':
            default:
                $verb = "Retrive";
                break;
        }
        $description = $verb . ' ' . \Request::path();
        $data = [
            'description' => $description,
            'userType' => $userType,
            'userId' => $userId,
            'guard' => $guard,
            'route' => \Request::fullUrl(),
            'ipAddress' => \Request::ip(),
            'userAgent' => \Request::header('user-agent'),
            'locale' => \Request::header('accept-language'),
            'referer' => \Request::header('referer'),
            'methodType' => \Request::method(),
        ];
        self::storeActivity($data);
    }

    /**
     * Store activity entry to database.
     *
     * @param array $data
     *
     * @return void
     */
    private static function storeActivity($data) {
        LOGGER::create([
            'description' => $data['description'],
            'userType' => $data['userType'],
            'guard' => $data['guard'],
            'userId' => $data['userId'],
            'route' => $data['route'],
            'ipAddress' => $data['ipAddress'],
            'userAgent' => $data['userAgent'],
            'locale' => $data['locale'],
            'referer' => $data['referer'],
            'methodType' => $data['methodType'],
        ]);
    }

}

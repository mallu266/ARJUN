<?php

namespace ARJUN\ADMIN\MODELS\LOGS;

use Illuminate\Database\Eloquent\Model;
use ARJUN\ADMIN\MODELS\USERS;
use Illuminate\Database\Eloquent\SoftDeletes;

class LOGGER extends Model {

    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $table = 'logger';
    protected $fillable = [
        'description',
        'userType',
        'guard',
        'userId',
        'route',
        'ipAddress',
        'userAgent',
        'locale',
        'referer',
        'methodType',
    ];
    protected $casts = [
        'description' => 'string',
        'user' => 'integer',
        'route' => 'url',
        'ipAddress' => 'ipAddress',
        'userAgent' => 'string',
        'locale' => 'string',
        'referer' => 'url',
        'methodType' => 'string',
    ];

    public function user() {
        return $this->hasOne(USERS::class);
    }

}

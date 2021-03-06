<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Indicates whether the XSRF-TOKEN cookie should be set on the response.
     *
     * @var bool
     */
    protected $addHttpCookie = true;

    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
        'http://*.*.*.*:8000/loginUser',
        'http://*.*.*.*:8000/registerUser',
        'http://*.*.*.*:8000/search',
        'http://*.*.*.*:8000/roomAvailable',
        'http://*.*.*.*:8000/hotelInfo',
        'http://*.*.*.*:8000/createBooking',
        'http://*.*.*.*:8000/confirmBookingDetail',
        'http://*.*.*.*:8000/userProfile',
    ];
}

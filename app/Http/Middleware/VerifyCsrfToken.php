<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
        '/ccavenue/request',
        '/ccavenue/response',
        // '/api/clients/store',
        // '/api/districts',
        // '/api/blocks',
        // '/api/villages'
        'api/*',
        'admin/uploadFile'
    ];
}

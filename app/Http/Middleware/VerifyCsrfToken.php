<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        // 允许csrf跳过的地址
        '/auth/register',
        '/user/insert',
        '/user/login',
        '/user/postFileupload',
    ];
}

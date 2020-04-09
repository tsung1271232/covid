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
        "/covid/patientProfile",
        "/covid/nextQuestion",
        "/covid/preQuestion",
        "/covid/new_startQuestion",
        "/covid/endQuestion",

        "/covid/patientProfile",
        "/covid/selfManage",

        "/insertQuestion",
        "/getQuestionContent",
        "/updateQuestion",
        "/deleteQuestion",
    ];
}

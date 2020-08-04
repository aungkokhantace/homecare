<?php

namespace App\Exceptions;

use App\Core\Check;
use App\Core\Utility;
use Exception;
use Illuminate\Support\Facades\Auth;
//use \Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use League\Flysystem\Util;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        if($e instanceof NotFoundHttpException)
        {
            if(Check::validSession()) {
                $role = Utility::getCurrentUser();
                if ($role == 1) {
                    return response()->view('core.error.pagenotfound', [], 404);
                } else {
                    return response()->view('core.error.pagenotfound_patient', [], 404);
                }
            }
            else{
                return redirect('login');
            }
        }
        return parent::render($request, $e);
    }
}

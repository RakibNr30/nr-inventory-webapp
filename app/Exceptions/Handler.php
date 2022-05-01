<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Throwable $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws Throwable
     */
    public function render($request, Throwable $exception)
    {
        /*if ($this->isHttpException($exception)) {
            $status_code = $exception->getStatusCode();
            if ($status_code == 404) {
                $status = "Oops! page not found!";
                $message = "The page you are looking for does not exist. It might have been moved or deleted. Please go back to home.";
                return response()->view('errors.404', [
                    'status_code' => $status_code,
                    'status' => $status,
                    'message' => $message
                ]);
            } else if ($status_code == 500) {
                $status = "Oops! internal server error!";
                $message = "Something has gone wrong on the web site's server but the server could not be more specific on what the exact problem is.";
                return response()->view('errors.500', [
                    'status_code' => $status_code,
                    'status' => $status,
                    'message' => $message
                ]);
            } else if ($status_code == 405) {
                $status = "Oops! Method Not Allowed!";
                $message = "The GET method is not supported for this route. Supported method is POST.";
                return response()->view('errors.405', [
                    'status_code' => $status_code,
                    'status' => $status,
                    'message' => $message
                ]);
            }
            else {
                $status = "Oops! Server Error!";
                $message = "The server failed to fulfil an apparently valid request.";
                return response()->view('errors.503', [
                    'status_code' => $status_code,
                    'status' => $status,
                    'message' => $message
                ]);
            }
        }*/

        return parent::render($request, $exception);
    }

}

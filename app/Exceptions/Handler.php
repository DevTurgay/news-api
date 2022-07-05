<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed
     * to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        //
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        /**
         * Customize error
         *
         * @param \Symfony\Component\HttpKernel\Exception\NotFoundHttpException $e
         *
         * @return \Illuminate\Http\Response
         */
        $this->renderable(
            function (NotFoundHttpException $e) {
                return response(
                    [
                        'status' => [
                            'code' => Response::HTTP_NOT_FOUND,
                            'messages' => Response::$statusTexts[Response::HTTP_NOT_FOUND]
                        ]
                    ],
                    Response::HTTP_NOT_FOUND
                );
            }
        );


        /**
         * Customize error
         *
         * @param \Illuminate\Validation\ValidationException $e
         *
         * @return \Illuminate\Http\Response
         */
        $this->renderable(
            function (ValidationException $e) {
                return response(
                    [
                        'status' => [
                            'code' => Response::HTTP_UNPROCESSABLE_ENTITY,
                            'messages' => $e->validator->errors()
                        ]
                    ],
                    Response::HTTP_UNPROCESSABLE_ENTITY
                );
            }
        );

        /**
         * Customize error
         *
         * @param \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException $e
         *
         * @return \Illuminate\Http\Response
         */
        $this->renderable(
            function (MethodNotAllowedHttpException $e) {
                return response(
                    [
                        'status' => [
                            'code' => Response::HTTP_METHOD_NOT_ALLOWED,
                            'messages' => Response::$statusTexts[Response::HTTP_METHOD_NOT_ALLOWED]
                        ]
                    ],
                    Response::HTTP_METHOD_NOT_ALLOWED
                );
            }
        );
    }
}

<?php namespace cms\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class Handler
 * @package cms\Exceptions
 */
class Handler extends ExceptionHandler
{
	private $requested_uri = null;

	/**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
		if (
			class_exists(\Sentry\SentryLaravel\SentryFacade::class)
			&& !is_null(config('sentry.dsn'))
			&& $this->shouldReport($exception)
		) {
			app('sentry')->captureException($exception);
		}
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
		$this->requested_uri = $request->getRequestUri();

		return parent::render($request, $exception);
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
		$this->requested_uri = $request->getRequestUri();

        if ($request->expectsJson())
        {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

		if (!strncmp($this->requested_uri, '/backend', strlen('/backend')))
		{
			return redirect()->guest('backend/login');
		}

        return redirect()->guest('login');
    }

	/**
	 * Render the given HttpException.
	 *
	 * @param HttpException $e
	 *
	 * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
	 */
	protected function renderHttpException(HttpException $e)
	{
		$status = $e->getStatusCode();
		$view = "errors.{$status}";

		if (cmsview($view))
		{
			return response()
				->view(
					cmsview_prefix($view) . $view,
					[
						'exception' => $e
					],
					$status,
					$e->getHeaders()
				);
		}
		else
		{
			return $this->convertExceptionToResponse($e);
		}
	}
}

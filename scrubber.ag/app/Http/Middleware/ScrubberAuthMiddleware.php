<?php

namespace App\Http\Middleware;

use App\Models\ScrubberHeader;
use App\Library\ScrubberTokenLib;
use App\Library\ScrubberRequestLib;
use App\Helpers\ScrubberInit;

use Closure;

class ScrubberAuthMiddleware
{

    public function __construct(\App\Library\ScrubberHeaderLib $headerLib) {
        app()->instance('objHeaderLib', $headerLib);
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        app()->instance('objInit', new ScrubberInit($request));
        app()->instance('objTokenLib', new ScrubberTokenLib($request));
        app()->instance('objRequestLib', new ScrubberRequestLib($request));

        if (app()['objTokenLib']->active == 0 || app()['objTokenLib']->enabled == 0) {
            //return redirect('/');
            die('Forbidden');
        }

        $this->store();

        return $next($request);
    }

    public function store() {
        $scrubberHeader = new ScrubberHeader();

        $scrubberHeader->token_id = app()['objTokenLib']->id;
        $scrubberHeader->token = app()['objTokenLib']->token;
        $scrubberHeader->description = 'api request';
        $scrubberHeader->request = app()['objRequestLib']->ToString();

        $scrubberHeader->save();
        app()['objHeaderLib']->id = $scrubberHeader->id;
    }

}

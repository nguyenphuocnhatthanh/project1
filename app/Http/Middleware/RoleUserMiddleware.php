<?php namespace App\Http\Middleware;

use Closure;

class RoleUserMiddleware {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
        $role = $this->getRequestRoleForRoute($request->route());

        if($request->user()->hasRole($role) || !$role)
		    return $next($request);
        return redirect('/');
	}

    /**
     * @param $route
     * @return bool
     */
    private function getRequestRoleForRoute($route)
    {
        return isset($route->getAction()['roles']) ? $route->getAction()['roles'] : false;
    }

}

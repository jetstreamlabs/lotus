<?php

namespace Serenity\Lotus\Middleware;

use Closure;

class MuteActions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $action = $request->route()->getAction();

        if (isset($action['controller'])) {
            $class = get_class($request->route()->getController());

            if (! $name = $this->mute($class)) {
                return $next($request);
            }

            throw new \BadMethodCallException(sprintf(
                'Method %s is not allowed in an Action class. See config.routing.allowed for more info.', $name
            ));
        }

        return $next($request);
    }

    /**
     * Create a new reflection and check for modifiers.
     *
     * @param  string $class
     * @return string|bool
     */
    private function mute($class)
    {
        $instance = new \ReflectionClass($class);

        foreach ($instance->getMethods() as $method) {
            if ($method->isPublic() || $method->isProtected()) {

                $name = $method->getName();

                if (! $this->isAllowed($name)) {
                    return $name;
                }
            }
        }

        return false;
    }

    /**
     * Pass all our methods through and check if allowed.
     *
     * @param  string  $method
     * @return boolean
     */
    private function isAllowed($method)
    {
        if (in_array($method, config('lotus.allowed.actions'))) {
            return true;
        }

        return false;
    }
}

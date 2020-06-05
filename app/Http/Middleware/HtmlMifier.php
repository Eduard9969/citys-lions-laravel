<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

/**
 * Class HtmlMifier
 * @package App\Http\Middleware
 */
class HtmlMifier
{

    /**
     * Handle
     *
     * @param $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $response = $next($request);

        $contentType = $response->headers->get('Content-Type');
        if (strpos($contentType, 'text/html') !== false) {
            $response->setContent($this->minify($response->getContent()));
        }

        return $response;

    }

    /**
     * Minify
     *
     * @param $input
     * @return string|string[]|null
     */
    public function minify($input)
    {
        return preg_replace([ '/\>\s+/s', '/\s+</s', ], [ '> ', ' <', ], $input);
    }
}

<?php

namespace Pff\ServiceProvider\AcceptHeaderServiceProvider;

use Silex\Route as SilexRoute;

class Route extends SilexRoute
{
    public function accept($content_types)
    {
        $content_regexps = array_map(function($item) { return preg_quote($item, '/'); }, $content_types);

        $this->setRequirement('_accept', implode('|', $content_regexps));
    }
}

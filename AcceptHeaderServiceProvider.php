<?php

namespace Pff\ServiceProvider\AcceptHeaderServiceProvider;

use Silex\Application;
use Silex\ServiceProviderInterface;

class AcceptHeaderServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        $app['route_class'] = '\\Pff\\ServiceProvider\\AcceptHeaderServiceProvider\\Route';

        $app['dispatcher']->addSubscriber(new KernelListener());

        $app['url_matcher'] = $app->share(function () use ($app) {
            return new UrlMatcher($app['routes'], $app['request_context'], $app['request']);
        });
    }

    public function boot(Application $app)
    {
    }
}

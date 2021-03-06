# Accept Header Service Provider

[![Build Status](https://secure.travis-ci.org/Point5Foundry/accept-header-service-provider.png)](http://travis-ci.org/Point5Foundry/accept-header-service-provider)

This serivce provider enables you to easily filter routes based on accept headers in Silex.

To install, require the package through composer (or install it any other way you care to...)

    "pff/accept-header-service-provider": "dev-master"

To use it, simply do the following:

```php
    <?php

    use Pff\ServiceProvider\AcceptHeaderServiceProvider\AcceptHeaderServiceProvider;
    
    $app->register(new AcceptHeaderServiceProvider());

    $app->get('/test', function($accept_header) {
        if ($accept_header == 'application/ven.test.v1+json')
            $cont = json_encode(array('content' => 'hello'));
        else
            $cont = '<content>hello</content>';

        return new Response($cont, 200, array('Content-Type' => $accept_header));
    })->accept(array('application/ven.test.v1+json', 'application/ven.test.v1+xml'));
  

    $app->get('/test', function($accept_header) {
        if ($accept_header == 'application/ven.test.v2+json')
            $cont = json_encode(array('content' => 'hiya'));
        else
            $cont = '<content>hiya</content>';

        return new Response($cont, 200, array('Content-Type' => $accept_header));
    })->accept(array('application/ven.test.v2+json', 'application/ven.test.v2+xml'));
```

Now a request with accept headers including `application/ven.test.v1+json` and `application/ven.test.v1+xml`
will be handled by the first route, and requests with accept headers including `application/ven.test.v2+json` and
`application/ven.test.v2+xml` will be routed to the second.


<?php

declare(strict_types=1);

use Api\Http\Action;
use Api\Http\Middleware;
use Psr\Container\ContainerInterface;
use Slim\Routing\RouteCollectorProxy;
use Slim\App;

return function (App $app, ContainerInterface $container) {

    $app->addRoutingMiddleware();

    $app->add(Middleware\DomainExceptionMiddleware::class);
    $app->add(Middleware\ValidationExceptionMiddleware::class);
    $app->addBodyParsingMiddleware();

    // $errorMiddleware = $app->addErrorMiddleware(true, true, true);
    $settings = $container->get('settings');
    $app->addErrorMiddleware(
        $settings['displayErrorDetails'],
        $settings['logErrors'],
        $settings['logErrorDetails']
    );

    $app->get('/', Action\HomeAction::class . ':handle');

    $app->post('/auth/signup', Action\Auth\SignUp\RequestAction::class . ':handle');
    $app->post('/auth/signup/confirm', Action\Auth\SignUp\ConfirmAction::class . ':handle');

    $app->post('/oauth/auth', Action\Auth\OAuthAction::class . ':handle');

    $app->group('/profile', function (RouteCollectorProxy $group) {
        $group->get('', Action\Profile\ShowAction::class . ':handle');
    })->add(Middleware\AuthenticateMiddleware::class);

};
<?php

declare(strict_types=1);

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

require_once __DIR__ . '/../vendor/autoload.php';

$request = new Request();
$request = request::createFromGlobals();
$response = new Response();
$controllerresolver = new ControllerResolver();
$argumentresolver = new ArgumentResolver();
$context = new RequestContext();
$context->fromRequest($request);
$pathinfo = $request->getPathInfo();

$routes = new RouteCollection();

$routes->add('accueil', new Route(
    '/',
    [
        '_controller' => 'App\controllers\Control::accueil'

    ]
));

$routes->add('inscription', new Route(
    '/inscription',
    [
        '_controller' => 'App\controllers\Control::inscription'

    ]
));

$routes->add('connexion', new Route(
    '/connexion',
    [
        '_controller' => 'App\controllers\Control::connexion'

    ]
));

$routes->add('deconnexion', new Route(
    '/deconnexion',
    [
        '_controller' => 'App\controllers\Control::deconnexion'

    ]
));

$routes->add('presentation', new Route(
    '/presentation',
    [
        '_controller' => 'App\controllers\Control::presentation'
    ]
));


$routes->add('articles', new Route(
    '/articles',
    [
        '_controller' => 'App\controllers\Control::articles'

    ]
));


$routes->add('article', new Route(
    '/article',
    [
        '_controller' => 'App\controllers\Control::article'

    ]
));

$routes->add('contact', new Route(
    '/contact',
    [
        '_controller' => 'App\controllers\Control::contact'

    ]
));


$routes->add('postuler', new Route(
    '/postuler',
    [
        '_controller' => 'App\controllers\Control::postuler'

    ]
));


$routes->add('admin_formulaire', new Route(
    '/admin/formulaire/admin/p',
    [
        '_controller' => 'App\controllers\Control::adminformulaire'

    ]
));

$routes->add('admin', new Route(
    '/admin/admin/p',
    [
        '_controller' => 'App\controllers\Control::admin'

    ]
));

$routes->add('editer', new Route(
    '/editer',
    [
        '_controller' => 'App\controllers\Control::editer'

    ]
));

$routes->add('delete', new Route(
    '/delete',
    [
        '_controller' => 'App\controllers\Control::delete'

    ]
));


$urlmatcher = new UrlMatcher($routes, $context);

try {
    $resultat = $urlmatcher->match($pathinfo);
    $request->attributes->add($resultat);
    $controller = $controllerresolver->getController($request);
    $arguments = $argumentresolver->getArguments($request, $controller);
    call_user_func_array($controller, $arguments);
} catch (Exception $e) {
    $response->setContent('Aucune page correspondante');
    $response->send();
}

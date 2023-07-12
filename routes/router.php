<?php

$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];
$routes = (require '../routes/routes.php')[$requestMethod];

$basePath = str_replace('/index.php', '', $_SERVER['PHP_SELF']);
if ($basePath !== '' && str_starts_with($requestUri, $basePath)) {
    $requestUri = substr($requestUri, strlen($basePath));
}
$route = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '', '/');

if (array_key_exists($route, $routes)) {
    $matchedRoute = $routes[$route];
    [$controllerName, $methodName] = $matchedRoute;
    $routeParameterNames = $matchedRoute[2] ?? [];
    $controller = isset($entityManager)
        ? new ('App\\Controllers\\' . $controllerName)($entityManager)
        : new $controllerName();
    $validParams = [];
    foreach ($routeParameterNames as $routeParamName) {
        if (isset($_GET[$routeParamName])) {
            $validParams[] = $_GET[$routeParamName];
        }
    }
    $controller->$methodName(...$validParams);
} else {
    echo '404 - Page Not Found';
}

<?php
/**
* charts.php
* Description: Chart Display Page (This was never implemented)
* Author: Daniel O'Hara
* Email: <p2435725@my365.dmu.ac.uk>
* Updated: 16/01/2021
**/

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->get('/charts', function(Request $request, Response $response)
{
    return $this->view->render($response,
        'charts.html.twig',
        [
            'document_title' => "Telemetry Data",
            'css_path' => CSS_PATH,
        ]);
})->setName('charts');
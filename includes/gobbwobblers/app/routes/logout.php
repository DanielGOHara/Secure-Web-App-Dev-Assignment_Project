<?php
/**
* logout.php
* Description: A logout script page
* Author: Lewis Harris
* Email: <p2419279@my365.dmu.ac.uk>
* Updated: 16/01/2021
**/

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->any('/logout', function(Request $request, Response $response)
{
	
	//declare var
	$userData;
	//get the user info from their key (if db+session keypair exists)
	$keypairAuth = new Gobbwobblers\KeyAuth();
	if ($keypairAuth->exists()) {$userData = $keypairAuth->getUserData();}
	
	//unset session
	$session = new Gobbwobblers\SessionWrapper();
	$session->unsetSession("login_key");
	
	//log the message to the database + logger
	if (isset($userData)) {
		$logMessage = date('m/d/Y h:i:s a', time()) . " :NOTICE: Logout, User: " . $userData['username'] . " logged out";
		$log = new Gobbwobblers\Monologging();
		$log->log("notice", $logMessage);
		//make new connection to insert logs
		$conn = new Gobbwobblers\DatabaseWrapper();
		$conn->setProcedure("addLog");
		$conn->setArguments(["message"=>$logMessage]);
		$conn->execute();
	}
	
    return $this->view->render($response,
        'logout.html.twig',
		[
			'document_title' => "Gobbwobblers Logout",
			'css_path' => CSS_PATH,
            'title' => "Logout",
			'author' => "Group: Gobbwobblers"
        ]);
		
})->setName('logout');
<?php
/**
* Name: Monologging
* Description: Logs all information passed into it
* Notices: General log for all other needs
* Alerts: Incorrect log in information attempted
* Info: Correct log in information, log in recorded
* Errors: Issues with an incorrect logType passed
* Author: Daniel O'Hara @ P2435725
**/

namespace Gobbwobblers;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class Monologging
{
	function __construct() {}
	
	function __destruct() {}
	
    public function log($logType, $error)
	{
        $logger = new Logger('logger');
        if ($logType == 'notice') {
            $log_notices = LOG_FILE_PATH . 'notices.log';
            $stream_notices = new StreamHandler($log_notices, Logger::NOTICE);
            $logger->pushHandler($stream_notices);
            $logger->notice($error);
        } elseif ($logType == 'alert') {
            $log_alerts = LOG_FILE_PATH . 'alerts.log';
            $stream_alerts = new StreamHandler($log_alerts, Logger::ALERT);
            $logger->pushHandler($stream_alerts);
            $logger->alert($error);
        } elseif ($logType == 'info') {
            $log_info = LOG_FILE_PATH . 'info.log';
            $stream_info = new StreamHandler($log_info, Logger::INFO);
            $logger->pushHandler($stream_info);
            $logger->info($error);
        } else {
            $log_error = LOG_FILE_PATH . 'errors.log';
            $stream_notices = new StreamHandler($log_error, Logger::NOTICE);
            $logger->pushHandler($stream_notices);
            $logger->error('Error logType Mismatch, ' . $logType . ' was Entered!');
        }
    }
}
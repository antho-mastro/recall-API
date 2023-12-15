<?php

namespace Vanier\Api\Helpers;

use DateTimeZone;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class AppLogHelper
{
    private $logger = null;
    private $db_logger = null;
    public function __construct()
    {
        $this->initLoggers();
    }

    public function initLoggers()
    {
        $this->logger = new Logger("nobel_prize_log");
        $this->logger->setTimezone(new DateTimeZone('America/Toronto'));
        $log_handler = new StreamHandler(APP_LOG_DIR, Logger::DEBUG);
        $this->logger->pushHandler($log_handler);
        $this->db_logger = new Logger("database_logs");
        $this->db_logger->pushHandler($log_handler);
    }

    public function getAppLogger()
    {
        return $this->logger;
    }

    public function getDatabaseLogger()
    {
        return $this->db_logger;
    }
}
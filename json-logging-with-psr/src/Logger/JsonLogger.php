<?php
/**
 * Created by PhpStorm.
 * User: Arslan
 * Date: 20.05.2018
 * Time: 14:38
 */

namespace logger;

use models\DataModel;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

class JsonLogger implements LoggerInterface
{
    private $file;
    private $filename = "data.json";
    /**
     * JsonLogger constructor.
     */
    public function __construct()
    {
        if (file_exists($this->filename)) {
           file_put_contents($this->filename, "");
        }
        $this->file = fopen($this->filename, "r+") or die("Error occurred while creating file");
        fwrite($this->file, "[");
    }

    /**
     * JsonLogger destructor.
     */
    public function __destruct()
    {
        $stat = fstat($this->file);
        ftruncate($this->file, $stat['size'] - 1);
        rewind($this->file);
        fseek($this->file, 0, SEEK_END);

        fwrite($this->file, "]");
        fclose($this->file);
    }

    /**
     * System is unusable.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function emergency($message, array $context = array())
    {
        $this->logIt(LogLevel::EMERGENCY, $message, $context);
    }

    /**
     * Action must be taken immediately.
     *
     * Example: Entire website down, database unavailable, etc. This should
     * trigger the SMS alerts and wake you up.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function alert($message, array $context = array())
    {
        $this->logIt(LogLevel::ALERT, $message, $context);
    }

    /**
     * Critical conditions.
     *
     * Example: Application component unavailable, unexpected exception.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function critical($message, array $context = array())
    {
        $this->logIt(LogLevel::CRITICAL, $message, $context);
    }

    /**
     * Runtime errors that do not require immediate action but should typically
     * be logged and monitored.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function error($message, array $context = array())
    {
        $this->logIt(LogLevel::ERROR, $message, $context);
    }

    /**
     * Exceptional occurrences that are not errors.
     *
     * Example: Use of deprecated APIs, poor use of an API, undesirable things
     * that are not necessarily wrong.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function warning($message, array $context = array())
    {
        $this->logIt(LogLevel::WARNING, $message, $context);
    }

    /**
     * Normal but significant events.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function notice($message, array $context = array())
    {
        $this->logIt(LogLevel::NOTICE, $message, $context);
    }

    /**
     * Interesting events.
     *
     * Example: User logs in, SQL logs.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function info($message, array $context = array())
    {
        $this->logIt(LogLevel::INFO, $message, $context);
    }

    /**
     * Detailed debug information.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function debug($message, array $context = array())
    {
        $this->logIt(LogLevel::DEBUG, $message, $context);
    }

    /**
     * Logs with an arbitrary level.
     *
     * @param mixed $level
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function log($level, $message, array $context = array())
    {
        $this->logIt($level, $message, $context);
    }

    private function logIt($level, $message, array $context = array()) {
        if (!empty($context)) {
            $message = $this->fillInfoIntoPlaceholders($message, $context);
        }

        $data = json_encode(new DataModel($level, date("d.m.y H:i:s"), $message)) . ",";
        fwrite($this->file, $data);
    }

    private function fillInfoIntoPlaceholders($message, array $context = array()) : string {
        $replaceValue = [];

        foreach ($context as $key => $value) {
            $newKey = "{" . $key . "}";
            $replaceValue[$newKey] = $value;
        }

        $result = strtr($message, $replaceValue);

        return $result;
    }
}
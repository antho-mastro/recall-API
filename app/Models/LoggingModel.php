<?php
namespace Vanier\Api\Models;
use Vanier\Api\Models\BaseModel;

use DateTime;
use DateTimeZone;

/**
 * A class that is used for logging user actions.
 *
 * @author Sleiman Rabah
 */
class LoggingModel extends BaseModel {

    private $table_name = "logging";

    function __construct() {
        parent::__construct();
    }

    /**
     * Adds to the database an entry about a user's action
     * For example, what resource has been invoked, by whom and at what date and time...
     *
     * @param array $log_data The data to be logged in the DB.
     * @return array
     */
    public function logUserAction($jwt_payload, $uer_action) {
        $log_data["user_id"] = $jwt_payload["id"];
        $log_data["email"] = $jwt_payload["email"];
        $log_data["user_action"] = $uer_action;
        $log_data["logged_at"] = $this->getCurrentDateAndTime();
        return $this->insert($this->table_name, $log_data);
    }

    /**
     * Gets the current date and time give the provided time zone.
     *
     * For more information about the supported time zones,
     * @see: https://www.php.net/manual/en/timezones.america.php
     *
     * @return string
     */
    private function getCurrentDateAndTime() {
        $tz_object = new DateTimeZone('America/Toronto');
        $datetime = new DateTime();
        $datetime->setTimezone($tz_object);
        return $datetime->format('Y\-m\-d\ h:i:s');
    }

}
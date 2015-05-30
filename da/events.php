<?php

require_once "../db/dbConnection.php";

class Da_Events {

  public function getSchedules($limit=5) {
    $sql = 'SELECT
              id, time_schedules
            FROM masaze_schedules
            ORDER BY time_schedules
            LIMIT ' . $limit;

    $dbConn = new dbConnection();
    $execution = $dbConn->getInstance()->executeQuery($sql);

    return $execution;
  }

}

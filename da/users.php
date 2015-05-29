<?php

require_once "../db/dbConnection.php";

class Da_Users {

  public function getCandidateUsers() {
    $sql = 'SELECT
              u.id, u.email, u.score, u.last_update, a.elegible
            FROM masaze_appointments a
            INNER JOIN masaze_users u ON u.id = a.user_id
            ORDER BY u.score DESC;';

    $dbConn = new dbConnection();
    $execution = $dbConn->getInstance()->executeQuery($sql);

    return $execution;
  }

  public function updateScore($userId, $increment=0) {
    $sql = 'UPDATE masaze_users
              SET score = score + '. $increment .
           ' WHERE id = ' . $userId;

    $dbConn = new dbConnection();
    $execution = $dbConn->getInstance()->executeQueryInsert($sql);

  }

  public function updateAppoimentElegible($userId, $value=0) {
    $sql = 'UPDATE masaze_appointments
              SET elegible = '. $value .
           ' WHERE user_id = ' . $userId;

    $dbConn = new dbConnection();
    $execution = $dbConn->getInstance()->executeQueryInsert($sql);
  }
}

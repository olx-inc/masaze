<?php

require_once "../da/users.php";

class Models_User {

  var $daUser = NULL;

  function __construct() {
    $this->daUser = new Da_Users();
  }

  public function getCandidateUsers() {
    return $this->daUser->getCandidateUsers();
  }

  public function updateScore($userId, $increment=0) {
    $this->daUser->updateScore($userId, $increment);
  }

  public function updateAppoimentElegible($userId, $scheduleId) {
    $this->daUser->updateAppoimentElegible($userId, $scheduleId);
  }
}

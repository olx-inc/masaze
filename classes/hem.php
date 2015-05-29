<?php

require_once "../models/users.php";

class ClassHEM
{

  var $userModel = NULL;

  function __construct() {
    $this->userModel = new Models_User();
  }

  public function selectCandidates($appoimentCount=11) {
    $assignees = array();
    $candidates = $this->userModel->getCandidateUsers();

    $i = 0;
    while ($i < $appoimentCount) {
      $assignees[] = $candidates[$i];
      unset($candidates[$i]);
      $i++;
    }

    // Update candiates
    $this->updateAssignees($assignees);

    // Update candiates
    $this->updateDiscarded($candidates);
  }

  private function updateAssignees($assignees=array()) {
    // masaze_users.score - 1
    // masaze_appointments.elegible = 1;
    $value = 1;
    foreach ($assignees as $assignee) {
      $userId = $assignee["id"];
      $this->userModel->updateScore($userId, -1);
      $this->userModel->updateAppoimentElegible($userId, $value);
    }

  }

  private function updateDiscarded($candidates=array()) {
    // masaze_users.score + 1
    // masaze_appointments.elegible = 0;
    $value = 0;
    foreach ($candidates as $candidate) {
      $userId = $assignee["id"];
      $this->userModel->updateScore($userId, 1);
      $this->userModel->updateAppoimentElegible($userId, $value);
    }

  }

}


/*
    echo "<pre>";
    print_r($candidates);
    echo "</pre>";
  */
/*


    while ($i < $appoimentCount) {
      $randNum = rand (0,  count($list) - 1);
      if (empty($assignees[$randNum])) {
        $assignees[$randNum] = $list[$randNum];
        $i++;
      }
    }
*/

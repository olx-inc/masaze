<?php

require_once "../models/users.php";
require_once "../models/events.php";

class ClassHEM
{
  var $userModel = NULL;
  var $eventModel = NULL;

  function __construct() {
    $this->userModel = new Models_User();
    $this->eventModel = new Models_Events();
  }

  public function selectCandidates($appoimentCount=11) {
    $assignees = array();
    $candidates = $this->userModel->getCandidateUsers();

    $i = 0;

    $items = min($appoimentCount, count($candidates));

    if ( ! empty($candidates)) {
      while ($i < $items) {
        $assignees[] = $candidates[$i];
        unset($candidates[$i]);
        $i++;
      }
    }


    echo "<pre>";
    print_r($assignees);
    echo "</pre>";

    echo "<pre>";
    print_r($candidates);
    echo "</pre>";

    // Update candiates
    if ( ! empty($assignees)) {
      $this->updateAssignees($assignees);
    }

    // Update candiates
    if ( ! empty($candidates)) {
      $this->updateDiscarded($candidates);
    }
  }

  private function updateAssignees($assignees=array()) {
    // masaze_users.score - 1
    // masaze_appointments.elegible = 1;
    $schedules = $this->eventModel->getSchedules(count($assignees));

    $minValue = (count($schedules) < count($assignees)) ? count($schedules) : count($assignees);

    $i = 0;
    while ($i < $minValue) {
      $assignee = $assignees[$i];
      $schedule = $schedules[$i];

      $userId = $assignee["id"];
      $scheduleId = $schedule["id"];

      $this->userModel->updateScore($userId, -1);
      $this->userModel->updateAppoimentElegible($userId, $scheduleId);
      $i++;
    }

    /*
    foreach ($assignees as $assignee) {
      $userId = $assignee["id"];
      $this->userModel->updateScore($userId, -1);
      $this->userModel->updateAppoimentElegible($userId, 1);
    }
    */

  }

  private function updateDiscarded($candidates=array()) {
    // masaze_users.score + 1
    // masaze_appointments.elegible = 0;
    foreach ($candidates as $candidate) {
      $userId = $candidate["id"];
      $this->userModel->updateScore($userId, 1);
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

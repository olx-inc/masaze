<?php

class ClassHEM
{

  function __construct() {
  }

  public function selectCandidates($list=array(), $appoimentCount=10) {
    $assignees = array();

    $i = 0;
    while ($i < $appoimentCount) {
      $randNum = rand (0,  count($list) - 1);
      if (empty($assignees[$randNum])) {
        $assignees[$randNum] = $list[$randNum];
        $i++;
      }
    }

    return $assignees;
  }

}

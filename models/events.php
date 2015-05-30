<?php

require_once "../da/events.php";

class Models_Events {

  var $daEvents = NULL;

  function __construct() {
    $this->daEvents = new Da_Events();
  }

  public function getSchedules($limit=5) {
    return $this->daEvents->getSchedules($limit);
  }

}

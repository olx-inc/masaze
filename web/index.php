<?php

  require_once "classes/hem.php";

  $hem = new ClassHEM();

  $candidates = array();

  $assignees = $hem->selectCandidates($candidates);

  print_r($assignees);
?>

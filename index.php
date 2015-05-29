<?php

  require_once($_SERVER["DOCUMENT_ROOT"]."/classes/hem.php");

  $hem = new ClassHEM();

  $candidates = array(
    0 => "agustina.leudesdorf@olx.com",
    1 => "gonzalo.espinoza@olx.com",
    2 => "lautaro.dragan@olx.com",
    3 => "pablo.galvan@olx.com",
    4 => "emiliano@olx.com",
    5 => "santiago.bonacalza@olx.com",
    6 => "damianb@olx.com",
  );

  $appoimentCount = 3;

  $assignees = $hem->selectCandidates($candidates, $appoimentCount);

  print_r($assignees);
?>

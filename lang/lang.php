<?php
function getMessage($type, $msg) {
  $json = json_decode(file_get_contents(__DIR__.'/lang.json'), true);
  $msgResult = $json[$type][$msg];

  if ($msgResult == "") $msgResult = "Error!";
  return $msgResult;
}

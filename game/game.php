<?php 

include_once 'scene.php';

$scene = new Scene();

// system('stty cbreak -echo');
$stdin = fopen('php://stdin', 'r');
stream_set_blocking($stdin, 0);
$scene->render(4,1);
while (1) {
  $scene->action($stdin);
}
?>
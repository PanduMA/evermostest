<?php
class Scene{
    public $positionX = 4;
    public $positionY = 1;
    public $bonusX = 1;
    public $bonusY = 3;

    public function render($x,$y){
        for ($i=0; $i <6 ; $i++) { 
            for ($j=0; $j<8 ; $j++) { 
                if ($i== 0 || $i == 5) {
                    echo '#';
                }elseif ($i == 4 && $j==2) {
                    echo '#';
                }elseif ($i == 3 && ($j==4 || $j==6)) {
                    echo '#';
                }elseif ($i == 2 && ($j==2 || $j==3||$j==4)) {
                    echo '#';
                }elseif ($i == $this->bonusX && $j == $this->bonusY) {
                    echo '$';
                }
                else {
                    if ($j==0 || $j == 7) {
                        echo '#';
                    }else {
                        if ($i == $x && $j == $y) {
                            echo 'X';
                        }else {
                            echo '.';
                        }
                    }
                }
            }
            echo "\r\n";
        }
    }
    public function action($stdin) {
        // Listen to the button being pressed.
        $key = trim(fgets($stdin));
        if ($key) {
          $key = $this->translateKeypress($key);
          echo chr(27).chr(91).'H'.chr(27).chr(91).'J';   //^[H^[J
          switch ($key) {
            case "UP":
                if ($this->positionX < 5 && $this->positionX > 1) {
                    $this->positionX--;
                    if($this->checkBonus($this->positionX,$this->positionY)){
                        echo 'You win';die();
                    };
                    $this->render($this->positionX,$this->positionY);
                }else {
                    echo 'Out of range';
                }
              break;
            case "RIGHT":
                if ($this->positionY < 6) {
                    $this->positionY++;
                    if($this->checkBonus($this->positionX,$this->positionY)){
                        echo 'You win';die();
                    };
                    $this->render($this->positionX,$this->positionY);
                }else {
                    echo 'Out of range';
                }
              break;
            case "DOWN":
                if ($this->positionX > 1 && $this->positionX < 5) {
                    $this->positionX++;
                    if($this->checkBonus($this->positionX,$this->positionY)){
                        echo 'You win';die();
                    };
                    $this->render($this->positionX,$this->positionY);
                }else {
                    echo 'Out of range';
                }
              break;
            default:
              die();
          }
        }
      }
     
    private function translateKeypress($string) {
        switch ($string) {
            case "a":
                return "UP";
            case "b":
                return "RIGHT";
            case "c":
                return "DOWN";
            case "A":
                return "UP";
            case "B":
                return "RIGHT";
            case "C":
                return "DOWN";
        }
        return $string;
    }
    private function checkBonus($x,$y){
        if($x == $this->bonusX && $y == $this->bonusY) {
            return true;
        }
        return false;
    }
}

?>
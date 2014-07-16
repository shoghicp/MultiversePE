<?php
namespace MultiversePE\functions\worlds;

use pocketmine\scheduler\PluginTask;
use pocketmine\Player;

class Load extends PluginTask{
  public function onRun(){
  }
  
  public function loadWorld($name){
    $this->name = $name;
    //TODO: Load world with name $this->name
  }
}
?>

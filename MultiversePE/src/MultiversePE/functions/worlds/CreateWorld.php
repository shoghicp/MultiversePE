<?php
namespace MultiversePE\functions\worlds;

use pocketmine\scheduler\PluginTask;
use pocketmine\Player;

class CreateWorld extends PluginTask{
  public function onRun(){
  }
  
  public function createWorld($name){
    $this->name = $name;
    //TODO: Generate new world with name $this->name
  }
}
?>

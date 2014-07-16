<?php
namespace MultiversePE\functions\worlds;

use pocketmine\scheduler\PluginTask;
use pocketmine\Player;

class Import extends PluginTask{
  public function onRun(){
  }
  
  public function importWorld($name){
    $this->name = $name;
    //TODO: Import new world with name $this->name
  }
}
?>

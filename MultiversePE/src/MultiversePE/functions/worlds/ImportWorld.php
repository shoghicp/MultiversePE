<?php
namespace MultiversePE\functions\worlds;

use pocketmine\scheduler\PluginTask;
use pocketmine\level\LevelImport;
use pocketmine\Player;

class ImportWorld extends PluginTask{
  public function onRun(){
  }
  
  public function importWorld($name){
    $this->name = $name;
    //TODO: Import worlds (Likely with a custom generator)
  }
}
?>

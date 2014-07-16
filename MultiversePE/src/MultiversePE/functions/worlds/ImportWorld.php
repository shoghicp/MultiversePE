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
    $this->level->import($this->name); //Not sure how to do this yet
  }
}
?>

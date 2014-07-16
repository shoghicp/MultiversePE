<?php
namespace MultiversePE\functions\worlds;

use pocketmine\scheduler\PluginTask;
use pocketmine\Player;

class DeleteWorld extends PluginTask{
  public function onRun(){
  }
  
  public function deleteWorld($name){
    $this->name = $name;
    //TODO: Delete world with name $this->name
  }
}
?>

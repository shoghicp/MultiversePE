<?php
namespace MultiversePE\functions\portals;

use pocketmine\scheduler\PluginTask;
use pocketmine\Player;

class Delete extends PluginTask{
  public function onRun(){
  }
  
  public function deletePortal($name){
    $this->name = $name;
    //TODO: Delete portal with name $this->name
  }
}
?>

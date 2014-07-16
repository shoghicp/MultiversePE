<?php
namespace MultiversePE;

use pocketmine\plugin\PluginBase;
use pocketmine\level\Position;
use pocketmine\level\Level;
use pocketmine\command\Command;
use pocketmine\command\CommandExecutor;
use pocketmine\command\CommandSender;
use pocketmine\Player;

class Main extends PluginBase implements Listener, CommandExecutor{
  public function onEnable(){
    $this->saveDefaultConfig();
    $this->getResource("config.yml");
    $this->getLogger()->info("MultiversePE Loaded!");
  }
  
  public function onCommand(CommandSender $sender, Command $cmd, $label, array $args){
    switch($cmd->getName()){
      case "multiversepe":
        if(isset($args[0]){
          $0 = $args[0];
          if($0 == "help"){
            $sender->sendMessage("================[MultiversePE]===============\n");
            if($this->getConfig()->get("Enable-MultiversePE-Worlds") === true){
              $sender->sendMessage("/multiverse worlds create - Create a new world\n");
              $sender->sendMessage("/multiverse worlds delete - Deletes an existing world\n");
              $sender->sendMessage("/multiverse worlds import - Imports an existing world\n");
              $sender->sendMessage("/multiverse worlds load - Loads an existing world\n");
              $sender->sendMessage("/multiverse worlds disable - Disable MultiversePE Worlds\n");
            }
            if($this->getConfig()->get("Enable-MultiversePE-Portals") === true){
              $sender->sendMessage("/multiverse portals create - Create a portal\n");
              $sender->sendMessage("/multiverse portals delete - Delete a portal\n");
              $sender->sendMessage("/multiverse portals disable - Disable MultiversePE Portals\n");
            }
            if($this->getConfig()->get("Enable-MultiversePE-Signs") === true){
              $sender->sendMessage("/multiverse signs disable - Disable MultiversePE Signs\n");
            }
            if($this->getConfig()->get("Enable-MultiversePE-Worlds") === false and $this->getConfig()->get("Enable-MultiversePE-Portals") === false and $this->getConfig()->get("Enable-MultiversePE-Signs") === false){
              $sender->sendMessage("No MultiversePE settings are enabled\n");
              $sender->sendMessage("Please enable at least one setting to use MultiversePE\n");
            }
            $sender->sendMessage("============================================\n");
            return true;
          }
        }else{
          $sender->sendMessage("Usage: /multiverse <create|delete|import|load> <name>");
          return true;
        }
      break;
    }
  }
  
  public function onEvent(){
    //TODO: Events
  }
  
  public function onDisable(){
    $this->getLogger()->info("MultiversePE Unloaded!");
  }
}
?>

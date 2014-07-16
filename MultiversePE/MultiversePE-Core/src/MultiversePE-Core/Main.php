<?php
namespace MultiversePE-Core;

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
      case "multiverse":
        if(isset($args[0]){
          $0 = $args[0];
          if($0 == "help"){
            $sender->sendMessage("==========[MultiversePE Core]==========\n");
            $sender->sendMessage("/multiverse create - Create a new world\n");
            $sender->sendMessage("/multiverse delete - Deletes an existing world\n");
            $sender->sendMessage("/multiverse import - Imports an existing world\n");
            $sender->sendMessage("/multiverse load - Loads an existing world");
            //TODO: Check what other Multiverse plugins are loaded and show the help for them
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

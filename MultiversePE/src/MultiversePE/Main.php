<?php
namespace MultiversePE;

use pocketmine\plugin\PluginBase;
use pocketmine\level\Position;
use pocketmine\level\Level;
use pocketmine\command\Command;
use pocketmine\command\CommandExecutor;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
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
        if(isset($args[0])){
          $a = $args[0];
          if($a == "help"){
            $sender->sendMessage("================[MultiversePE]===============\n");
            if($this->getConfig()->get("Enable-MultiversePE-Worlds") === true){
              $sender->sendMessage("/multiversepe worlds create - Create a new world\n");
              $sender->sendMessage("/multiversepe worlds delete - Deletes an existing world\n");
              $sender->sendMessage("/multiversepe worlds import - Imports an existing world\n");
              $sender->sendMessage("/multiversepe worlds load - Loads an existing world\n");
              $sender->sendMessage("/multiversepe worlds disable - Disable MultiversePE Worlds\n");
            }
            if($this->getConfig()->get("Enable-MultiversePE-Portals") === true){
              $sender->sendMessage("/multiversepe portals create - Create a portal\n");
              $sender->sendMessage("/multiversepe portals delete - Delete a portal\n");
              $sender->sendMessage("/multiversepe portals disable - Disable MultiversePE Portals\n");
            }
            if($this->getConfig()->get("Enable-MultiversePE-Signs") === true){
              $sender->sendMessage("/multiversepe signs disable - Disable MultiversePE Signs\n");
            }
            if($this->getConfig()->get("Enable-MultiversePE-Worlds") === false and $this->getConfig()->get("Enable-MultiversePE-Portals") === false and $this->getConfig()->get("Enable-MultiversePE-Signs") === false){
              $sender->sendMessage("No MultiversePE settings are enabled\n");
              $sender->sendMessage("Please enable at least one setting to use MultiversePE\n");
            }
            $sender->sendMessage("============================================\n");
            return true;
        }elseif($a == "worlds" and $this->getConfig()->get("Enable-MultiversePE-Worlds") === true){
          if(isset($args[1])){
            $b = $args[1];
            if($b = "create"){
              if(isset($args[2])){
                $name = $args[2];
                if($this->getServer()->getLevelByName($name)){
                  $sender->sendMessage("[MultiversePE] That level already exists!");
                }else{
                $create = new CreateWorld($this);
                $create->createWorld($name);
                $sender->sendMessage("[MultiversePE] Level created and generated successfully!");
                }
              }else{
                $sender->sendMessage("[MultiversePE] You must specify a name!");
              }
            }elseif($b = "delete"){
              if(isset($args[2])){
                $name = $args[2];
                if($name = $this->getServer()->getDefaultLevel()){
                  $sender->sendMessage("[MultiversePE] You can not delete the default level!");
                }else{
                  $create = new DeleteWorld($this);
                  $create->deleteWorld($name);
                  $sender->sendMessage("[MultiversePE] Level deleted successfully!");
                }
              }else{
                $sender->sendMessage("[MultiversePE] You must specify a name!");
              }
            }elseif($b = "import"){
              if(isset($args[2])){
                $name = $args[2];
                //TODO: Is the level already imported?
                $create = new ImportWorld($this);
                $create->importWorld($name);
                $sender->senderMessage("[MultiversePE] Level imported successfully!");
              }else{
                $sender->sendMessage("[MultiversePE] You must specify a name!");
              }
            }elseif($b = "load"){
              if(isset($args[2])){
                $name = $args[2];
                if($this->getServer()->isLevelLoaded($name)){
                  $sender->sendMessage("[MultiversePE] Level is already loaded!");
                }else{
                  $create = new LoadWorld($this);
                  $create->loadWorld($name);
                  $sender->sendMessage("[MultiversePE] Level loaded successfully!!");
                }
              }else{
                $sender->sendMessage("[MultiversePE] You must specify a name!");
              }
            }elseif($b = "disable"){
              if($this->getConfig()->get("Enable-MultiversePE-Worlds") === true){
                $this->getConfig()->set("Enable-MultiversePE-Worlds", false);
                $this->getConfig()->save();
              }else{
                $sender->sendMessage("[MultiversePE] MultiversePE-Worlds is disabled!");
              }
            }else{
              $sender->sendMessage("/multiversepe worlds <create|delete|import|load|disable> <name>");
            }
          }elseif($this->getConfig()->get("Enable-MultiversePE-Worlds") === false){
            $sender->sendMessage("[MultiversePE] MultiversePE-Worlds is disabled!");
          }
        }elseif($a == "portals" and $this->getConfig()->get("Enable-MultiversePE-Portals") === true){
          if(isset($args[1])){
            $b = $args[1];
            if($b = "create"){
              if(isset($args[2])){
                $name = $args[2];
                $create = new CreatePortal($this);
                $create->createPortal($name);
                $sender->sendMessage("[MultiversePE] Portal created successfully!");
              }else{
                $sender->sendMessage("[MultiversePE] You must specify a name!");
              }
            }elseif($b = "delete"){
              if(isset($args[2])){
                $name = $args[2];
                $create = new DeletePortal($this);
                $create->deletePortal($name);
                $sender->sendMessage("[MultiversePE] Portal deleted successfully!");
              }else{
                $sender->sendMessage("[MultiversePE] You must specify a name!");
              }
            }elseif($b = "disable"){
              if($this->getConfig()->get("Enable-MultiversePE-Portals") === true){
                $this->getConfig()->set("Enable-MultiversePE-Portals", false);
                $this->getConfig()->save();
              }else{
                $sender->sendMessage("[MultiversePE] MultiversePE-Portals is disabled!");
              }
            }else{
              $sender->sendMessage("/multiversepe portals <create|delete|disable> <name>");
            }
          }elseif($this->getConfig()->get("Enable-MultiversePE-Portals") === false){
            $sender->sendMessage("[MultiversePE] MultiversePE-Portals is disabled!");
          }
        }elseif($a == "signs" and $this->getConfig()->get("Enable-MultiversePE-Signs") === true){
          if(isset($args[1])){
            $b = $args[1];
            if($b = "disable"){
              if($this->getConfig()->get("Enable-MultiversePE-Signs") === true){
                $this->getConfig()->set("Enable-MultiversePE-Signs", false);
                $this->getConfig()->save();
              }else{
                $sender->sendMessage("[MultiversePE] MultiversePE-Signs is disabled!");
              }
            }else{
              $sender->sendMessage("/multiversepe signs <disable>");
            }
          }elseif($this->getConfig()->get("Enable-MultiversePE-Signs") === false){
            $sender->sendMessage("[MultiversePE] MultiversePE-Signs is disabled!");
          }
        }else{
          if($this->getConfig()->get("Enable-MultiversePE-Worlds") === true and $this->getConfig()->get("Enable-MultiversePE-Portals") === true and $this->getConfig()->get("Enable-MultiversePE-Signs") === true){
            $sender->sendMessage("Usage: /multiversepe <worlds|portals|signs>");
          }elseif($this->getConfig()->get("Enable-MultiversePE-Portals") === true and $this->getConfig()->get("Enable-MultiversePE-Signs") === true){
            $sender->sendMessage("Usage: /multiversepe <portals|signs>");
          }elseif($this->getConfig()->get("Enable-MultiversePE-Worlds") === true and $this->getConfig()->get("Enable-MultiversePE-Signs") === true){
            $sender->sendMessage("Usage: /multiversepe <worlds|signs>");
          }elseif($this->getConfig()->get("Enable-MultiversePE-Worlds") === true and $this->getConfig()->get("Enable-MultiversePE-Portals") === true){
            $sender->sendMessage("Usage: /multiversepe <worlds|portals>");
          }
          return true;
        }
      break;
    }
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

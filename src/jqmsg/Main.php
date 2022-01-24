<?php

namespace jqmsg;


use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;

use pocketmine\plugin\PluginBase;
use pocketmine\player\Player;
use pocketmine\Server;

use pocketmine\command\CommandSender;
use pocketmine\command\Command;

use pocketmine\utils\TextFormat as C;
use pocketmine\utils\Config;

class Main extends PluginBase implements Listener {
    public $cfg;

    public function onEnable(): void{
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
        @mkdir($this->getDataFolder());
        $this->cfg = $this->getConfig();
        $this->saveDefaultConfig();
	}

    public function onJoin(PlayerJoinEvent $event) {
        if ($event->getPlayer() instanceof Player) {
            $player = $event->getPlayer();
            $name = $player->getName();
            Server::GetInstance()->broadcastMessage($this->cfg->get("msgjoin") .  $name);
        }
    }

    public function onQuit(PlayerQuitEvent $event) {
        if ($event->getPlayer() instanceof Player) {
            $player = $event->getPlayer();
            $name = $player->getName();
            Server::GetInstance()->broadcastMessage($this->cfg->get("msgquit") .  $name);
        }
    }


}

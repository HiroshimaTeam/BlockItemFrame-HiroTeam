<?php
#██╗░░██╗██╗██████╗░░█████╗░████████╗███████╗░█████╗░███╗░░░███╗
#██║░░██║██║██╔══██╗██╔══██╗╚══██╔══╝██╔════╝██╔══██╗████╗░████║
#███████║██║██████╔╝██║░░██║░░░██║░░░█████╗░░███████║██╔████╔██║
#██╔══██║██║██╔══██╗██║░░██║░░░██║░░░██╔══╝░░██╔══██║██║╚██╔╝██║
#██║░░██║██║██║░░██║╚█████╔╝░░░██║░░░███████╗██║░░██║██║░╚═╝░██║
#╚═╝░░╚═╝╚═╝╚═╝░░╚═╝░╚════╝░░░░╚═╝░░░╚══════╝╚═╝░░╚═╝╚═╝░░░░░╚═╝
namespace blockitemframe;

use pocketmine\block\Block;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\level\Position;
use pocketmine\plugin\PluginBase;


class Main extends PluginBase implements Listener{

    private $Wg;
    public function onEnable(){
        $this -> getServer() -> getPluginManager() -> registerEvents($this, $this);

        if ($this->getServer()->getPluginManager()->getPlugin("WorldGuard") !== null) {
            $this->Wg = $this->getServer()->getPluginManager()->getPlugin("WorldGuard");
        } else {
            $this->getLogger()->critical("WorldGuard not found, this plugin requires WorldGuard");
        }

    }
    private function WorldGuardProtection(Position $position): bool{
        if(isset($this->Wg)) {
            $result = true;
            if (($region = $this->Wg->getRegionFromPosition($position)) !== ""){
                $result = false;
            }
            return $result;
        }
        return true;
    }
    /**
     * @priority HIGHEST
     * @param PlayerInteractEvent $event
     * @return void
     */
    public function blockitemframe(PlayerInteractEvent $event):void {
        $player = $event->getPlayer();
        $block = $event->getBlock();

        $position = new Position($block->x, $block->y, $block->z, $block->getLevel());
        if ($this->WorldGuardProtection($position) !== true) {
            if($block->getId() === Block::ITEM_FRAME_BLOCK){
                if(!$player->hasPermission("itemframe")) {
                    $event -> setCancelled(true);
                }
            }
        }
    }
}

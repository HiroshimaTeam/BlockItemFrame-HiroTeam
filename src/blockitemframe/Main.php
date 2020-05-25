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
use pocketmine\plugin\PluginBase;


class Main extends PluginBase implements Listener{

    public function onEnable(){
        $this -> getServer() -> getPluginManager() -> registerEvents($this, $this);
    }
    /**
     * @priority HIGHEST
     * @param PlayerInteractEvent $event
     * @return void
     */
    public function blockitemframe(PlayerInteractEvent $event):void {
        $player = $event->getPlayer();
        $block = $event->getBlock();

        if($block->getId() === Block::ITEM_FRAME_BLOCK){
            if(!$player->hasPermission("itemframe")) {
                $event -> setCancelled(true);
            }
        }
    }
}
<?php
namespace masks;


use pocketmine\item\Item;
use pocketmine\nbt\tag\IntTag;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;

class MainClass extends PluginBase{


    public $masks = [];

    const RANDOM_HEAD = 0;
    const SKELETON_HEAD = 1;
    const WITHER_HEAD = 2;
    const ZOMBIE_HEAD = 3;
    const CREEPER_HEAD = 4;


    public function onEnable(){
        $this->getLogger()->info("Enabled!");

        //Events
        $this->getServer()->getPluginManager()->registerEvents(new EventsListener($this),$this);

        //Register Heads
        $this->registerHeads();

        //Command
        $this->getServer()->getCommandMap()->register("mask", new maskCommand($this));
    }


    public function onDisable(){
        $this->getLogger()->info("Disabled!");
    }

    public function giveRandomHead(Player $player){
        $max = count($this->masks) - 1;
        $mask = mt_rand(1,$max);
        $mask = $this->masks[$mask];
        $player->getInventory()->setItemInHand($mask);
    }


    public function registerHeads(){
        $random = Item::get(397,3,1);
        $random->setCustomName("§l§aMystery Mob Mask§r\n§7A Mystery Head That Has Been§r\n§7Discovered And Contains The Remains§r\n§7Of The Evil Overlord's General!§r\n\n§7Right Click This Mask On A Cauldron To\nUn-Cover The Mask Hidden Inside!§r");
        $nbt = $random->getNamedTag();
        $nbt->mask = new IntTag("mask",self::RANDOM_HEAD);
        $random->setNamedTag($nbt);
        $this->masks[self::RANDOM_HEAD] = $random;

        $skeleton = Item::get(397,0,1);
        $skeleton->setCustomName("§l§aSkeleton Mask§r\n§7You Have A Skeleton Mask,§r\n§7Use It Wisely! And Don't Loose It§r\n\n§7Do /masks To See What It Does!");
        $nbt = $skeleton->getNamedTag();
        $nbt->mask = new IntTag("mask",self::SKELETON_HEAD);
        $skeleton->setNamedTag($nbt);
        $this->masks[self::SKELETON_HEAD] = $skeleton;

        $wither = Item::get(397,1,1);
        $wither->setCustomName("§l§aWither Skeleton Mask§r\n§7You Have A Wither Skeleton Mask,§r\n§7Use It Wisely! And Don't Loose It§r\n\n§7Do /masks To See What It Does!");
        $nbt = $wither->getNamedTag();
        $nbt->mask = new IntTag("mask",self::WITHER_HEAD);
        $wither->setNamedTag($nbt);
        $this->masks[self::WITHER_HEAD] = $wither;

        $zombie = Item::get(397,2,1);
        $zombie->setCustomName("§l§aZombie Mask§r\n§7You Have A Zombie Mask,§r\n§7Use It Wisely! And Don't Loose It§r\n\n§7Do /masks To See What It Does!");
        $nbt = $zombie->getNamedTag();
        $nbt->mask = new IntTag("mask",self::ZOMBIE_HEAD);
        $zombie->setNamedTag($nbt);
        $this->masks[self::ZOMBIE_HEAD] = $zombie;

        $creeper = Item::get(397,4,1);
        $creeper->setCustomName("§l§aCreeper Mask§r\n§7You Have A Creeper Mask,§r\n§7Use It Wisely! And Don't Loose It§r\n\n§7Do /masks To See What It Does!");
        $nbt = $creeper->getNamedTag();
        $nbt->mask = new IntTag("mask",self::CREEPER_HEAD);
        $creeper->setNamedTag($nbt);
        $this->masks[self::CREEPER_HEAD] = $creeper;
    }



}

<?php

declare(strict_types=1);

namespace Fludixx\BWShop;

use muqsit\invmenu\{InvMenu,InvMenuHandler};
use pocketmine\entity\Villager;
use pocketmine\event\Listener;
use pocketmine\item\Item;
use pocketmine\plugin\PluginBase;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\Player;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat as f;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use Fludixx\BWShop;

class Main extends PluginBase implements Listener {

	const PREFIX = f::WHITE."SHOP".f::GRAY." ->".f::YELLOW." ";

	public function onEnable() : void{
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getLogger()->info(self::PREFIX."Geladen!");
	}

	public function onHit(EntityDamageEvent $event)
	{

		$player = $event->getEntity();

		if ($player instanceof Villager) {

			if ($event instanceof EntityDamageByEntityEvent) {

				$damager = $event->getDamager();
				if ($damager instanceof Player) {

					$event->setCancelled();
					if (!InvMenuHandler::isRegistered()) {

						InvMenuHandler::register($this);

					}
					$this->Overview($damager);
					$event->setCancelled();
				}
			}
		}
	}

	public function Overview(Player $player) {
		$menu = InvMenu::create(InvMenu::TYPE_CHEST);
		$menu->readonly();
		$menu->setName(f::DARK_GRAY."Bedwars Shop");
		$minv = $menu->getInventory();
		$platzhalter1 = Item::get(Item::STAINED_GLASS_PANE, 8)->setCustomName("");
		$platzhalter2 = Item::get(Item::STAINED_GLASS_PANE, 7)->setCustomName("");
		$selected = Item::get(Item::STAINED_GLASS_PANE, 14)->setCustomName("Derzeitige Kategorie");
		$sandstone = Item::get(Item::SANDSTONE, 0, 16);
		$sandstone->setCustomName(f::YELLOW."16x".f::WHITE." Sandstein".f::RED." 4 Bronze");
		$stick = Item::get(Item::STICK, 0, 1);
		$stick->setCustomName(f::YELLOW."1x".f::WHITE." Stick".f::RED." 8 Bronze");
		$picke = Item::get(Item::WOODEN_PICKAXE, 0, 1);
		$picke->setCustomName(f::YELLOW."1x".f::WHITE." Spitzhacke".f::RED." 4 Bronze");
		$schwert1 = Item::get(Item::GOLDEN_SWORD, 0, 1);
		$schwert1->setCustomName(f::YELLOW."1x".f::WHITE." Schwert - 1".f::GRAY." 1 Eisen");
		$helm = Item::get(Item::LEATHER_CAP)->setCustomName(f::YELLOW. "1x".f::WHITE." Kappe".f::RED." 1 Bronze");
		$brust1 = Item::get(Item::CHAINMAIL_CHESTPLATE)->setCustomName(f::YELLOW. "1x".f::WHITE." Rüstung - 1".f::GRAY." 1 Eisen");
		$hose = Item::get(Item::LEATHER_LEGGINGS)->setCustomName(f::YELLOW. "1x".f::WHITE." Hose".f::RED." 1 Bronze");
		$boots = Item::get(Item::LEATHER_BOOTS)->setCustomName(f::YELLOW. "1x".f::WHITE." Schuhe".f::RED." 1 Bronze");
		$bett = Item::get(Item::BED, 14, 1);$bett->setCustomName(f::YELLOW."Schwitzer Kategorie");
		$stein = Item::get(Item::BRICK_BLOCK, 0, 1);$stein->setCustomName(f::YELLOW."Block Kategorie");
		$brust = Item::get(Item::CHAINMAIL_CHESTPLATE, 0, 1);$brust->setCustomName(f::YELLOW."Rüstungs Kategorie");
		$battle = Item::get(Item::IRON_SWORD, 0, 1);$battle->setCustomName(f::YELLOW."Kampf Kategorie");
		$extra = Item::get(Item::EXPERIENCE_BOTTLE, 0, 1);$extra->setCustomName(f::YELLOW."Spielereien");
		$minv->setItem(0, $stick);
		$minv->setItem(1, $picke);
		$minv->setItem(2, $sandstone);
		$minv->setItem(3, $schwert1);
		$minv->setItem(4, $platzhalter1);
		$minv->setItem(5, $helm);
		$minv->setItem(6, $brust1);
		$minv->setItem(7, $hose);
		$minv->setItem(8, $boots);
		$minv->setItem(9, $platzhalter2);
		$minv->setItem(10, $platzhalter2);
		$minv->setItem(11, $selected);
		$minv->setItem(12, $platzhalter2);
		$minv->setItem(13, $platzhalter2);
		$minv->setItem(14, $platzhalter2);
		$minv->setItem(15, $platzhalter2);
		$minv->setItem(16, $platzhalter2);
		$minv->setItem(17, $platzhalter2);
		$minv->setItem(18, $platzhalter1);
		$minv->setItem(19, $platzhalter1);
		$minv->setItem(20, $bett);
		$minv->setItem(21, $stein);
		$minv->setItem(22, $brust);
		$minv->setItem(23, $battle);
		$minv->setItem(24, $extra);
		$minv->setItem(25, $platzhalter1);
		$minv->setItem(26, $platzhalter1);
		$menu->send($player);
		$menu->setListener([new BWListener($this), "onTransaction"]);
	}
	public function Bau(Player $player) {
		$menu = InvMenu::create(InvMenu::TYPE_CHEST);
		$menu->readonly();
		$menu->setName(f::DARK_GRAY."Bedwars Shop");
		$minv = $menu->getInventory();
		$platzhalter1 = Item::get(Item::STAINED_GLASS_PANE, 8)->setCustomName("");
		$platzhalter2 = Item::get(Item::STAINED_GLASS_PANE, 7)->setCustomName("");
		$selected = Item::get(Item::STAINED_GLASS_PANE, 14)->setCustomName("Derzeitige Kategorie");
		$sandstone = Item::get(Item::SANDSTONE, 0, 4);
		$sandstone->setCustomName(f::YELLOW."4x".f::WHITE." Sandstein".f::RED." 1 Bronze");
		$sandstone2 = Item::get(Item::SANDSTONE, 0, 16);
		$sandstone2->setCustomName(f::YELLOW."16x".f::WHITE." Sandstein".f::RED." 4 Bronze");
		$sandstone3 = Item::get(Item::SANDSTONE, 0, 64);
		$sandstone3->setCustomName(f::YELLOW."64x".f::WHITE." Sandstein".f::RED." 16 Bronze");
		$endstein = Item::get(Item::END_STONE, 0, 1);
		$endstein->setCustomName(f::YELLOW."1x".f::WHITE." Endstone".f::RED." 16 Bronze");
		$web = Item::get(Item::WEB, 0, 1);
		$web->setCustomName(f::YELLOW."1x".f::WHITE." Cobweb".f::RED." 8 Bronze");
		$bett = Item::get(Item::BED, 14, 1);$bett->setCustomName(f::YELLOW."Schwitzer Kategorie");
		$stein = Item::get(Item::BRICK_BLOCK, 0, 1);$stein->setCustomName(f::YELLOW."Block Kategorie");
		$brust = Item::get(Item::CHAINMAIL_CHESTPLATE, 0, 1);$brust->setCustomName(f::YELLOW."Rüstungs Kategorie");
		$battle = Item::get(Item::IRON_SWORD, 0, 1);$battle->setCustomName(f::YELLOW."Kampf Kategorie");
		$extra = Item::get(Item::EXPERIENCE_BOTTLE, 0, 1);$extra->setCustomName(f::YELLOW."Spielereien");
		$minv->setItem(0, $sandstone);
		$minv->setItem(1, $sandstone2);
		$minv->setItem(2, $sandstone3);
		$minv->setItem(3, $platzhalter1);
		$minv->setItem(4, $endstein);
		$minv->setItem(5, $web);
		$minv->setItem(6, $platzhalter1);
		$minv->setItem(7, $platzhalter1);
		$minv->setItem(8, $platzhalter1);
		$minv->setItem(9, $platzhalter2);
		$minv->setItem(10, $platzhalter2);
		$minv->setItem(11, $platzhalter2);
		$minv->setItem(12, $selected);
		$minv->setItem(13, $platzhalter2);
		$minv->setItem(14, $platzhalter2);
		$minv->setItem(15, $platzhalter2);
		$minv->setItem(16, $platzhalter2);
		$minv->setItem(17, $platzhalter2);
		$minv->setItem(18, $platzhalter1);
		$minv->setItem(19, $platzhalter1);
		$minv->setItem(20, $bett);
		$minv->setItem(21, $stein);
		$minv->setItem(22, $brust);
		$minv->setItem(23, $battle);
		$minv->setItem(24, $extra);
		$minv->setItem(25, $platzhalter1);
		$minv->setItem(26, $platzhalter1);
		$menu->send($player);
		$menu->setListener([new BWListener($this), "onTransaction"]);
	}
	public function Ruestung(Player $player) {
		$menu = InvMenu::create(InvMenu::TYPE_CHEST);
		$menu->readonly();
		$menu->setName(f::DARK_GRAY."Bedwars Shop");
		$minv = $menu->getInventory();
		$platzhalter1 = Item::get(Item::STAINED_GLASS_PANE, 8)->setCustomName("");
		$platzhalter2 = Item::get(Item::STAINED_GLASS_PANE, 7)->setCustomName("");
		$selected = Item::get(Item::STAINED_GLASS_PANE, 14)->setCustomName("Derzeitige Kategorie");
		$sandstone = Item::get(Item::SANDSTONE, 0, 16);
		$sandstone->setCustomName(f::YELLOW."16x".f::WHITE." Sandstein".f::RED." 4 Bronze");
		$stick = Item::get(Item::STICK, 0, 1);
		$stick->setCustomName(f::YELLOW."1x".f::WHITE." Stick".f::RED." 8 Bronze");
		$picke = Item::get(Item::WOODEN_PICKAXE, 0, 1);
		$picke->setCustomName(f::YELLOW."1x".f::WHITE." Spitzhacke".f::RED." 4 Bronze");
		$schwert1 = Item::get(Item::GOLDEN_SWORD, 0, 1);
		$schwert1->setCustomName(f::YELLOW."1x".f::WHITE." Schwert - 1".f::GRAY." 1 Eisen");
		$schwert2 = Item::get(Item::GOLDEN_SWORD, 0, 1);
		$schwert2->setCustomName(f::YELLOW."1x".f::WHITE." Schwert - 2".f::GRAY." 3 Eisen");
		$schwert3 = Item::get(Item::GOLDEN_SWORD, 0, 1);
		$schwert3->setCustomName(f::YELLOW."1x".f::WHITE." Schwert - 3".f::GRAY." 8 Eisen");
		$bow1 = Item::get(Item::BOW, 0, 1);
		$bow1->setCustomName(f::YELLOW."1x".f::WHITE." Bogen - 1".f::GOLD." 4 Gold");
		$bett = Item::get(Item::BED, 14, 1);$bett->setCustomName(f::YELLOW."Schwitzer Kategorie");
		$stein = Item::get(Item::BRICK_BLOCK, 0, 1);$stein->setCustomName(f::YELLOW."Block Kategorie");
		$brust = Item::get(Item::CHAINMAIL_CHESTPLATE, 0, 1);$brust->setCustomName(f::YELLOW."Rüstungs Kategorie");
		$battle = Item::get(Item::IRON_SWORD, 0, 1);$battle->setCustomName(f::YELLOW."Kampf Kategorie");
		$extra = Item::get(Item::EXPERIENCE_BOTTLE, 0, 1);$extra->setCustomName(f::YELLOW."Spielereien");
		$minv->setItem(0, $schwert1);
		$minv->setItem(1, $schwert2);
		$minv->setItem(2, $schwert3);
		$minv->setItem(3, $platzhalter1);
		$minv->setItem(4, $bow1);
		$minv->setItem(5, $platzhalter1);
		$minv->setItem(6, $platzhalter1);
		$minv->setItem(7, $platzhalter1);
		$minv->setItem(8, $platzhalter1);
		$minv->setItem(9, $platzhalter2);
		$minv->setItem(10, $platzhalter2);
		$minv->setItem(11, $platzhalter2);
		$minv->setItem(12, $platzhalter2);
		$minv->setItem(13, $platzhalter2);
		$minv->setItem(14, $selected);
		$minv->setItem(15, $platzhalter2);
		$minv->setItem(16, $platzhalter2);
		$minv->setItem(17, $platzhalter2);
		$minv->setItem(18, $platzhalter1);
		$minv->setItem(19, $platzhalter1);
		$minv->setItem(20, $bett);
		$minv->setItem(21, $stein);
		$minv->setItem(22, $brust);
		$minv->setItem(23, $battle);
		$minv->setItem(24, $extra);
		$minv->setItem(25, $platzhalter1);
		$minv->setItem(26, $platzhalter1);
		$menu->send($player);
		$menu->setListener([new BWListener($this), "onTransaction"]);
	}
	public function Battle(Player $player) {
		$menu = InvMenu::create(InvMenu::TYPE_CHEST);
		$menu->readonly();
		$menu->setName(f::DARK_GRAY."Bedwars Shop");
		$minv = $menu->getInventory();
		$platzhalter1 = Item::get(Item::STAINED_GLASS_PANE, 8)->setCustomName("");
		$platzhalter2 = Item::get(Item::STAINED_GLASS_PANE, 7)->setCustomName("");
		$selected = Item::get(Item::STAINED_GLASS_PANE, 14)->setCustomName("Derzeitige Kategorie");
		$sandstone = Item::get(Item::SANDSTONE, 0, 16);
		$sandstone->setCustomName(f::YELLOW."16x".f::WHITE." Sandstein".f::RED." 4 Bronze");
		$stick = Item::get(Item::STICK, 0, 1);
		$stick->setCustomName(f::YELLOW."1x".f::WHITE." Stick".f::RED." 8 Bronze");
		$picke = Item::get(Item::WOODEN_PICKAXE, 0, 1);
		$picke->setCustomName(f::YELLOW."1x".f::WHITE." Spitzhacke".f::RED." 4 Bronze");
		$schwert1 = Item::get(Item::GOLDEN_SWORD, 0, 1);
		$schwert1->setCustomName(f::YELLOW."1x".f::WHITE." Schwert - 1".f::GRAY." 1 Eisen");
		$helm = Item::get(Item::LEATHER_CAP)->setCustomName(f::YELLOW. "1x".f::WHITE." Kappe".f::RED." 1 Bronze");
		$brust1 = Item::get(Item::CHAINMAIL_CHESTPLATE)->setCustomName
		(f::YELLOW. "1x".f::WHITE." Rüstung - 1".f::GRAY." 1 Eisen");
		$brust2 = Item::get(Item::CHAINMAIL_CHESTPLATE)->setCustomName
		(f::YELLOW. "1x".f::WHITE." Rüstung - 2" .f::GRAY." 3 Eisen");
		$brust3 = Item::get(Item::IRON_CHESTPLATE)->setCustomName
		(f::YELLOW. "1x".f::WHITE." Rüstung - 3" .f::GRAY." 7 Eisen");
		$brust4 = Item::get(Item::LEATHER_CHESTPLATE)->setCustomName
		(f::YELLOW. "1x".f::WHITE." Rüstung" .f::RED." 2 Bronze");
		$hose = Item::get(Item::LEATHER_LEGGINGS)->setCustomName
		(f::YELLOW. "1x".f::WHITE." Hose".f::RED." 1 Bronze");
		$boots = Item::get(Item::LEATHER_BOOTS)->setCustomName
		(f::YELLOW. "1x".f::WHITE." Schuhe".f::RED." 1 Bronze");
		$bett = Item::get(Item::BED, 14, 1);$bett->setCustomName(f::YELLOW."Schwitzer Kategorie");
		$stein = Item::get(Item::BRICK_BLOCK, 0, 1);$stein->setCustomName(f::YELLOW."Block Kategorie");
		$brust = Item::get(Item::CHAINMAIL_CHESTPLATE, 0, 1);$brust->setCustomName(f::YELLOW."Rüstungs Kategorie");
		$battle = Item::get(Item::IRON_SWORD, 0, 1);$battle->setCustomName(f::YELLOW."Kampf Kategorie");
		$extra = Item::get(Item::EXPERIENCE_BOTTLE, 0, 1);$extra->setCustomName(f::YELLOW."Spielereien");
		$minv->setItem(0, $brust1);
		$minv->setItem(1, $brust2);
		$minv->setItem(2, $brust3);
		$minv->setItem(3, $brust4);
		$minv->setItem(4, $platzhalter1);
		$minv->setItem(5, $helm);
		$minv->setItem(6, $brust1);
		$minv->setItem(7, $hose);
		$minv->setItem(8, $boots);
		$minv->setItem(9, $platzhalter2);
		$minv->setItem(10, $platzhalter2);
		$minv->setItem(11, $platzhalter2);
		$minv->setItem(12, $platzhalter2);
		$minv->setItem(13, $selected);
		$minv->setItem(14, $platzhalter2);
		$minv->setItem(15, $platzhalter2);
		$minv->setItem(16, $platzhalter2);
		$minv->setItem(17, $platzhalter2);
		$minv->setItem(18, $platzhalter1);
		$minv->setItem(19, $platzhalter1);
		$minv->setItem(20, $bett);
		$minv->setItem(21, $stein);
		$minv->setItem(22, $brust);
		$minv->setItem(23, $battle);
		$minv->setItem(24, $extra);
		$minv->setItem(25, $platzhalter1);
		$minv->setItem(26, $platzhalter1);
		$menu->send($player);
		$menu->setListener([new BWListener($this), "onTransaction"]);
	}
	public function Extra(Player $player) {
		$menu = InvMenu::create(InvMenu::TYPE_CHEST);
		$menu->readonly();
		$menu->setName(f::DARK_GRAY."Bedwars Shop");
		$minv = $menu->getInventory();
		$platzhalter1 = Item::get(Item::STAINED_GLASS_PANE, 8)->setCustomName("");
		$platzhalter2 = Item::get(Item::STAINED_GLASS_PANE, 7)->setCustomName("");
		$selected = Item::get(Item::STAINED_GLASS_PANE, 14)->setCustomName("Derzeitige Kategorie");
		$tnt = Item::get(Item::TNT, 0)->setCustomName(f::YELLOW. "1x".f::WHITE." TNT".f::GOLD." 2 Gold");
		$fire = Item::get(Item::FLINT_AND_STEEL, 0)->setCustomName(f::YELLOW. "1x".f::WHITE." Feuerzeug".f::GRAY." 5 Eisen");
		$ender = Item::get(Item::ENDER_PEARL, 0)->setCustomName(f::YELLOW. "1x".f::WHITE." Enderperle".f::GOLD." 12 Gold");
		$safe = Item::get(Item::BLAZE_ROD, 0)->setCustomName(f::YELLOW. "1x".f::WHITE." Rettungs Platform".f::GOLD." 6 Gold");
		$bett = Item::get(Item::BED, 14, 1);$bett->setCustomName(f::YELLOW."Schwitzer Kategorie");
		$stein = Item::get(Item::BRICK_BLOCK, 0, 1);$stein->setCustomName(f::YELLOW."Block Kategorie");
		$brust = Item::get(Item::CHAINMAIL_CHESTPLATE, 0, 1);$brust->setCustomName(f::YELLOW."Rüstungs Kategorie");
		$battle = Item::get(Item::IRON_SWORD, 0, 1);$battle->setCustomName(f::YELLOW."Kampf Kategorie");
		$extra = Item::get(Item::EXPERIENCE_BOTTLE, 0, 1);$extra->setCustomName(f::YELLOW."Spielereien");
		$minv->setItem(0, $tnt);
		$minv->setItem(1, $ender);
		$minv->setItem(2, $safe);
		$minv->setItem(3, $fire);
		$minv->setItem(4, $platzhalter1);
		$minv->setItem(5, $platzhalter1);
		$minv->setItem(6, $platzhalter1);
		$minv->setItem(7, $platzhalter1);
		$minv->setItem(8, $platzhalter1);
		$minv->setItem(9, $platzhalter2);
		$minv->setItem(10, $platzhalter2);
		$minv->setItem(11, $platzhalter2);
		$minv->setItem(12, $platzhalter2);
		$minv->setItem(13, $platzhalter2);
		$minv->setItem(14, $platzhalter2);
		$minv->setItem(15, $selected);
		$minv->setItem(16, $platzhalter2);
		$minv->setItem(17, $platzhalter2);
		$minv->setItem(18, $platzhalter1);
		$minv->setItem(19, $platzhalter1);
		$minv->setItem(20, $bett);
		$minv->setItem(21, $stein);
		$minv->setItem(22, $brust);
		$minv->setItem(23, $battle);
		$minv->setItem(24, $extra);
		$minv->setItem(25, $platzhalter1);
		$minv->setItem(26, $platzhalter1);
		$menu->send($player);
		$menu->setListener([new BWListener($this), "onTransaction"]);
	}

}

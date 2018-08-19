<?php
namespace Fludixx\BWShop;

use pocketmine\inventory\transaction\action\SlotChangeAction;
use pocketmine\item\Item;
use pocketmine\network\mcpe\protocol\LevelEventPacket;
use pocketmine\Player;
use pocketmine\utils\TextFormat as f;
use pocketmine\utils\Config;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\enchantment\EnchantmentInstance;

class BWListener
{

	protected $plugin;

	public function __construct(Main $plugin)
	{

		$this->plugin = $plugin;

	}

	public function count(Player $player, int $id = Item::BRICK): int{
		$all = 0;
		$inv = $player->getInventory();
		$content = $inv->getContents();
		foreach ($content as $item) {
			if ($item->getId() == $id) {
				$c = $item->count;
				$all = $all + $c;
			}
		}
		return $all;
	}
	public function rm(Player $player, int $id = Item::BRICK){
		$player->getInventory()->remove(Item::get($id, 0, 1));
	}
	public function add(Player $player, int $i, int $id = Item::BRICK){
		$name = $player->getName();
		$inv = $player->getInventory();
		$c = 0;
		while($c < $i){
			$inv->addItem(
				Item::get(
					$id,
					0,
					1));
			$c++;
		}
	}

	public function setPrice(Player $player, int $price, int $id) : bool {
		$woola = $this->count($player, $id);
		$name = $player->getName();
		if($woola < $price) {
			$need = (int)$price - (int)$woola;
			return false;
		} else {
			$woolprice = $price;
			$wooltot = $woola-$woolprice;
			$this->rm($player, $id);
			$this->add($player, $wooltot, $id);
			return true;}
	}

	public function onTransaction(Player $player, Item $itemClickedOn, Item $itemClickedWith): bool
	{
		// KATEGORIEN
		if($itemClickedOn->getCustomName() == f::YELLOW."Schwitzer Kategorie") {
			$this->plugin->Overview($player);
		}
		if($itemClickedOn->getCustomName() == f::YELLOW."Block Kategorie") {
			$this->plugin->Bau($player);
		}
		if($itemClickedOn->getCustomName() == f::YELLOW."Rüstungs Kategorie") {
			$this->plugin->Battle($player);
		}
		if($itemClickedOn->getCustomName() == f::YELLOW."Kampf Kategorie") {
			$this->plugin->Ruestung($player);
		}
		if($itemClickedOn->getCustomName() == f::YELLOW."Spielereien") {
			$this->plugin->Extra($player);
		}


		if($itemClickedOn->getCustomName() == f::YELLOW."1x".f::WHITE." Stick".f::RED." 8 Bronze") {
			$price = $this->setPrice($player, 8, Item::BRICK);
			if($price == true) {
				$item = Item::get($itemClickedOn->getId(),$itemClickedOn->getDamage(), $itemClickedOn->getCount());
				$item->setCustomName($item->getVanillaName());
				$enchantment = Enchantment::getEnchantment(Enchantment::KNOCKBACK);
				$item->addEnchantment(new EnchantmentInstance($enchantment, 1));
				$player->getInventory()->addItem($item);
				return true;
			} else {
				$player->sendMessage(f::RED."Nicht genug Ressourcen!");
				$player->sendPopup(f::RED."Nicht genug Ressourcen");
				return false;
			}
		}
		if($itemClickedOn->getCustomName() == f::YELLOW."1x".f::WHITE." Spitzhacke".f::RED." 4 Bronze") {
			$price = $this->setPrice($player, 4, Item::BRICK);
			if($price == true) {
				$item = Item::get($itemClickedOn->getId(),$itemClickedOn->getDamage(), $itemClickedOn->getCount());
				$item->setCustomName($item->getVanillaName());
				$enchantment = Enchantment::getEnchantment(Enchantment::EFFICIENCY);
				$item->addEnchantment(new EnchantmentInstance($enchantment, 1));
				$enchantment = Enchantment::getEnchantment(Enchantment::UNBREAKING);
				$item->addEnchantment(new EnchantmentInstance($enchantment, 2));
				$player->getInventory()->addItem($item);
				return true;
			} else {
				$player->sendMessage(f::RED."Nicht genug Ressourcen!");
				$player->sendPopup(f::RED."Nicht genug Ressourcen");
				return false;
			}
		}
		if($itemClickedOn->getCustomName() == f::YELLOW."16x".f::WHITE." Sandstein".f::RED." 4 Bronze") {
			$price = $this->setPrice($player, 4, Item::BRICK);
			if($price == true) {
				$item = Item::get($itemClickedOn->getId(),$itemClickedOn->getDamage(), $itemClickedOn->getCount());
				$item->setCustomName($item->getVanillaName());
				//$enchantment = Enchantment::getEnchantment(Enchantment::KNOCKBACK);
				//$item->addEnchantment(new EnchantmentInstance($enchantment, 1));
				$player->getInventory()->addItem($item);
				return true;
			} else {
				$player->sendMessage(f::RED."Nicht genug Ressourcen!");
				$player->sendPopup(f::RED."Nicht genug Ressourcen");
				return false;
			}
		}
		if($itemClickedOn->getCustomName() == f::YELLOW."4x".f::WHITE." Sandstein".f::RED." 1 Bronze") {
			$price = $this->setPrice($player, 1, Item::BRICK);
			if($price == true) {
				$item = Item::get($itemClickedOn->getId(),$itemClickedOn->getDamage(), $itemClickedOn->getCount());
				$item->setCustomName($item->getVanillaName());
				//$enchantment = Enchantment::getEnchantment(Enchantment::KNOCKBACK);
				//$item->addEnchantment(new EnchantmentInstance($enchantment, 1));
				$player->getInventory()->addItem($item);
				return true;
			} else {
				$player->sendMessage(f::RED."Nicht genug Ressourcen!");
				$player->sendPopup(f::RED."Nicht genug Ressourcen");
				return false;
			}
		}
		if($itemClickedOn->getCustomName() == f::YELLOW."64x".f::WHITE." Sandstein".f::RED." 16 Bronze") {
			$price = $this->setPrice($player, 16, Item::BRICK);
			if($price == true) {
				$item = Item::get($itemClickedOn->getId(),$itemClickedOn->getDamage(), $itemClickedOn->getCount());
				$item->setCustomName($item->getVanillaName());
				//$enchantment = Enchantment::getEnchantment(Enchantment::KNOCKBACK);
				//$item->addEnchantment(new EnchantmentInstance($enchantment, 1));
				$player->getInventory()->addItem($item);
				return true;
			} else {
				$player->sendMessage(f::RED."Nicht genug Ressourcen!");
				$player->sendPopup(f::RED."Nicht genug Ressourcen");
				return false;
			}
		}
		if($itemClickedOn->getCustomName() == f::YELLOW."1x".f::WHITE." Endstone".f::RED." 16 Bronze") {
			$price = $this->setPrice($player, 16, Item::BRICK);
			if($price == true) {
				$item = Item::get($itemClickedOn->getId(),$itemClickedOn->getDamage(), $itemClickedOn->getCount());
				$item->setCustomName($item->getVanillaName());
				//$enchantment = Enchantment::getEnchantment(Enchantment::KNOCKBACK);
				//$item->addEnchantment(new EnchantmentInstance($enchantment, 1));
				$player->getInventory()->addItem($item);
				return true;
			} else {
				$player->sendMessage(f::RED."Nicht genug Ressourcen!");
				$player->sendPopup(f::RED."Nicht genug Ressourcen");
				return false;
			}
		}
		if($itemClickedOn->getCustomName() == f::YELLOW."1x".f::WHITE." Cobweb".f::RED." 8 Bronze") {
			$price = $this->setPrice($player, 8, Item::BRICK);
			if($price == true) {
				$item = Item::get($itemClickedOn->getId(),$itemClickedOn->getDamage(), $itemClickedOn->getCount());
				$item->setCustomName($item->getVanillaName());
				//$enchantment = Enchantment::getEnchantment(Enchantment::KNOCKBACK);
				//$item->addEnchantment(new EnchantmentInstance($enchantment, 1));
				$player->getInventory()->addItem($item);
				return true;
			} else {
				$player->sendMessage(f::RED."Nicht genug Ressourcen!");
				$player->sendPopup(f::RED."Nicht genug Ressourcen");
				return false;
			}
		}
		if($itemClickedOn->getCustomName() == f::YELLOW."1x".f::WHITE." Schwert - 1".f::GRAY." 1 Eisen") {
			$price = $this->setPrice($player, 1, Item::IRON_INGOT);
			if($price == true) {
				$item = Item::get($itemClickedOn->getId(),$itemClickedOn->getDamage(), $itemClickedOn->getCount());
				$item->setCustomName($item->getVanillaName());
				$enchantment = Enchantment::getEnchantment(Enchantment::SHARPNESS);
				$item->addEnchantment(new EnchantmentInstance($enchantment, 1));
				$enchantment = Enchantment::getEnchantment(Enchantment::UNBREAKING);
				$item->addEnchantment(new EnchantmentInstance($enchantment, 2));
				$player->getInventory()->addItem($item);
				return true;
			} else {
				$player->sendMessage(f::RED."Nicht genug Ressourcen!");
				$player->sendPopup(f::RED."Nicht genug Ressourcen");
				return false;
			}
		}
		if($itemClickedOn->getCustomName() == f::YELLOW."1x".f::WHITE." Rüstung - 1".f::GRAY." 1 Eisen") {
			$price = $this->setPrice($player, 1, Item::IRON_INGOT);
			if($price == true) {
				$item = Item::get($itemClickedOn->getId(),$itemClickedOn->getDamage(), $itemClickedOn->getCount());
				$item->setCustomName($item->getVanillaName());
				$enchantment = Enchantment::getEnchantment(Enchantment::PROTECTION);
				$item->addEnchantment(new EnchantmentInstance($enchantment, 1));
				$player->getInventory()->addItem($item);
				return true;
			} else {
				$player->sendMessage(f::RED."Nicht genug Ressourcen!");
				$player->sendPopup(f::RED."Nicht genug Ressourcen");
				return false;
			}
		}
		if($itemClickedOn->getCustomName() == f::YELLOW."1x".f::WHITE." Kappe".f::RED." 1 Bronze") {
			$price = $this->setPrice($player, 1, Item::BRICK);
			if($price == true) {
				$item = Item::get($itemClickedOn->getId(),$itemClickedOn->getDamage(), $itemClickedOn->getCount());
				$item->setCustomName($item->getVanillaName());
				$enchantment = Enchantment::getEnchantment(Enchantment::PROTECTION);
				$item->addEnchantment(new EnchantmentInstance($enchantment, 1));
				$player->getInventory()->addItem($item);
				return true;
			} else {
				$player->sendMessage(f::RED."Nicht genug Ressourcen!");
				$player->sendPopup(f::RED."Nicht genug Ressourcen");
				return false;
			}
		}
		if($itemClickedOn->getCustomName() == f::YELLOW."1x".f::WHITE." Hose".f::RED." 1 Bronze") {
			$price = $this->setPrice($player, 1, Item::BRICK);
			if($price == true) {
				$item = Item::get($itemClickedOn->getId(),$itemClickedOn->getDamage(), $itemClickedOn->getCount());
				$item->setCustomName($item->getVanillaName());
				$enchantment = Enchantment::getEnchantment(Enchantment::PROTECTION);
				$item->addEnchantment(new EnchantmentInstance($enchantment, 1));
				$player->getInventory()->addItem($item);
				return true;
			} else {
				$player->sendMessage(f::RED."Nicht genug Ressourcen!");
				$player->sendPopup(f::RED."Nicht genug Ressourcen");
				return false;
			}
		}
		if($itemClickedOn->getCustomName() == f::YELLOW."1x".f::WHITE." Schuhe".f::RED." 1 Bronze") {
			$price = $this->setPrice($player, 1, Item::BRICK);
			if($price == true) {
				$item = Item::get($itemClickedOn->getId(),$itemClickedOn->getDamage(), $itemClickedOn->getCount());
				$item->setCustomName($item->getVanillaName());
				$enchantment = Enchantment::getEnchantment(Enchantment::PROTECTION);
				$item->addEnchantment(new EnchantmentInstance($enchantment, 1));
				$player->getInventory()->addItem($item);
				return true;
			} else {
				$player->sendMessage(f::RED."Nicht genug Ressourcen!");
				$player->sendPopup(f::RED."Nicht genug Ressourcen");
				return false;
			}
		}
		if($itemClickedOn->getCustomName() == f::YELLOW."1x".f::WHITE." Rüstung - 2".f::GRAY." 3 Eisen") {
			$price = $this->setPrice($player, 3, Item::IRON_INGOT);
			if($price == true) {
				$item = Item::get($itemClickedOn->getId(),$itemClickedOn->getDamage(), $itemClickedOn->getCount());
				$item->setCustomName($item->getVanillaName());
				$enchantment = Enchantment::getEnchantment(Enchantment::PROTECTION);
				$item->addEnchantment(new EnchantmentInstance($enchantment, 2));
				$player->getInventory()->addItem($item);
				return true;
			} else {
				$player->sendMessage(f::RED."Nicht genug Ressourcen!");
				$player->sendPopup(f::RED."Nicht genug Ressourcen");
				return false;
			}
		}
		if($itemClickedOn->getCustomName() == f::YELLOW."1x".f::WHITE." Rüstung - 3".f::GRAY." 7 Eisen") {
			$price = $this->setPrice($player, 7, Item::IRON_INGOT);
			if($price == true) {
				$item = Item::get($itemClickedOn->getId(),$itemClickedOn->getDamage(), $itemClickedOn->getCount());
				$item->setCustomName($item->getVanillaName());
				$enchantment = Enchantment::getEnchantment(Enchantment::PROTECTION);
				$item->addEnchantment(new EnchantmentInstance($enchantment, 3));
				$player->getInventory()->addItem($item);
				return true;
			} else {
				$player->sendMessage(f::RED."Nicht genug Ressourcen!");
				$player->sendPopup(f::RED."Nicht genug Ressourcen");
				return false;
			}
		}
		if($itemClickedOn->getCustomName() == f::YELLOW."1x".f::WHITE." Schwert - 2".f::GRAY." 3 Eisen") {
			$price = $this->setPrice($player, 3, Item::IRON_INGOT);
			if($price == true) {
				$item = Item::get($itemClickedOn->getId(),$itemClickedOn->getDamage(), $itemClickedOn->getCount());
				$item->setCustomName($item->getVanillaName());
				$enchantment = Enchantment::getEnchantment(Enchantment::SHARPNESS);
				$item->addEnchantment(new EnchantmentInstance($enchantment, 2));
				$enchantment = Enchantment::getEnchantment(Enchantment::UNBREAKING);
				$item->addEnchantment(new EnchantmentInstance($enchantment, 3));
				$player->getInventory()->addItem($item);
				return true;
			} else {
				$player->sendMessage(f::RED."Nicht genug Ressourcen!");
				$player->sendPopup(f::RED."Nicht genug Ressourcen");
				return false;
			}
		}
		if($itemClickedOn->getCustomName() == f::YELLOW."1x".f::WHITE." Schwert - 3".f::GRAY." 8 Eisen") {
			$price = $this->setPrice($player, 8, Item::IRON_INGOT);
			if($price == true) {
				$item = Item::get($itemClickedOn->getId(),$itemClickedOn->getDamage(), $itemClickedOn->getCount());
				$item->setCustomName($item->getVanillaName());
				$enchantment = Enchantment::getEnchantment(Enchantment::SHARPNESS);
				$item->addEnchantment(new EnchantmentInstance($enchantment, 3));
				$enchantment = Enchantment::getEnchantment(Enchantment::UNBREAKING);
				$item->addEnchantment(new EnchantmentInstance($enchantment, 4));
				$player->getInventory()->addItem($item);
				return true;
			} else {
				$player->sendMessage(f::RED."Nicht genug Ressourcen!");
				$player->sendPopup(f::RED."Nicht genug Ressourcen");
				return false;
			}
		}
		if($itemClickedOn->getCustomName() == f::YELLOW."1x".f::WHITE." Bogen - 1".f::GOLD." 4 Gold") {
			$price = $this->setPrice($player, 4, Item::GOLD_INGOT);
			if($price == true) {
				$item = Item::get($itemClickedOn->getId(),250, $itemClickedOn->getCount());
				$item->setCustomName($item->getVanillaName());
				$enchantment = Enchantment::getEnchantment(Enchantment::PUNCH);
				$item->addEnchantment(new EnchantmentInstance($enchantment, 1));
				$enchantment = Enchantment::getEnchantment(Enchantment::INFINITY);
				$item->addEnchantment(new EnchantmentInstance($enchantment, 4));
				$player->getInventory()->addItem($item);
				$player->getInventory()->addItem(Item::get(Item::ARROW,0, 1));
				return true;
			} else {
				$player->sendMessage(f::RED."Nicht genug Ressourcen!");
				$player->sendPopup(f::RED."Nicht genug Ressourcen");
				return false;
			}
		}
		if($itemClickedOn->getCustomName() == f::YELLOW."1x".f::WHITE." Enderperle".f::GOLD." 12 Gold") {
			$price = $this->setPrice($player, 12, Item::GOLD_INGOT);
			if($price == true) {
				$item = Item::get($itemClickedOn->getId(),10, $itemClickedOn->getCount());
				$item->setCustomName($item->getVanillaName());
				$enchantment = Enchantment::getEnchantment(Enchantment::PUNCH);
				$item->addEnchantment(new EnchantmentInstance($enchantment, 1));
				$enchantment = Enchantment::getEnchantment(Enchantment::INFINITY);
				$item->addEnchantment(new EnchantmentInstance($enchantment, 4));
				$player->getInventory()->addItem($item);
				return true;
			} else {
				$player->sendMessage(f::RED."Nicht genug Ressourcen!");
				$player->sendPopup(f::RED."Nicht genug Ressourcen");
				return false;
			}
		}
		if($itemClickedOn->getCustomName() == f::YELLOW."1x".f::WHITE." TNT".f::GOLD." 2 Gold") {
			$price = $this->setPrice($player, 2, Item::GOLD_INGOT);
			if($price == true) {
				$item = Item::get($itemClickedOn->getId(),$itemClickedOn->getDamage(), $itemClickedOn->getCount());
				$item->setCustomName($item->getVanillaName());
				$player->getInventory()->addItem($item);
				return true;
			} else {
				$player->sendMessage(f::RED."Nicht genug Ressourcen!");
				$player->sendPopup(f::RED."Nicht genug Ressourcen");
				return false;
			}
		}
		if($itemClickedOn->getCustomName() == f::YELLOW."1x".f::WHITE." Feuerzeug".f::GRAY." 5 Eisen") {
			$price = $this->setPrice($player, 5, Item::IRON_INGOT);
			if($price == true) {
				$item = Item::get($itemClickedOn->getId(),$itemClickedOn->getDamage(), $itemClickedOn->getCount());
				$item->setCustomName($item->getVanillaName());
				$player->getInventory()->addItem($item);
				return true;
			} else {
				$player->sendMessage(f::RED."Nicht genug Ressourcen!");
				$player->sendPopup(f::RED."Nicht genug Ressourcen");
				return false;
			}
		}
		if($itemClickedOn->getCustomName() == f::YELLOW."1x".f::WHITE." Rettungs Platform".f::GOLD." 6 Gold") {
			$price = $this->setPrice($player, 6, Item::GOLD_INGOT);
			if($price == true) {
				$item = Item::get($itemClickedOn->getId(),$itemClickedOn->getDamage(), $itemClickedOn->getCount());
				$item->setCustomName($item->getVanillaName());
				$enchantment = Enchantment::getEnchantment(Enchantment::PUNCH);
				$item->addEnchantment(new EnchantmentInstance($enchantment, 1));
				$enchantment = Enchantment::getEnchantment(Enchantment::INFINITY);
				$item->addEnchantment(new EnchantmentInstance($enchantment, 4));
				$player->getInventory()->addItem($item);
				return true;
			} else {
				$player->sendMessage(f::RED."Nicht genug Ressourcen!");
				$player->sendPopup(f::RED."Nicht genug Ressourcen");
				return false;
			}
		}
		return false;
	}
}

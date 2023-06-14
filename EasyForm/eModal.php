<?php

declare(strict_types=1);

namespace TR8697\EasyForm;

use pocketmine\player\Player;
use pocketmine\Server;
use jojoe77777\FormAPI\SimpleForm;
use jojoe77777\FormAPI\ModalForm;
use jojoe77777\FormAPI\CustomForm;

class eModal
{
    public static function createModal(Player $player, string $title, ?string $content, array $buttons, callable $action): ModalForm
    {
        $modalForm = new ModalForm(function (Player $player, bool $data) use ($action) {
            $action($data);
        });

        $modalForm->setTitle($title);

        if (!is_null($content)) {
            $modalForm->setContent($content);
        }

        $modalForm->setButton1($buttons[0]);
        $modalForm->setButton2($buttons[1]);

        $modalForm->sendToPlayer($player);

        return $modalForm;
    }
}
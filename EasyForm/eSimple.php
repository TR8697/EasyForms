<?php

declare(strict_types=1);

namespace TR8697\EasyForm;

use pocketmine\player\Player;
use pocketmine\Server;
use jojoe77777\FormAPI\SimpleForm;
use jojoe77777\FormAPI\ModalForm;
use jojoe77777\FormAPI\CustomForm;

class eSimple
{
    private $buttonNames = [];

    public function __construct(Player $player, string $title, ?string $content, array $buttons, callable $action, bool $nullCheck = true)
    {
        $form = new SimpleForm(function (Player $player, ?int $data) use ($action, $nullCheck) {
            if ($nullCheck && $data === null) {
                return true;
            }

            $buttonName = $this->buttonNames[$data] ?? '';
            $action($data, $buttonName);
        });

        $form->setTitle($title);

        if (!is_null($content)) {
            $form->setContent($content);
        }

        foreach ($buttons as $button => $value) {
            if (isset($value['url'])) {
                $form->addButton($button, 0, $value['url']);
                $this->buttonNames[] = $button;
            } else {
                $this->buttonNames[] = $value;
                $form->addButton($value);
            }
        }

        $form->sendToPlayer($player);
    }
}

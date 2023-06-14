<?php

declare(strict_types=1);

namespace TR8697\EasyForm;

use pocketmine\player\Player;
use pocketmine\Server;
use jojoe77777\FormAPI\SimpleForm;
use jojoe77777\FormAPI\ModalForm;
use jojoe77777\FormAPI\CustomForm;

class eCustom
{
    public function __construct(Player $player, string $title, array $elements, callable $action, bool $nullable = true)
    {
        $form = new CustomForm(function (Player $player, ?array $data) use ($action, $nullable) {
            if ($nullable && $data === null) {
                return;
            }
            $action($data);
        });

        $form->setTitle($title);

        foreach ($elements as $element) {
            $type = $element['type'];
            $name = $element['name'];
            $default = $element['default'] ?? null;
            $options = $element['options'] ?? null;
            $placeholder = $element['placeholder'] ?? null;
            $min = $element['min'] ?? null;
            $max = $element['max'] ?? null;
            $step = $element['step'] ?? null;

            switch ($type) {
                case 'label':
                    $form->addLabel($name);
                    break;
                case 'input':
                    $form->addInput($name, $placeholder, $default);
                    break;
                case 'toggle':
                    $form->addToggle($name, (bool)$default);
                    break;
                case 'dropdown':
                    $form->addDropdown($name, $options, $default);
                    break;
                case 'slider':
                    $form->addSlider($name, $min, $max, $default);
                    break;
                case 'step_slider':
                    $form->addStepSlider($name, $options, $default);
                    break;
                default:
                    break;
            }
        }

        $form->sendToPlayer($player);
    }
}

# EasyForm

EasyForm is a library for creating and handling forms in PocketMine-MP plugins. It provides a simple and convenient way to create different types of forms and handle user input.

## Installation

To use EasyForm in your PocketMine-MP plugin, you can follow these steps:

1. Download the `EasyForm` library from [GitHub](https://github.com/TR8697/EasyForms).
2. Place the `EasyForm` folder in the `plugins` directory of your PocketMine-MP server.
3. In your plugin code, include the necessary classes using the `use` statement.

## Usage

### Simple Form

To create a simple form, you can use the `eSimple` class. Here's an example:

public function testForm(Player $player): void {
    $title = "";
    $content = "";
    $buttons = ["Button1", "Button2"];
    $action = function (?int $data, string $buttonName) use ($player) {
        if ($data === null) {
            return true;
        }
        switch ($data) {
            case 0:
                break;

            case 1:
                break;
        }
    };

    new eSimple($player, $title, $content, $buttons, $action);
}



To use the `eCustom` class and create custom forms, you can include the following code in your project:

use TR8697\EasyForm\eCustom;
use pocketmine\player\Player;

// Example usage of eCustom form
function showCustomForm(Player $player): void {
    $title = "My Custom Form";
    $elements = [
        ["type" => "label", "name" => "Welcome to my custom form!"],
        ["type" => "input", "name" => "Enter your name:", "placeholder" => "Player name"],
        ["type" => "toggle", "name" => "Enable something:", "default" => true],
        ["type" => "dropdown", "name" => "Select an option:", "options" => ["Option 1", "Option 2", "Option 3"], "default" => 0],
        ["type" => "slider", "name" => "Choose a value:", "min" => 0, "max" => 10, "default" => 5],
    ];
    $action = function (?array $data) use ($player) {
        if ($data !== null) {
            // Process the form data
            $name = $data[1] ?? "";
            $enableSomething = (bool) ($data[2] ?? false);
            $selectedOption = $data[3] ?? "";
            $sliderValue = $data[4] ?? 0;

            // Handle the form submission
            // ...
        }
    };

    new eCustom($player, $title, $elements, $action);
}
To use the `eModel` class and create model forms, you can include the following code in your project:
// Example usage of eCustom form

use TR8697\EasyForm\eModal;
use pocketmine\player\Player;

function showConfirmationModal(Player $player): void {
    $title = "Confirmation";
    $content = "Are you sure you want to continue?";
    $buttons = ["Yes", "No"];
    $action = function (bool $data) use ($player) {
        if ($data) {
            // Yes button was clicked
            // Handle the confirmation
            $player->sendMessage("Confirmed!");
        } else {
            // No button was clicked
            // Handle the cancellation
            $player->sendMessage("Cancelled!");
        }
    };

    eModal::createModal($player, $title, $content, $buttons, $action);
}

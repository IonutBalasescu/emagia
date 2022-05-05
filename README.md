# Emag's hero
This is my version of the game with an interactive output of the fights.
The project is scalable as you can add more Heroes and Beasts, skills and strategies to use the skills.

Prerequisites:
  - php >= 7.4
  - phpunit >= 7.0

I did not use any frameworks for the project, I used plain php and a few more features you can find in composer.json.

How to run:
  1) composer install
  2) php index.php

The game will start by showing the stats of the two fighters, one by one and then choose the first attacker by comparing their relevant stats(speed, luck).
After that, the battle begins and each dueler will have the chance to attack, and then defend.
The winner is announced if the other fighter's health is less than 1, otherwise the game is considered draw.


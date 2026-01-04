<?php

require 'vendor/autoload.php';

$app = new Rteeom\FlagsGenerator();

echo $app->getEmojiFlag('ua');
echo $app->getEmojiFlagOrNull('ua');

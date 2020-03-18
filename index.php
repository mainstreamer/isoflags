<?php

require 'vendor/autoload.php';

$app = new \Rteeom\FlagsGenerator(new \Rteeom\CountryCodeValidator());

echo $app->getEmojiFlag('ua');

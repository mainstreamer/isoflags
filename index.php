<?php

require 'vendor/autoload.php';

$app = new \App\FlagsGenerator(new \App\CountryCodeValidator());

echo $app->getEmojiFlag('ua');
# isoflags
[![License](https://poser.pugx.org/rteeom/isoflags/license)](https://packagist.org/packages/rteeom/isoflags) 
[![Latest Stable Version](https://poser.pugx.org/rteeom/isoflags/v/stable)](https://packagist.org/packages/rteeom/isoflags) 
[![Total Downloads](https://poser.pugx.org/rteeom/isoflags/downloads)](https://packagist.org/packages/rteeom/isoflags) 

library for generating emoji flags from iso country codes

### install:
`
composer require rteeom/isoflags
`

### usage:
``` 
require 'vendor/autoload.php';

$generator = new \Rteeom\FlagsGenerator();

echo $generator->getEmojiFlag('ua'); // 🇺🇦

// or 

echo $generator->getEmojiFlagOrNull('ua'); // 🇺🇦
```

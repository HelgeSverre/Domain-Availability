Domain Availability Script
===================

A PHP Class used to check if a domain has been registered.

Created to be fast and easy to use, modify and redistribute as you wish, credit me if appropriate.

## How to install
1. Download DomainAvailability.php
2. Place it in your project folder (I prefer to put it in /lib).
3. include it in your PHP file, look at example.php or the code below.


## Usage:

```php
include ('DomainAvailability.php');  
$Domain = new DomainAvailability();
$available = $Domain->is_available("helgesverre.com");

if ($available) {
    echo "The domain is not registered";
} else {
    echo "The domain is registered";
}
```

To enable full error reporting (E_ALL) when developing/debugging pass true as the only parameter when you are creating a new class instance like so:

```PHP
$Domain = new DomainAvailability(true);
``` 
or look at example.php for an example.

Code by [Helge Sverre](https://helgesverre.com)

Domain Availability Script
===================

A PHP Class used to check if a domain has been registered.

Created to be fast and easy to use, modify and redistribute as you wish, credit me if appropriate.


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
DomainAvailability(TRUE);
``` 
or checkout example.php 

Code by [Helge Sverre](https://helgesverre.com)

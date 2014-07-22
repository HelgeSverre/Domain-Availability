Domain Availability Script
===================

A PHP Class used to check if a domain has been registered


## Usage:

```php
include ('DomainAvailability.php');  
$Domain = new DomainAvailability;  
$available = $Domain->is_available("helgesverre.com");
 
if ($available) {
    echo "The domain is not registered";
} else {
    echo "The domain is registered";
}
```

Script created by [Helge Sverre](https://helgesverre.com)

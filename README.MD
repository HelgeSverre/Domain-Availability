# Domain Availability Script

**Description:** This script was created for the sole purpose of having an easy and quick way to check if a domain is registered.

### Usage 
``` 
include ('DomainAvailability.php');  
$Domain = new DomainAvailability;  
$available = $Domain->is_available("helgesverre.com");
 
if ($available) {
    echo "The domain is not registered";
} else {
    echo "The domain is registered";
}
```
[![Spring Boot](https://www.php.net/images/logos/new-php-logo.svg)](https://spring.io)

-----------------------------------------------------

# PHP | Fast-Food

This is a fast-food application


## Getting Started

Php takes care of everything on the front end.

### Installing

```
git clone https://github.com/Evengelius/php_fastfood.git your_desired_name

// includes/config.inc/php
define ('DSN', 'mysql:dbname=fastfood;host=localhost;charset=utf8');
define ('USER', 'yourUserName');
define ('PASSWORD','yourPassWord');
```

## Functionnalities

**User Management**<br />
Each customer order corresponds to a specific user: the one who orders

**Inventory management**<br />
With each purchase, the quantity of burgers or drinks is decremented per unit corresponding to the quantity chosen

**Order management**<br />
Once an order is done, it appears on the user's profile page with a resume of itself.

**Exception handling**<br />
A 404 page is displayed when the product or page does not exist or is poorly written.




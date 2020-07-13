[![Spring Boot](https://www.php.net/images/logos/new-php-logo.svg)](https://spring.io)

-----------------------------------------------------

# PHP | Fast-Food

This is a fast-food application


## Getting Started

Php takes care of everything on the front end.

<ins>Before going further, please make sure you are processing the repositories in order as follow</ins> : 

* [Php](https://github.com/Evengelius/php_fastfood)<br />
* [Spring](https://github.com/Evengelius/spring_fastfood)<br />
* [Angular](https://github.com/Evengelius/angular_fastfood)<br />

### Installing

```
1. git clone https://github.com/Evengelius/php_fastfood.git your_desired_name

2. Create a database and name it fastfood.
3. Import the SQL file present here, in your database.

4. // includes/config.inc/php
   define ('DSN', 'mysql:dbname=fastfood;host=localhost;charset=utf8');
   define ('USER', 'yourUserName');
   define ('PASSWORD','yourPassWord');

5. Test it.
   (I suggest you to use Laragon for it as it creates virtual hosts automatically).
```

## Functionnalities

**User Management**<br />
Each customer order corresponds to a specific user: the one who orders<br />
Which means, whenever you register : you create a command user.

**Inventory management**<br />
With each purchase, the quantity of burgers or drinks is decremented per unit corresponding to the quantity chosen

**Order management**<br />
Once an order is done, it appears on the user's profile page with a resume of itself.

**Exception handling**<br />
A 404 page is displayed when the product or page does not exist or is poorly written.




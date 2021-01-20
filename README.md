# Food Delivery Website

A multifunctional website which is developed on the MVC pattern. Can let you register and order food [not actually :) ]. 

***Functionalities/Work Flow***
-
- Signup to create a new account and log in
- Search specific restaurant name in the top-right input box
- Filter out specific restaurants by category
- Select restaurant and dishes and add to cart
- Mange cart before confirming order
- Preview PDF file of confirmation
- Leave comment and rate the restaurant which will contribute to generating the most popular restaurant in home page
- Update avatar or personal information in profile page
- SQL binding applied to prevent malicious injection
- ...

***Tech Stacks***
-
***Frontend***
- Language: HTML/CSS/JavaScript
- Framework: AngularJS

***Backend***
- Language: PHP/SQL
- Framework: CodeIgniter
- Database: MySQL
- Backend Visualization Tool: PhpmyAdmin
- Server: Apache

## Getting Started

### Prerequisites
The website used to deploy on the university-provided server which is currently closed. To execute the program locally, please download ```XAMMP 7.2+```. Then click ```Start All``` to launch the database and server once you open the XAMMP.

### Installation
Before opening the webiste in browser, database should be configured by running the script to setup the data which will be displayed on the page.

Open [phpMyAdmin](http://localhost/phpMyAdmin) and create a new database named ```FoodDelivery```. Then running the SQL statements in [script.sql](/data/script.sql).

Once finish, [Let's Eat](http://localhost/home/)

## Others

All restaurant data and images are from [UberEats](https://www.ubereats.com/au).
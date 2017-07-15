## Laravel Ionic Delivery Project

This project was develop for study of Laravel 5.1 and Ionic 1. It is basically a mobile application built with Ionic consuming a REST API built with Laravel.

## Laravel

- ### Install

  To install this application following the instructions below is necessary to have Composer and PHP CLI.

  ```
  git clone https://github.com/deoliveiralucas/laravel-ionic-project.git
  cd laravel-ionic-project
  composer install
  ```

- ### Execute

  Before continue the process, it is important to create and configure the `.env` file, like the `.env.example`.

  ```
  php artisan migrate --seed
  php artisar serve --host=0.0.0.0:8000
  ```

## Ionic

- ### Install

  Inside the same directory where the Laravel application was cloned.

  ```
  cd ionic
  npm install
  bower install
  ```

- ### Execute

  Just set the push notification as development mode, run and access the browser.

  ```
  ionic config set dev_push
  ionic serve
  ```
  
## Screenshots

- Menu with options to user orders and create a new one.

  ![](https://raw.githubusercontent.com/deoliveiralucas/laravel-ionic-delivery-project/master/docs/screenshot1.png) 
  
- List of products that the user has added to the cart with the option to add a coupon discount with QR Code.

  ![](https://raw.githubusercontent.com/deoliveiralucas/laravel-ionic-delivery-project/master/docs/screenshot2.png)

- List of user orders with the option to see more details or to see the delivery.

  ![](https://raw.githubusercontent.com/deoliveiralucas/laravel-ionic-delivery-project/master/docs/screenshot3.png)

- Detail of an order with a map to see where is the delivery man.

  ![](https://raw.githubusercontent.com/deoliveiralucas/laravel-ionic-delivery-project/master/docs/screenshot4.png)

---

<img height="60" align="left" src="https://raw.githubusercontent.com/deoliveiralucas/laravel-ionic-delivery-project/master/docs/laravel.png" />
<img height="60" align="left" src="https://raw.githubusercontent.com/deoliveiralucas/laravel-ionic-delivery-project/master/docs/ionic.png" />
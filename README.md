# IniForum
Requirement:
+ PHP 5.5 <=
+ `AllowOverride All` in apache.conf
+ `short_open_tag=On` in php.ini

![Home Page](https://cloud.githubusercontent.com/assets/10447726/8642643/abcc2330-2951-11e5-9315-9b1d1bcb838d.jpeg "Halaman Utama")
[Home Page]

![Login Page](https://cloud.githubusercontent.com/assets/10447726/8642644/abdc8b76-2951-11e5-83ed-fb1ee3e640c6.jpeg "Login Page")
[Login Page]

![Add Post Page](https://cloud.githubusercontent.com/assets/10447726/8642645/ac248cd2-2951-11e5-9e5d-d6496af219df.jpeg "Add Post Page")
[Add Post Page]

![Mail Page](https://cloud.githubusercontent.com/assets/10447726/8642646/ac331a54-2951-11e5-978a-84aff1a376c1.jpeg "Mail Page")
[Mail Page]

![Admin Dashboard Page](https://cloud.githubusercontent.com/assets/10447726/8642647/ac83111c-2951-11e5-9ca5-5aa14be4067e.jpeg "Admin Dashboard Page")
[Admin Dashboard Page]

# Ngaji Foundation 2.0.1

2.0.1
+ Ditambahkan class QueryBuilder untuk menangani kueri SQL kompleks tanpa melalui Model Class
+ Ditambahkan function __autoloader() pada class Bootstrap2 untuk menangani eksepsi undefined class.
  Eksepsi tersebut dibangkitkan ketika meload class yang dibutuhkan, tetapi class tersebut tidak
  terdaftar pada app/settings.php

  NB: tidak disarankan untuk performa, sebisa mungkin daftarkan class pada settings.php

# Manual penggunaan:
   
1. Ubah dan sesuaikan konfigurasi pada App/setting.php
   File tersebut merupakan konfigurasi fundamental yang dimuat ketika aplikasi web dijalankan.
   
   2.1 Konfigurasi database
   
      `...
      'db' => [
	    'name' => 'nama_database',
    	    'host' => 'host db server, default: localhost',
    	    'user' => 'username akun',
    	    'pass' => 'password akun'
      ],
      ...`
  
   2.2 Daftarkan contoller atau user defined class
       Perlu diketahui bahwa class di daftarkan dengan full path
       
       `'class' => [
           'Ngaji/Routing/Route.php',
           'app/Controllers/UstadzController.php'
           ...
           `
   2.3 Daftarkan model
       Model didaftarkan tanpa full path, tambahkan hanya nama filenya saja.
       
       Misal terdapat model Ustadz di /app/models/Ustadz.php. 
       Untuk mendaftarkannya, tidak perlu menuliskan '/app/models/Ustadz.php' cukup hanya 'Ustadz'
       `
       'models' => [
           'Ustadz',
           ...
           `
       Ketika model digunakan pada contoller, jangan lupa untuk memanggil model tersebut pada App namespace.
       
       contoh:
       pada baris controller paling atas tambahkan
       
       use app\models\Ustadz;
       
       Sehingga:
       
       <?php namespace app\contoller;

       use app\models\Ustadz;
       
       class ControllerName extends Controller {
       
       ....
       
       }

3. Sesuaikan route
   Ngaji/Routing/Route.php merupakan class yang bertugas mengarahkan request dari client. 
   Request tersebut akan ditentukan jalurnya dengan memanggil controller yang sesuai.
   
   $this->router->map('method', 'uri', function () {
            panggil controller disini
        }, '[alias: optional]');
        
   Contoh:

   $this->router->map('GET|POST', '/index.php/login', function () {
            Controller::login();
        }, 'login');
   
   Penjelasan:
   Route '/index.php/login' diatas hanya memperbolehkan method GET dan POST. 
   Ketika route tersebut dipanggil akan dialihkan controller Controller dengan action login.
   Route tersebut memiliki alias 'login'.
   
   NB:
   1. Nama alias route harus unik
   2. Semua route harus melalui index.php, dengan pengecualian
      Benar: /index.php/login tidak benar: /login
      Route tidak bisa bekerja langsung pada URI /login kecuali mengubah konfigurasi pada .htaccess
      
      Untuk mendefinisikan sendiri route /login tanpa melalui index.php
      Tambahkan baris kode dibawah pada file .htaccess(hanya untuk web-service Apache2)
      
      RewriteRule ^login/?$ index.php/login [QSA,L]
   
3. Bekerja dengan Html helpers
   3.1 Html::Load()
       
       Helper ini digunakan pada view untuk memuat file JS, CSS, dan image secara dinamis
       
       Bentuk umum:
       <?= Html::load('[jenis-file]', '[path-file]') ?>
       
       NB: jika file yang dipanggil terdapat pada direkroti default, maka tidak perlu menuliskan path secara lengkap
       
       Adapun direktori default yang diakui:
       CSS: /assets/css
       JS: /assets/js
       IMG: /assets/img
       
       3.1.1 Load CSS dan JS
      	  Contoh 1, terdapat file style.css pada direktori default /assets/css
      	  
      	  <?= Html::load('css', 'style.css') ?>
      	  
      	  Contoh 2, terdapat file angular.js pada direktori /assets/dist/js.
      	  Untuk load gunakan full path(setelah assets) untuk file js tersebut
      	  
      	  <?= Html::load('js', 'dist/js/angular.js') ?>
       
       3.1.2 Load image
          Contoh 1: tanpa atribut
          <?= Html::load('img', 'avatar.png') ?>
          
          Kode diatas akan menghasilkan:
	        <img src="/[hostname-app]/assets/img/avatar.png"/>
	  
          Contoh 2: dengan atribut
      	  <?= Html::load('img', 'avatar.png', [
        		    'class' => 'user-image',
        		    'alt' => 'User Image'
      	      ])
      	  ?>
      	  
      	  Kode diatas akan menghasilkan:
      	  <img src="/[hostname-app]/assets/img/avatar.png" class="user-image" alt="User Image"/>

  3.2 Html::anchor()

      Helper ini digunakan pada view untuk membuat link anchor( a href )
      
      Bentuk umum:
      <?= Html::anchor('/[path]', 'teks', [atribut:optional]) ?>
      
      Contoh:
      <?= Html::anchor('/login', 'Login Disini', [
              'class' => [
                    'btn',
                    'btn-default',
                    'btn-flat'
              ]
          ])
      ?>

      Kode diatas akan menghasilkan:
      <a href="/[hostname-app]/login" class="btn btn-default btn-flat">Login Disini</a>

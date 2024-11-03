<?php 
    namespace Medoo;
    require 'Medoo.php';

    if (null!==('$database')) {
        /* 
        - For Laragon: username='root' / password=''
        - For MAMP: username='root' / password='root'
          */
        $database = new Medoo([
            'type'=>'mysql',
            'host' => 'localhost',
            'database' => 'gameplatform',
            'username' => 'root',
            'password' => ''
        ]);
    }

    
 ?>
<?php

// src/DataFixtures\Faker

namespace App\DataFixtures\Faker;

use \Faker\Provider\Base as BaseProvider;

class GifProvider extends BaseProvider{

    protected static $gif = [
        'https://giphy.com/embed/xT5LMwTUrQLGRVEosE',
       
    ];
    protected static $roleName = [
        'user' ,'administrator'
        
    ];

    protected static $roleString = [
        'ROLE_USER' , 'ROLE_ADMIN'
        
    ];



    public static function roleName(){
        return static::randomElement(static::$roleName);
    }
    public static function roleString(){
        return static::randomElement(static::$roleString);
    }

   

    public static function gif(){
        return static::randomElement(static::$gif);
    }

   
}
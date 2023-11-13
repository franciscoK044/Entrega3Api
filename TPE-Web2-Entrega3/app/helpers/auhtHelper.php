<?php

    class AuthHelper{

        public static function init(){
            if (session_status() != PHP_SESSION_ACTIVE){
                session_start();
            }
        }

        public static function login($user){
            AuthHelper::init();
            $_SESSION['id_user'] = $user->id_user;
            $_SESSION['email'] = $user->email;
        }

        public static function logout(){
            AuthHelper::init();
            session_destroy();
        }

        public static function verify(){
            AuthHelper::init();
            if (!isset($_SESSION['id_user'])){
                header('Location: ' .BASE_URL. '/login');
                die();
            }
        }
    }
<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2015/10/6
 * Time: 23:12
 */
class RegisterView{

    private static $registerURL = "register";
    private static $register = "RegisterView::Register";
    private static $message = "RegisterView::Message";
    private static $user ="RegisterView::UserName";
    private static $pass = "RegisterView::Password";
    private static $passRepeat = "RegisterView::PasswordRepeat";
    private static $sessionSaveLocation;

    public function __construct() {
        self::$sessionSaveLocation .= Settings::APP_SESSION_NAME;
    }

    public function userClickedOnRegister(){
        return isset($_GET[self::$registerURL]);
    }
    public function getRegisterLink(){
        return '<a href="?' . self::$registerURL . '">Register a new user</a>';
    }
    public function getLoginLink(){
        return '<a href="?">Back to login</a>';
    }
    private function doRegisterForm(){
        $message = "";
        return $this->generateRegisterForm($message);
    }
    private function generateRegisterForm($message){
        return '<h2>Register new user</h2>
                <form action="?register" method="post" enctype="multipart/form-data">
                    <fieldset>
                    <legend>Register a new user - Write username and password</legend>
                        <p id="'.self::$message.'">'.$message.'</p>
                        <label for="'.self::$user.'">Username :</label>
                        <input type="text" size="15" name="'.self::$user.'" id="'.self::$user.'" value="'.$this->getUserName().'">
                        <br>
                        <label for="'.self::$pass.'">Password  :</label>
                        <input type="password" size="15" name="'.self::$pass.'" id="'.self::$pass.'" value="">
                        <br>
                        <label for="'.self::$passRepeat.'">Repeat password  :</label>
                        <input type="password" size="15" name="'.self::$passRepeat.'" id="'.self::$passRepeat.'" value="">
                        <br>
                        <input id="submit" type="submit" name="'.self::$register.'" value="Register">
                        <br>
                    </fieldset>
                </form>';
    }
    public function response(){
        return $this->doRegisterForm();
    }
    public function getUserName(){
        if(isset($_POST[self::$user])){
            return $_POST[self::$user];
        }
    }
}
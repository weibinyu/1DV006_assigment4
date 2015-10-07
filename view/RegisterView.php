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
    private static $password = "RegisterView::Password";
    private static $passwordRepeat = "RegisterView::PasswordRepeat";
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
        if($this-> registerBottomClicked()){
            if(strlen($this->getUserName()) < 3)
                $message .= "Username has too few characters, at least 3 characters.";
            if(strlen($this->getPassword()) < 6)
                $message .= "Password has too few characters, at least 6 characters.";
            if($this->getPassword() !== $this->getPasswordRepeat())
                $message .= "Passwords do not match.";
            //tempory solution,does not work when user are more than one
            //TODO: handle this else every with other solution
            if($this->getUserName() === Settings::USERNAME){
                $message .= "User exists, pick another username.";
            }

        }
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
                        <label for="'.self::$password.'">Password  :</label>
                        <input type="password" size="15" name="'.self::$password.'" id="'.self::$password.'" value="">
                        <br>
                        <label for="'.self::$passwordRepeat.'">Repeat password  :</label>
                        <input type="password" size="15" name="'.self::$passwordRepeat.'" id="'.self::$passwordRepeat.'" value="">
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
    public function getPassword(){
        if(isset($_POST[self::$password])){
            return $_POST[self::$password];
        }
    }
    public function getPasswordRepeat(){
        if(isset($_POST[self::$passwordRepeat])){
            return $_POST[self::$passwordRepeat];
        }
    }
    public function registerBottomClicked(){
        return isset($_POST[self::$register]);
    }
}
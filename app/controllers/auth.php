<?php
class auth {
    protected $user = [
        "huydv" => "123456",
        "admin" => "123456"
    ];

    public function login(){
        session_start();

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $username = $_POST['username'];
            $password = $_POST['password'];

            if(isset($this->user[$username]) && $this->user[$username] == $password){
                
                $_SESSION['username'] = $username;
                if(isset($_POST['remember']) && $_POST['remember']==true){
                    setcookie('username', $username, time()+3600);
                }
                header("Location: http://localhost/PMNM_68PM3_DoanVietHuy_0013568/public/home/index");
                exit();
                
            } else {
                header("Location: http://localhost/PMNM_68PM3_DoanVietHuy_0013568/public/auth/login?error=1");
                exit();
            }
        } 
        else {
            require_once '../app/views/home/login.php';
        }
    }
}
?>
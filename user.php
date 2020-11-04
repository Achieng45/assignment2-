<?php
include_once './Account.php';
class User implements Account{
	private $First_name;
	private $Second_name;
	private $Email_address;
	private $Residence;
	private $Password;
	
	public function __construct(){
     	
     }
     public function setFirst_name($fname){
     	$this->First_name = $fname;
     }
     public function getFirst_name(){
     	return $this->First_name;
     }
     public function setSecond_name($sname){
     	$this->Second_name=$sname;
     }
     public function getSecond_name(){
     	return $this->Second_name;
     }
     public function setEmail_address($email){
        $this->Email_address=$email;
     }
     public function getEmail_address(){
     	return $this->Email_address;
     }
     public function setResidence($residence){
         $this->Residence=$residence;
     }
     public function getResidence(){
        return $this->Residence;
     }
     public function setPassword($password){
     	$this->Password=$password;
     }
     public function getPassword(){
     	return $this->Password;
     }
     public function setPassword2($Password2){
        $this->Password2=$Password2;
     }
     public function getPassword2(){
        return $this->Password2;
        
     }
     
     
     

	
	public function login($pdo){
      
           session_start();
        $Password = $this->getPassword();
        $Email_address = $this->getEmail_address();
        $sql = "SELECT * FROM account WHERE Email_address=?";
        $stmt =$pdo->prepare($sql);
        $stmt->execute([$Email_address]);
        $result=$stmt->fetch();
        //print_r($result);
        if(empty($result)){
            echo '<script>alert("Invalid credentials")</script>';
            echo '<script>window.location="login.php"</script>';
        }else{
                if (password_verify($Password, $result['Password'])) {
                    $_SESSION['Email_address'] = $result['Email_address'];
                    echo '<script>alert("Login successful")</script>';
                    echo '<script>window.location="login_success.php"</script>';
                }else{
                    echo '<script>alert("Wrong credentials")</script>';
                    echo '<script>window.location="login.php"</script>';
                }
            }

 
    }

	public function register($pdo){
		$hashedPassword = password_hash($this->getPassword(), PASSWORD_DEFAULT);
		try{
			$stm = $pdo->prepare("insert into account(First_name,Second_name,Email_address,Residence,Password)values(?,?,?,?,?)");
            $stm->execute([$this->getFirst_name(),$this->getSecond_name(),$this->getEmail_address(),$this->getResidence(),$hashedPassword]);
            $stm = null;
			return "Registration was succsessfull";

		}catch(PDOException $ex){
			return $ex->getMesage();
		}

	}
    public function changepassword($pdo){
        $Email_address= $this->getEmail_address();
        $Password = $this->getPassword();
        $Password2 = $this->getPassword2();
        $sql = "SELECT * FROM account WHERE Email_address=?";
        $stmt =$pdo->prepare($sql);
        $stmt->execute([$Email_address]);
        $result=$stmt->fetch();
        if (password_verify($Password, $result['Password'])){
            $passNew = password_hash($Password2, PASSWORD_DEFAULT);
            $sql2 = "UPDATE account SET Password = '".$passNew. "' WHERE Email_address = ?";
            $stmt2=$pdo->prepare($sql2);
            $stmt2->execute([$Email_address]);
            $stmt2 = null;
            echo '<script>alert("Password Changed")</script>';
            echo '<script>window.location="login_success.php"</script>';

        }else{
            echo '<script>alert("Wrong Password")</script>';
            echo '<script>window.location="password_change.php"</script>';
        }

    }
    public function logout($pdo){
        if(isset($_SESSION['Email_address'])){
            session_destroy();
            echo '<script>alert("Log out successful. Log in again")</script>';
            echo '<script>window.location="login.php"</script>';
        }else{
            echo '<script>alert("Authentication Error. Log in again")</script>';
            echo '<script>window.location="login.php"</script>';
        }

    }
  public function __destruct(){
    }
public function getDetails($pdo){
        $Email_address= $this->getEmail_address();
        $sql = "SELECT * FROM account WHERE Email_address=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$Email_address]);
        $result=$stmt->fetch();
        $stmt = null;

        return $result;


    }
    
}
?>
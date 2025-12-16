<?php 
    include("database.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
        <h2>Login</h2>
        username : <br>
        <input type="text" name="username"><br>
        password : <br> 
        <input type="password" name="password"><br> 
        <input type="submit" name="submit" value="register">
    </form>
</body>
</html>

<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS); 

        if(empty($username)){
            echo "Masukkan username"; 
        }elseif(empty($password)){
            echo "Masukkan password";
        } else {
            
            $sql = "SELECT password FROM users WHERE user = '$username'"; 
            $result = mysqli_query($conn, $sql); 

            if(mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_assoc($result); 
                
                if(password_verify($password, $row["password"])){
                    echo "Login Berhasil loh ya"; 
                } else {
                    echo "Password atau nama tidak sesuai "; 
                }
                

            } else {
                echo "Database kosong"; 
            }            
        }
    }
    mysqli_close($conn); 
?>


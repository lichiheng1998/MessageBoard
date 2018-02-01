<?php
include "../singleton/My_db.php";
include "../db_tools/db_connection.php";
header('content-type:text/html;charset=utf-8');

unset($user,$psw);

$user=isset($_POST['user'])?$_POST['user']:NULL;
$psw=isset($_POST['psw'])?$_POST['psw']:NULL;
$role=NULL;

$conn=My_db::getInstance();
if(!isset($user)||!isset($psw)){
    echo "don't try to break in the web server you idot!";
    die();
}

session_start();

if(
    test_empty($user,"请输入用户名")&&
    test_empty($psw,"请输入密码")&&
    test_correct($conn,$user,$psw,$role)
){
    $_SESSION['user']=$user;
    $_SESSION['user_role']=$role;
    header("location:../main.php");
}

function test_empty($var,$message){
    if(empty($var)){?>
        <script>
            alert('<?php echo $message?>');
            location.href="../index.php";
        </script>
        <?php
        return false;
    }
    return true;
}

function test_correct(mysqli $conn,$user,$psw,&$role){
    $sql="SELECT user_key , user_role FROM user_info WHERE user_name='$user';";
    $result=$conn->query($sql);
    $arr=mysqli_fetch_assoc($result);

    if(!isset($arr)){
        insert_into_user_info($conn,$user,$psw);
        $role=0;
        return true;
    }

    if($arr['user_key']==$psw){
        $role=$arr['user_role'];
        return true;
    }
    ?>
    <script>
        alert('<?php echo 'Password is incorrect!'?>');
        location.href="../index.php";
    </script>
    <?php

    return false;

}
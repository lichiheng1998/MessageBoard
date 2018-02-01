<?php
include "singleton/My_db.php";
include "role/role_Enum.php";
header('content-type:text/html;charset=utf-8');


session_start();
if(isset($_POST['user']))
    $_SESSION['user']=$_POST['user'];

if(!$_SESSION['user']){
    echo "fuk";
    die();
}

$user=$_SESSION['user'];
$role=$_SESSION['user_role'];

$message=isset($_POST['comment'])?$_POST['comment']:NULL;

$conn=My_db::getInstance();

if(isset($user)&&isset($message)) {
    $sql="INSERT INTO main(message_author,message_content,submission_date,user_role) VALUE('$user','$message',NOW(),'$role');";
    $retval=$conn->query($sql);
}
?>
<html>
<head>
    <title>This is a message board!</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="css/main.css" />
</head>
<body>
<div id="main_body">
<div id="message_board_wrapper">
    <div id="message_board">
    <?php
    $sql="SELECT * FROM  main ORDER BY message_id DESC LIMIT 10";
    $result=$conn->query($sql);
    $row=null;
    while(($row=mysqli_fetch_assoc($result))!=null){
    ?>
        <div>
            <span>
                <?php echo $row['message_author'];

                    switch($row['user_role']){
                        case user_role::Admin:
                            echo "(Admin) ";
                            break;
                        case user_role::User:
                            echo "(User) ";
                            break;
                    }
                    echo  "said:";
                    switch($row['user_role']){
                        case user_role::Admin:
                            echo "<pre style='color: red'>{$row['message_content']}</pre>";
                            break;
                        case user_role::User:
                            echo "<pre>{$row['message_content']}</pre>";
                            break;
                    }
                ?>
            </span>
        </div>
    <?php
    }
    ?>
    </div>
</div>
<div id="table_div_wrapper">
    <div id="table_div">
    <form action="main.php" method="post">
        <table>
            <tr>
                <td>Message</td>
                <td>
                    <textarea id="comment" name="comment" co></textarea>
                </td>
            </tr>
            <tr class="submit">
                <td colspan="2">
                    <input id="submit_button" type="submit" value="send">
                </td>
            </tr>
        </table>
    </form>
    </div>
</div>
</div>
</body>
</html>
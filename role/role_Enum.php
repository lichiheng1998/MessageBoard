<?php
include "Enum.php";
header('content-type:text/html;charset=utf-8');
class user_role extends Enum {
    const __default = self::Admin;
    const Admin = 1;
    const User = 0;
}
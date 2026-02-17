<?php


function create_user(string $info){
    $u = new App\Models\User();
    $u->username = $info;
    $u->mail = $info . "@test.wip";
    $u->avatar = $info . ".png";
    $u->password = password_hash($info, PASSWORD_DEFAULT);
    $u->created_at = date("Y-m-d H:i:s");
    $u->save();
}


function escape(?string $value){
    return htmlspecialchars($value, ENT_QUOTES, "UTF-8");
}


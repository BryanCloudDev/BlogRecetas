<?php

require_once('./Class/Insert.php');

class User extends Insert
{
    static public function getUsername(int $id) : string
    {
        $contenidoArchivo = file_get_contents(USERS);
        $usuarios = json_decode($contenidoArchivo,true);
        return $usuarios[$id]['username'];
    }

    static public function getUserImagePath(int $id) : string
    {
        $contenidoArchivo = file_get_contents(USERS);
        $usuarios = json_decode($contenidoArchivo,true);
        return $usuarios[$id]['user_image'];
    }

    static public function getUserRol(int $id) : int
    {
        $contenidoArchivo = file_get_contents(USERS);
        $usuarios = json_decode($contenidoArchivo,true);
        return $usuarios[$id]['role'];
    }

    static public function deleteRegister(int $id, string $fileRoute) : void
        {
            $contenidoArchivo = file_get_contents($fileRoute);
            $users = json_decode($contenidoArchivo,true);
            $count = count($users);
            for($i = 1;$i < $count;$i++)
            {
                if($users[$i]['id'] == $id)
                {
                    unset($users[$i]);
                    break;
                }
            }
            array_values($users);
            $archive = fopen($fileRoute,'w');
            fwrite($archive,json_encode($users));
            fclose($archive);
        }

    static public function getUserFirstName($id)
        {
            $contenidoArchivo = file_get_contents(USERS);
            $usuarios = json_decode($contenidoArchivo,true);
            return $usuarios[$id]['name'];
        }

    static public function GetUserEmail($id)
        {
            $contenidoArchivo = file_get_contents(USERS);
            $usuarios = json_decode($contenidoArchivo,true);
            return $usuarios[$id]['email'];
        }

    static function encPass($password){
        $password = password_hash($password,PASSWORD_DEFAULT,['cost' => 10]);
        return $password;
    }

    static public function existsUser(string $username) : bool
    {
        $archiveContent = file_get_contents(USERS);
        $users = json_decode($archiveContent,true);
        $exists = FALSE;
        for($i = 1;$i < count($users);$i++)
        {
            if($users[$i]['username'] == $username)
            {
                $exists = TRUE;
                break;
            }
        }
        return $exists;
    }

    static public function existsEmail(string $email) :bool
    {
        $archiveContent = file_get_contents(USERS);
        $users = json_decode($archiveContent,true);
        $exists = FALSE;
        for($i = 1;$i < count($users);$i++)
        {
            if($users[$i]['email'] == $email)
            {
                $exists = TRUE;
                break;
            }
        }
        return $exists;
    }

    static function verifyUserInput(string $input) : array
    {
        $archiveContent = file_get_contents(USERS);
        $users = json_decode($archiveContent,true);
        $exists = FALSE;
        $password = '';
        for($i = 1;$i < count($users);$i++)
        {
            if($users[$i]['email'] == $input || $users[$i]['username'] == $input)
            {
                $exists = TRUE;
                $password = $users[$i]['password'];
                break;
            }
        }
        return [$exists,$password];
    }

    static function getUserbyInput(string $input) : array
    {
        $archiveContent = file_get_contents(USERS);
        $users = json_decode($archiveContent,true);
        $user = [];
        $count = count($users);
        for($i = 1;$i < $count;$i++)
        {
            if($users[$i]['email'] == $input || $users[$i]['username'] == $input)
            {
                $user = $users[$i];
                break;
            }
        }
        return $user;
    }

    static function getUsers() : array{
        $archiveContent = file_get_contents(USERS);
        $users = json_decode($archiveContent,true);
        $totalUsers = [];
        $count = count($users);
        for($i = 1;$i < $count;$i++)
        {
            $totalUsers[] = $users[$i];
        }
        return $totalUsers;
    }
}
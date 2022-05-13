<?php
require('./Class/Autoload.php');

function existsEmail(string $email)
{
    $archiveContent = file_get_contents(USERS);
    $users = json_decode($archiveContent,true);
    $exists = NULL;
    for($i = 1;$i < count($users);$i++)
    {
        if($users[$i]['email'] == $email)
        {
            $exists = TRUE;
            break;
        }
    }
    return $exists.$i;
}

echo existsEmail('bportillo701@gmail.com');
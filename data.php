<?php
        $db_host_01 = 'mysql33.1blu.de';
        $db_user_01 = 's350929_3508794';
        $db_password_01 = '?1rsMp9iiPDkWg2';
        $db_name_01 = 'db350929x3508794';

        $db_host_02 = 'mysql33.1blu.de';
        $db_user_02 = 's350929_3538727';
        $db_password_02 = '1PX86quM6EXFNAcF!F6';
        $db_name_02 = 'db350929x3538727';

        $webspace_01 = new mysqli($db_host_01, $db_user_01, $db_password_01, $db_name_01);

        if ($webspace_01->connect_error) {
            die('Connection to database 01 failed: ' . $webspace_01->connect_error);
        }

        $webspace_02 = new mysqli($db_host_02, $db_user_02, $db_password_02, $db_name_02);

        if ($webspace_02->connect_error) {
            die('Connection to database 02 failed: ' . $webspace_02->connect_error);
        }
?>

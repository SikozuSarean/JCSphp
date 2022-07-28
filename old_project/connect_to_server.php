<?php
//include "secu_data.php";
$ssh_host = "monitor.jcs.jo";
$ssh_username = "monitor";
$ssh_pwd = "Parolam0nitor&";
$ssh_remoteDir = "/var/www/onu/";

        // Make our connection
        $connection = ssh2_connect($ssh_host);

        // Authenticate
        if (!ssh2_auth_password($connection, $ssh_username, $ssh_pwd)) {
            throw new Exception('Unable to connect.');
        }

        // Create our SFTP resource
        if (!$sftp = ssh2_sftp($connection)) {
            throw new Exception('Unable to create SFTP connection.');
        }

        /**
          * Now that we have our SFTP resource, we can open a directory resource
          * to get us a list of files. Here we will use the $sftp resource in
          * our address string as I previously mentioned since our ssh2:// 
          * protocol allows it.
          */
        $files = array();
        $dirHandle = opendir("ssh2.sftp://$sftp/$ssh_remoteDir");

        // Properly scan through the directory for files, ignoring directory indexes (. & ..)
        while (false !== ($file = readdir($dirHandle))) {
            if ($file != '.' && $file != '..') {
                $files[] = $file;
            }
        }
       echo "<pre>";print_r($files);
    ?>
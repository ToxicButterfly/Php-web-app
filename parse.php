<?php
//open temporary file
if (($handle = fopen("temp/".$_FILES['f']['name'], "r")) !== FALSE) {
    $num=count(fgetcsv($handle, 1000, ";"));
    //reading temporary file string by string
    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
        //if String length is 3 words - it's departments file, if 11 - users file.
        switch ($num) {
            case 3: {
                $sql = "INSERT INTO departments (xml_id, parent_xml_id, name_department) VALUES (?,?,?)";
                $stmt= $pdo->prepare($sql);
                $stmt->execute([$data[0], $data[1], $data[2]]);
                break;
            }
            case 11: {
                $sql = "INSERT INTO users (xml_id, last_name, name, second_name, department, work_position, email, mobile_phone, phone, login, password) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
                $stmt= $pdo->prepare($sql);
                $stmt->execute([$data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $data[6], $data[7], $data[8], $data[9], $data[10]]);
                break;
            }
        }
    }
    //saving strings into database
    $sql = "INSERT INTO files (file_name) VALUES (?)";
    $stmt= $pdo->prepare($sql);
    $stmt->execute([$_FILES['f']['name']]);

    fclose($handle);
}

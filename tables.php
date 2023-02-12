<?php
include 'db_conn.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Application</title>
    <!--Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!--Font Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
          integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <script>$(document).ready( function () {
            $('#table_id').DataTable();
        } );$(document).ready( function () {
            $('#table_id2').DataTable();
        } );</script>

</head>
<body>
<nav class="navbar navbar-light justify-content-center fs-3 mb-5"
     style="background-color: lightgreen">
    PHP Parsing Application
</nav>
<div class="text-center mb-4">
    <h3>Loaded tables</h3>
</div>
<table id="table_id" class="display">
    <thead>
    <tr>
        <th>xml_id</th>
        <th>last_name</th>
        <th>name</th>
        <th>second_name</th>
        <th>department</th>
        <th>work_position</th>
        <th>email</th>
        <th>mobile_phone</th>
        <th>phone</th>
        <th>login</th>
        <th>password</th>
    </tr>
    </thead>
    <tbody id="tbody">
    <?php
        // fetching data from DB and placing it into the table
        $sth = $pdo->prepare("SELECT * FROM users");
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_NUM);
        for($i=0;$i<count($result);$i++){
            echo '<tr>';
            for($j=0; $j<11; $j++) {
                    echo "<td>"; echo $result[$i][$j]; echo "</td>";
            }
            echo '</tr>';
        }
    ?>
    </tbody>
</table>
<br>
<table id="table_id2" class="display">
    <thead>
    <tr>
        <th>xml_id</th>
        <th>parent_xml_id</th>
        <th>name_department</th>
    </tr>
    </thead>
    <tbody id="tbody">
    <?php
        // fetching data from DB and placing it into the table
        $sth = $pdo->prepare("SELECT * FROM departments");
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_NUM);
        for($i=0;$i<count($result);$i++){
            echo '<tr>';
            for($j=0; $j<3; $j++) {
                echo "<td>"; echo $result[$i][$j]; echo "</td>";
            }
            echo '</tr>';
        }
    ?>
    </tbody>
</table>

</body>
</html>
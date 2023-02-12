<?php
include 'db_conn.php';

if(isset($_POST['submit']) && isset($_POST['choice'])){
    //load from database data of selected table
    $sth = $pdo->prepare("SELECT * FROM " . $_POST['choice']);
    $sth->execute();
    $result = $sth->fetchAll(PDO::FETCH_NUM);
    //write down table's data into csv format
    $str="";
    for($i=0;$i<count($result);$i++) {
        for($j=0;$j<count($result[0]);$j++){
            $str.= $result[$i][$j];
            if($j!=count($result[0])-1)
                $str.=";";
        }
        $str.= "\r\n";
    }
    //saving temporary file
    file_put_contents("temp/". $_POST['choice']. ".csv", $str);
    // file path
    $file_path = "temp/". $_POST['choice']. ".csv";

    // find out MIME of file
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $file_path);

    // Sending headers to download file
    header('Content-Disposition: attachment; filename="'.basename($file_path).'"');
    header('Content-Type: '.$mime);
    header('Content-Length: '.filesize($file_path));
    header('Connection: close');

    // download file
    echo file_get_contents($file_path);
    // deleting temporary file
    unlink("temp/". $_POST['choice']. ".csv");
}
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
</head>
<body>
    <nav class="navbar navbar-light justify-content-center fs-3 mb-5"
         style="background-color: lightgreen">
        PHP Parsing Application
    </nav>
    <div class="container">
        <div class="text-center mb-4">
            <h3>Add new file</h3>
        </div>
        <div class="container d-flex justify-content-center">
            <form enctype="multipart/form-data" method="post">
                <p>
                    <input type="file" name="f">
                    <input type="submit" value="Submit" name="file">
                </p>
            </form>
        </div>
        <div class="confirm text-center">
            <?php if(isset($_FILES['f'])) {
                // File load notification
                echo "File " . $_FILES['f']['name'] . " is loaded";
                //saving temporary file
                move_uploaded_file($_FILES['f']['tmp_name'], 'temp/'.$_FILES['f']['name']);
                //parse file into array and save it into database
                include "parse.php";
                //deleting temporary file
                unlink('temp/'.$_FILES['f']['name']);
            } ?>
        </div>
    </div>
    <br>
    <div class="container text-center justify-content-md-center mb-5">
        <div>
            <a href="files.php" class="btn btn-success">List of files</a>
        </div>
        <br>
        <div>
            <a href="tables.php" class="btn btn-danger">Tables of data</a>
        </div>
    </div>
    <div class="container">
        <div class="text-center mb-4">
            <h3>Choose file to download</h3>
        </div>
        <div class="container d-flex justify-content-center">
            <form enctype="multipart/form-data" method="post">
                <h4>Choose lines you want to see by first two numbers of accounts</h4>
                <select name="choice">
                    <option selected disabled>Make a choice</option>
                    <option value="files">Loaded files</option>
                    <option value="users">Loaded users</option>
                    <option value="departments">Loaded departments</option>
                </select>
                <button type="submit" class="btn btn-dark" name="submit">Download</button>
            </form>
        </div>
    </div>
        <!--Bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>
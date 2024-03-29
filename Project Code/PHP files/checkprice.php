<?php session_start(); ?>  <!-- Startong previous session -->
<?php require 'function.php'; ?>  <!-- including function -->
<?php ob_start();  ?> <!-- managing output buffer -->

<?php

$db=db_connect();
// checking session validation
if (!isset($_SESSION['pos_admin']) || !isset($_COOKIE['userlog'])) {
    header('Location: index.php');
}

?>
<!DOCTYPE HTML>
<html lang="en-US" ng-app>
<head>
    <meta charset="UTF-8">
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>POS - A Crony Of Point Of Sale</title>

    <!-- Stylesheets -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css" media="all" />
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-theme.css" media="all" />
    <link rel="stylesheet" type="text/css" href="assets/css/normalize.css" media="all" />
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css" media="all" />
    <link rel="stylesheet" type="text/css" href="assets/css/responsive.css" media="all" />
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Ubuntu:regular,bold&subset=Latin">
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Ubuntu:regular&subset=Latin,Cyrillic" <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" />

    <link href='http://fonts.googleapis.com/css?family=Lato:400,400italic,700' rel='stylesheet' type='text/css'>

    <!--sweetalert lib-->
    <script src="assets/js/sweetalert.min.js"></script>
    <link rel="stylesheet" href="assets/css/sweetalert.min.css">
    <!--angular-->
    <script src="assets/js/angular.min.js"></script>

    <script src="assets/js/jquery-3.2.0.min.js"></script>
    <script>
        var txt = "";
        function selectBarcode() {
            if (txt != $("#focus").val()) {
                setTimeout('use_rfid()', 3000);
                txt = $("#focus").val();
            }
            $("#focus").select();
            setTimeout('selectBarcode()', 3000);
        }

        $(document).ready(function () {
            setTimeout(selectBarcode(),3000);
        });
    </script>

    <style type="text/css">
        body {
            margin: 0;
            background-color: #286090;
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: Ubuntu;
        }
        .email {
            padding: 8px;
            border-bottom: 2x solid black;
            background-color: transparent;
            margin-top: 50px;
            margin-bottom: 5px;
            width: 100%;
            border: none;
            border-bottom: 2px solid #bdc3c7;
            margin-bottom: 10px;
            text-align: center;
            font-size: 16px;
            color: grey;
            outline: 0;
        }
        .submit {
            margin-top: 20px;
            padding: 12px 18px;
            border-radius: 20px;
            background-color: #e74c3c;
            color: #ffffff;
            width: 100%;
            border: none;
            text-align: center;
            font-size: 16px;
            outline: 0;
        }
        .submit:hover {
            transition: .3s;
            background-color: #2c3e50;
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }
        #scanpdt {
            background: #ecf0f1;
            height: 200px;
            width: 500px;
            border-radius: 10px;
        }
    </style>
</head>
<body>
<div class="main">
    <div class="container" style="padding-top:3%;">
        <div class="row">
            <h1 style="text-align:center;color:#FFFFFF "><b>Check Price & Available Quantity<b></h1>
        </div>
    </div>
    <div id="scanpdt" class="container text-center" style="margin-top:6%">
        <div class="row">
            <div class="col-md-12">
                <form action="" method="post">
                    <input class="email" type="text" Placeholder="UPC / Barcode" id="focus" name="barcode_" autocomplete="off" />
                    <button class="submit" name="entry">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_POST['entry'])) {
    if (!empty($_POST['barcode_']) ) {
        $barcode=$_POST['barcode_'];
        $search="SELECT * FROM pos_product WHERE barcode='$barcode'";
        $search_sql=mysqli_query($db,$search);
    if (mysqli_num_rows($search_sql)==1) {
        $search_result=mysqli_fetch_assoc($search_sql);
        $error=$search_result['name']; ?>
        <script>swal("Product Price","<?php echo "Your Product ".$error." Price is :".$search_result['price'].".BDT";  ?>", "success");</script> <?php

    }
    else {
    $error="You have search unregisterd product!"; ?>
        <script>swal("Opss..","<?php echo $error; ?>", "error");</script> <?php
    }
    }
    else{
    $error="You have search unregisterd product!"; ?>
        <script>swal("Opss..","<?php echo $error; ?>", "error");</script> <?php
    }
}
?>

</body>
</html>
<?php session_start(); ?>  <!-- Startong previous session -->
<?php require 'function.php'; ?>  <!-- including function -->
<?php ob_start();
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


  <!--sweetalert lib-->
  <script src="assets/js/sweetalert.min.js"></script>
  <link rel="stylesheet" href="assets/css/sweetalert.min.css">
  <!--angular-->
  <script src="assets/js/angular.min.js"></script>
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.3/angular.min.js"></script> -->

  <script src="assets/js/jquery-3.2.0.min.js"></script>
  <script>
    var txt = "";
	function selectBarcode() {
		if (txt != $("#focus").val()) {
			setTimeout('use_rfid()', 1000);
			txt = $("#focus").val();
		}
		$("#focus").select();
		setTimeout('selectBarcode()', 1000);
	}

	$(document).ready(function () {
		setTimeout(selectBarcode(),1000);
	});
	</script>

  <link href='http://fonts.googleapis.com/css?family=Lato:400,400italic,700' rel='stylesheet' type='text/css'>

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
      width: 500px;
      border-radius: 10px;
    }

    select {
      padding: 8px 75px;
      margin-bottom: 10px;
      background: #ecf0f1;
      border-radius: 20px;
      outline: 0;
    }

    #selectId {
      padding: 8px 85px;
      margin-bottom: 10px;
      background: #ecf0f1;
      border-radius: 20px;
      outline: 0;
    }

    #productinfo {
      padding: 30px;
    }

    .addproduct {
      margin-top: 20px;
      padding: 12px 50px;
    }
  </style>
</head>

<body>
  <div class="main">
    <div class="container" style="padding-top:3%;">
      <div class="row">
        <h1 style="text-align:center;color:#FFFFFF "><b>Scan A Product<b></h1>
      </div>
    </div>
    <div id="scanpdt" class="container text-center" style="margin-top:1%">
      <div id="productinfo" class="row">
        <!--- Form Start --->

        <form class="" action="" method="post">


          <div class="form-group">
            <label class="sr-only" for="exampleInputAmount">Barcode</label>
            <div class="input-group">
              <div class="input-group-addon">|||| |</div>
              <input type="text" name="barcode_" class="form-control" id="focus" placeholder="Barcode" autofocus>

            </div>
          </div>



          <button type="submit" name="entry" class="btn btn-primary addproduct">Next</button>

        </form>

        <!-- Form End -->
        <?php

        if (isset($_POST['entry']) ){
          if (empty($_POST['barcode_'])) {
            ?>
            <script>swal("Opss...","Invalid Barcode","error")</script>
            <?php

          }
          elseif (mysqli_num_rows(product_checker($db,$_POST['barcode_']))>0) {
            ?>
            <script>swal("Opss...","Product already exists","error")</script>
            <?php
          }
          else {
          header ("Location: addproduct.php?entry=true&barcode_=".$_POST['barcode_']);
          }
        }

         ?>


      </div>
    </div>
</body>
</html>

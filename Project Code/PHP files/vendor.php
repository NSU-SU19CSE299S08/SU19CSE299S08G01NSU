<?php session_start(); ?> 
<?php require 'function.php'; ?> 
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


  <style type="text/css">
    body {
      margin: 0;
      background-color: #286090;
      background-repeat: no-repeat;
      background-attachment: fixed;
      font-family: Ubuntu;
    }


    .right-table {
      -webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, .05);
      box-shadow: 0 1px 2px rgba(0, 0, 0, .05);
      border-radius: 4px;
      background-color: #ecf0f1;
      height: 300px;
    }

    .left-table {
      -webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, .05);
      box-shadow: 0 1px 2px rgba(0, 0, 0, .05);
      border-radius: 4px;
      background-color: #ecf0f1;
      height: 300px;
      background-attachment: fixed;
      margin-right: 16.65%;
    }

    .email {
      padding: 8px;
      border-bottom: 2x solid black;
      background-color: transparent;
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

    select {
      padding:10px 80px 10px 91px;
      margin-top: 10px;
      margin-bottom: 10px;
      background: #ecf0f1;
      border-radius: 12px;
      outline: 0;
    }

    #table-wrapper h4 {
      color: #333;
    }

    #table-wrapper {
      position: relative;
    }

    #table-scroll {
      height: 230px;
      overflow: auto;
      margin-top: 40px;
    }

    #table-wrapper table {
      width: 100%;

    }

    #table-wrapper table * {
      background: transparent;
      color: black;
    }

    #table-wrapper table thead th .text {
      position: absolute;
      top: -20px;
      z-index: 2;
      height: 40px;
      width: 35%;
    }
  </style>
</head>

<body>
  <div class="main">
    <div class="container" style="padding-top:3%;">
      <div class="row">
        <h1 style="text-align:center;color:#FFFFFF "><b>Welcome to POS<b></h1>
      </div>
    </div>
    <div class="container" style="margin-top:6%">
      <div class="row">
        <div class="col-md-5 col-xm-5  col-sm-5 left-table">
          <h4 style="color: #333;" class="text-center">Add Supplier</h4>
          <form action="" method="post">
            <input class="email" type="text" Placeholder="Name" name="name_" autocomplete="off" />
            <input class="email" type="text" Placeholder="Contact Number" name="phone_" autocomplete="off" />
            <input class="email" type="text" Placeholder="Address" name="address_" autocomplete="off" />
            <div class="selectOpt">
              <select name="brand_">
                <option value="NULL">Select Brand</option>
				<?php
                  $brand_record=brand_picker($db);
                  if (mysqli_num_rows($brand_record)>0) {
                    while ($record_brand=mysqli_fetch_assoc($brand_record)) {
                      ?>
                      <option value="<?php echo $record_brand['brand_id']; ?>"><?php echo $record_brand['brand_title']; ?></option>
                      <?php
                    }
                  }
                   ?>

              </select>
            </div>
            <button class="submit" name="vendor">Submit</button>
          </form>
        </div>
		<?php

        if (isset($_POST['vendor'])) {
        if (empty($_POST['name_']) || empty($_POST['phone_']) || empty($_POST['address_'])) {
        $error="Please Fillout The Form Poperly!" ?>
        <script>swal("Opss.....","<?php echo $error; ?>", "error");</script> <?php
        }
        else {
          // define $username and $password
          $vendor_name=$_POST['name_'];
          $vendor_phone=$_POST['phone_'];
          $vendor_address=$_POST['address_'];
          $brand=$_POST['brand_'];


          $add_vendor="INSERT INTO pos_vendor (vendor_id,vendor_name,vendor_phone,vendor_address,vendor_brand)VALUES (NULL,'$vendor_name',$vendor_phone,'$vendor_address',$brand)";
          $vendor_run=mysqli_query($db,$add_vendor);
          if ($vendor_run) {
            $error="Supplier Added!" ?>
            <script>swal("Success","<?php echo $error; ?>", "success");</script> <?php
          }
          else {
            $error="Supplier Added Failed!" ?>
            <script>swal("Something Wrong","<?php echo $error; ?>", "error");</script> <?php
          }

        }
      }

         ?>

      
        <div class="col-md-offset-2 col-xm-2  col-sm-2"></div>
        <div class="col-md-5 col-xm-5  col-sm-5 right-table ">
          <div id="table-wrapper">
            <div id="table-scroll">
              <table class="table">
                <thead>
                    <th><span class="text">Name</span></th>
                    <th><span class="text">Brand</span></th>
                    <th><span class="text">Contact</span></th>
                    <th><span class="text">Address</span></th>
                </thead>
                <tbody>
           
		        <?php
                  $vendor_record=vendor_picker($db);
                  if (mysqli_num_rows($vendor_record)>0) {
                    while ($vendor_result=mysqli_fetch_assoc($vendor_record)) {
                      ?>
                      <tr>
                        <td><?php echo $vendor_result['vendor_name']; ?></td>

                        <td><?php
                        $sql="SELECT * FROM pos_brand WHERE brand_id={$vendor_result['vendor_brand']} ";
                        $sql_result=mysqli_query($db,$sql);
                        $sql_result1=mysqli_fetch_assoc($sql_result);
                        echo $sql_result1['brand_title'];
                      ?></td>
                        <td><?php echo $vendor_result['vendor_phone']; ?></td>
                        <td><?php echo $vendor_result['vendor_address']; ?></td>

                      </tr>
                      <?php
                    }
                  }
                   ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        </div>
      </div>
    </div>
</body>
</html>

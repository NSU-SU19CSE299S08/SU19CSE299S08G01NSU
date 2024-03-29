<?php session_start(); ?>  <!-- Startong previous session -->
<?php require 'function.php'; ?>  <!-- including function -->
<?php ob_start();  ?> <!-- managing output buffer -->

<?php

$db=db_connect();
// checking session validation
if (!isset($_SESSION['pos_admin']) || !isset($_COOKIE['userlog'])) {
    header('Location: index.php');
}
$count=0;
$total_price=0;
$total_product=0;

?>
<!DOCTYPE HTML>
<html lang="en-US" ng-app>

<head>
    <meta charset="UTF-8">
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="keywords" content="hand watch, hand watch in bangladesh" />
    <meta name="description" content="we are selling the best quality products and we export all over bangladesh.. " />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <title>POS - A Crony Of Point Of Sale</title>

    <!-- Stylesheets -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css" media="all" />
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-theme.css" media="all" />
    <link rel="stylesheet" type="text/css" href="assets/css/normalize.css" media="all" />
    <link rel="stylesheet" type="text/css" href="assets/css/responsive.css" media="all" />
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css" media="all" />
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Ubuntu:regular,bold&subset=Latin">
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Ubuntu:regular&subset=Latin,Cyrillic" <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" />

    <link href='http://fonts.googleapis.com/css?family=Lato:400,400italic,700' rel='stylesheet' type='text/css'>


    <script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <style type="text/css">
        .container {
            width: 95%;
        }

        .selectpicker {
            padding: 12px 82px;
            border-radius: 5px;
        }

        .search-input {
            padding: 19px 13px;
        }

        .searchbtn {
            padding: 9px 50px;
            background: #e74c3c;
            color: #fff;
            border-color: #e74c3c;
            outline: none;
        }

        .delete-heading h2 {
            color: #333;
            margin-top: 20px;
            margin-bottom: 30px;
        }

        .list-heading h4 {
            color: #333;
            margin-top: 20px;
        }

        th {
            text-align: center;
        }

        .table {
            border: 1px solid grey;
        }

        .searchbtn {
            padding: 10px 80px;
            background: #e74c3c;
            outline: 0;
        }

        .searchbtn:hover {
            background: #333;
            color: #fff;
            transition: .4s;
            outline: 0;
            border: 1px solid #333;
        }

        .form-control {
            height: 43px;
        }

        label {
            padding-right: 12px;
            font-size: 20px;
        }

        #table-scroll {
            height: 310px;
            overflow: auto;
            margin-top: 40px;
        }

        h1,
        .h1,
        h2,
        .h2,
        h3,
        .h3 {
            margin-top: 0px;
            margin-bottom: 10px;
        }

    </style>
</head>

<body>
<div class="container text-center">
    <div class="delete-heading">
        <h2>Stock Status</h2>
    </div>
    <div class="search">
        <form action="" method="post" class="form-inline">
            <div class="form-group">
                <label for="email">Filter:</label>
                <select name="category_" class="selectpicker form-control ">
                    <option value=" NULL">Select Catagory</option>

                    <?php
                    $category=category_picker($db);
                    if (mysqli_num_rows($category)>0) {
                        while ($category_result=mysqli_fetch_assoc($category)) {
                            ?>
                            <option value="<?php echo $category_result['category_id']; ?>"><?php echo  $category_result['category_title']; ?></option>
                            <?php
                        }
                    }

                    ?>

                </select>
            </div>
            <button type="submit" class="btn btn-default searchbtn" name="category">Select Category</button>
        </form>

        <?php
        if (isset($_POST['category']) ) {
            if (isset($_POST['category_']) ) {
                $category_id=$_POST['category_'];
                $sql="SELECT * FROM pos_product WHERE category_id=$category_id";
                $product=mysqli_query($db,$sql);
            }
        }
        else {
            $product=product_picker($db);
        }
        ?>
    </div>
    <div class="product-list">
        <!-- <div class="list-heading">
                     <h4>Showing For All</h4>
                 </div>  -->
        <div class="product-table">
            <div id="table-scroll">
                <table class="table table-striped">
                    <thead>

                    <th>SN</th>
                    <th>#Item</th>
                    <th>Barcode</th>
                    <th>Catagory</th>
                    <th>Brand</th>
                    <th>Cost</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Entry Date</th>

                    </thead>
                    <tbody>

                    <?php

                    if ($count=mysqli_num_rows($product)>0) {
                    while ($record=mysqli_fetch_assoc($product)) {
                    ?>

                    <tr>
                        <td><?php echo $record['p_id']; ?></td>
                        <td><?php echo $record['name']; ?></td>
                        <td><?php echo $record['barcode']; ?><</td>
                        <td><?php
                            $c="SELECT * FROM pos_category WHERE category_id={$record['category_id']}";
                            $c1=mysqli_query($db,$c);
                            $check_result=mysqli_fetch_assoc($c1);
                            echo  $check_result['category_title']; ?></td>
                        <td><?php $c="SELECT * FROM pos_brand WHERE brand_id={$record['brand_id']}";
                            $c1=mysqli_query($db,$c);
                            $check_result=mysqli_fetch_assoc($c1);
                            echo  $check_result['brand_title']; ?></td>

                        <td><?php echo $record['cost']; ?></td>
                        <td><?php echo $record['price']; ?></td>
                        <td><?php echo $record['quantity']; ?></td>
                        <td><?php echo $record['created_date'];
                            $total_price=$total_price+$record['cost'];
                            $total_product=$total_product+$record['quantity'];
                            ?></td>
                    </tr>

                        <?php
                    }
                    }
                    ?>

                    </tbody>

                </table>
            </div>

            <table class="table">
                <thead>

                <tr>
                    <th>Total Item : <?php
                        $a=product_picker($db);
                        $b=mysqli_num_rows($a);
                        echo $b;
                        ?></th>
                    <th>Total Product Cost :  <?php echo $total_price; ?></th>
                    <th>Total Quantity :<?php echo $total_product; ?></th>

                </tr>
                </thead>
            </table>

        </div>
    </div>
</div>

<div class="main text-center">
    <div class="container">
        <h3 style='color: #333'>POS - A Crony of Point Of Sale</h3>
        <h4 style='color: #333'>Call: +88 01631706287</h4>
        <h5 style='color: #078830; font-weight: 700;' title='Shiam'>Developed by Wasik</h5>
    </div>
</div>
</body>
</html>
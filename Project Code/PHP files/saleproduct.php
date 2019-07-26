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
    <script>
        // window.resizeTo(1100,500);
    </script>

    <!-- Stylesheets -->
    <link rel="stylesheet" type="text/css" href="assets/css/tools.css" media="all" />
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

    <script src="assets/js/jquery-3.2.0.min.js"></script>

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

        .left-table {
            -webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, .05);
            box-shadow: 0 1px 2px rgba(0, 0, 0, .05);
            border-radius: 4px;
            background-color: #ecf0f1;
            height: 300px;
            background-attachment: fixed;
        }

        .right-table {
            -webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, .05);
            box-shadow: 0 1px 2px rgba(0, 0, 0, .05);
            border-radius: 4px;
            background-color: #ecf0f1;
        }

        .popover {
            width: 39%;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 1060;
            display: none;
            max-width: 276px;
            padding: 1px;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-size: 14px;
            font-style: normal;
            font-weight: normal;
            line-height: 1.42857143;
            text-align: left;
            text-align: start;
            text-decoration: none;
            text-shadow: none;
            text-transform: none;
            letter-spacing: normal;
            word-break: normal;
            word-spacing: normal;
            word-wrap: normal;
            white-space: normal;
            background-color: #fff;
            -webkit-background-clip: padding-box;
            background-clip: padding-box;
            border: 1px solid #ccc;
            border: 1px solid rgba(0, 0, 0, .2);
            border-radius: 6px;
            -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, .2);
            box-shadow: 0 5px 10px rgba(0, 0, 0, .2);
            line-break: auto;
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
            margin-top: 40px;

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
            margin-top: 20px;
        }

        .submit:hover {
            transition: .3s;
            background-color: #2c3e50;
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }

        .conbtn {
            margin-bottom: 20px;
            padding: 15px 40px;
            background: #e74c3c;
            margin-top: 20px;
            outline: 0;
            border-color: #e74c3c;
        }
    </style>
</head>

<body>
<div class="main">
    <div class="container">
        <div class="row">
            <h1 style="text-align:center;color:#FFFFFF "><b>New Sale List<b></h1>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-5 col-xm-5  col-sm-5 left-table">
                <form class="" action="" method="post">
                    <h4 style="color: #e74c3c; margin-top: 25px;" class="text-center">* Please scan product by Barcode Scanner</h4>
                    <input class="email" id="focus" type="text" Placeholder="UPC / Barcode" name="barcode_" autocomplete="off" autofocus />
                    <button type="submit" name="scan_product" class="submit">Submit</button>
                </form>

                <!-- Scan a product -->

            </div>

            <div class="col-md-offset-2 col-xm-1  col-sm-1 spaces"></div>
            <div class="col-md-5 col-xm-5  col-sm-5 right-table ">
                <div id="table-scroll" style="margin-top: 5px;">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Barcode</th>
                            <th>#Item</th>
                            <th><a href="cart_remove_all.php?cartcode=all" class="confirmation-callback"><i class="fa fa-trash-o" style="color: #d9534f;" aria-hidden="true"></i></a></th>
                        </tr>
                        </thead>
                        <tbody>
                        <!-- php script to create dynamic row -->

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--</div>-->
    </div>
</div>
<div class="container text-center">
    <div class="continue">
        <form class="" action="" method="post">
            <button type="submit" name="check" class="btn btn-success conbtn">Continue</button>
        </form>

    </div>




    <script src="assets/js/jquery-1.11.3.min"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <script src="assets/js/bootstrap-confirmation.js"></script>
    <script type="text/javascript">
        $('.confirmation-callback').confirmation({
            onConfirm: function() {
                var confirm = 'yes';

                return confirm;
            },
            onCancel: function() {

                var confirm = 'no';
                return confirm;
            }
        });
    </script>
</body>
<script>
    'undefined' === typeof _trfq || (window._trfq = []);
    'undefined' === typeof _trfd && (window._trfd = []), _trfd.push({
        'tccl.baseHost': 'secureserver.net'
    }), _trfd.push({
        'ap': 'cpsh'
    }, {
        'server': 'a2plcpnl0354'
    })
</script>
<script src='https://img1.wsimg.com/tcc/tcc_l.combined.1.0.6.min.js'></script>

</html>

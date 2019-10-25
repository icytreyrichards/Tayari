<?php echo $this->session->flashdata('success_msg'); ?>
<?php echo $this->session->flashdata('error_msg'); ?>
<?php

$query1 = $this->db->query(" SELECT * FROM `settings` order by id DESC ");
$row11 = $query1->row('settings');
$mesr = $row11->measurements;
$id = $_GET['id'];

if(isset($_REQUEST["save"]))
{
    $car_type = $_REQUEST['cartype'];
    $intialkm = $_REQUEST['intialkm'];
    $carrate = $_REQUEST['carrate'];
    $night_intailrate = $_REQUEST['night_intailrate'];
    $fromintialkm = $_REQUEST['fromintialkm'];
    $fromintailrate = $_REQUEST['fromintailrate'];
    $night_fromintailrate = $_REQUEST['night_fromintailrate'];
    $ride_time_rate = $_REQUEST['ride_time_rate'];
    $night_ride_time_rate = $_REQUEST['night_ride_time_rate'];
    $timetype = $_REQUEST['timetype'];
    $transfertype = $_REQUEST['transfertype'];
    $description = $_REQUEST['description'];
    $seating_capacity = $_REQUEST['seating_capacity'];

    if(empty($_FILES['uploadImageFile']['name']))
    {
        $name=$_REQUEST["himg"];

    }
    else
    {
        //$name =  "car_image/{$_FILES['uploadImageFile']['name']}";
        $name =  $_FILES['uploadImageFile']['name'];

        $result = move_uploaded_file($_FILES['uploadImageFile']['tmp_name'], "car_image/".$name);
    }
    $upcar = "UPDATE cabdetails SET cartype='$car_type',icon='$name',intialkm='$intialkm',car_rate=$carrate,night_intailrate='$night_intailrate',fromintialkm='$fromintialkm',fromintailrate='$fromintailrate',night_fromintailrate='$night_fromintailrate',ride_time_rate='$ride_time_rate',night_ride_time_rate='$night_ride_time_rate',timetype='$timetype',transfertype='$transfertype',description='$description',seat_capacity='$seating_capacity' WHERE cab_id=$id";
    $qr=mysql_query($upcar);
    if($qr)
    {
        redirect('admin/manage_car_type');
    }
}

$query = $this->db->query("SELECT * FROM  cabdetails WHERE  cab_id='$id'");
$row = $query->row('Car_Type');
$x=$row->icon;
$a=explode("Source",$x);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Naqilcom</title>

    <!-- bootstrap -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>application/views/css/bootstrap/bootstrap.min.css" />

    <!-- RTL support - for demo only -->
    <script src="js/demo-rtl.js"></script>
    <!--
    If you need RTL support just include here RTL CSS file <link rel="stylesheet" type="text/css" href="css/libs/bootstrap-rtl.min.css" />
    And add "rtl" class to <body> element - e.g. <body class="rtl">
    -->

    <!-- libraries -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>application/views/css/libs/font-awesome.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>application/views/css/libs/nanoscroller.css" />

    <!-- global styles -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>application/views/css/compiled/theme_styles.css" />

    <!-- this page specific styles -->
    <link rel="stylesheet" href="<?php echo base_url();?>application/views/css/libs/daterangepicker.css" type="text/css" />

    <!-- Favicon -->
    <link type="image/x-icon" href="<?php echo base_url();?>upload/favicon.png" rel="shortcut icon" />

    <!-- google font libraries -->
    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,600,700,300' rel='stylesheet' type='text/css'>

    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->

    <style type="text/css">.modal-open .modal{ background:url(<?php echo base_url();?>application/views/img/transpharant.png) top left repeat;}</style>
</head>
<body>
<div class="cover"></div>
<div id="theme-wrapper">
    <?php
    include"includes/admin_header.php";
    ?>
    <div id="page-wrapper" class="container">
        <div class="row">
            <?php
            include"includes/admin_sidebar.php";
            ?>
            <div id="content-wrapper">
                <div class="row" style="opacity: 1;">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-12">
                                <div id="content-header" class="clearfix">
                                    <div class="pull-left">
                                        <h1>Add Car Type</h1>
                                    </div>
                                    <div class="pull-right">
                                        <ol class="breadcrumb">
                                            <li><a href="#">Home</a></li>
                                            <li class="active"><span>Add Car Type</span></li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="main-box clearfix">
                                    <div class="panel">
                                        <div class="panel-body">
                                            <h2>Add Car Type</h2>
                                        </div>
                                    </div>

                                    <div class="main-box-body clearfix">
                                        <form  enctype="multipart/form-data" method="post" class="form-horizontal" id="formAddUser" name="add_user" role="form"  onsubmit="return validate()">
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="inputImgCar">Car Image</label>
                                                <div id="inputImgCar" class="col-lg-10">
                                                    <img src='<?php echo base_url()."car_image/".$row->icon;?>' height="100" width="100">
                                                    <input type="file"  name="uploadImageFile" id="uploadImageFile" class="form-control">
                                                    <input type="hidden" value="<?php echo $row->icon;  ?>" name="himg">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="cartype">Car Type</label>
                                                <div id="inputCarType" class="col-lg-10">
                                                    <input type="text"   placeholder="Enter Car Types" name="cartype" id="cartype" class="form-control" value="<?php echo $row->cartype ?>">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="cartype">Transfer Type</label>
                                                <div id="inputCarType" class="col-lg-10">
                                                    <input type="text"  placeholder="Enter Transfer Types" name="transfertype" id="transfertype" class="form-control" value="<?php echo $row->transfertype ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="cartype">Initial KM</label>
                                                <div id="inputCarType" class="col-lg-10">
                                                    <input type="text" value="<?php echo $row->intialkm ?>"  placeholder="Enter Initial Km" name="intialkm" id="intialkm" class="form-control">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="carrate">Car Rate</label>
                                                <div id="inputCarRate" class="col-lg-10">
                                                    <input type="text" value="<?php echo $row->car_rate ?>" placeholder="Enter car rate" name="carrate" id="carrate" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="cartype">Night Initial Rate</label>
                                                <div id="inputCarType" class="col-lg-10">
                                                    <input type="text" value="<?php echo $row->night_intailrate ?>" placeholder="Enter Night Initial Rate" name="night_intailrate" id="night_intailrate" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="cartype">From Initial KM</label>
                                                <div id="inputCarType" class="col-lg-10">
                                                    <input type="text" value="<?php echo $row->fromintialkm ?>" placeholder="Enter From Initial KM" name="fromintialkm" id="fromintialkm" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="cartype">From Initial Rate</label>
                                                <div id="inputCarType" class="col-lg-10">
                                                    <input type="text" value="<?php echo $row->fromintailrate ?>" placeholder="Enter Night From Initial Rate" name="night_fromintailrate" id="night_fromintailrate" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="cartype">Night From Initial Rate</label>
                                                <div id="inputCarType" class="col-lg-10">
                                                    <input type="text" value="<?php echo $row->night_fromintailrate ?>" placeholder="Enter From Initial Rate" name="fromintailrate" id="fromintailrate" class="form-control">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="cartype">Ride Time Rate</label>
                                                <div id="inputCarType" class="col-lg-10">
                                                    <input type="text" value="<?php echo $row->ride_time_rate ?>"  placeholder="Enter Ride From Time Rate" name="ride_time_rate" id="ride_time_rate" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="cartype"> Night Ride Time Rate</label>
                                                <div id="inputCarType" class="col-lg-10">
                                                    <input type="text" value="<?php echo $row->night_ride_time_rate ?>" placeholder="Enter Night Ride From Time Rate" name="night_ride_time_rate" id="night_ride_time_rate" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="cartype">Time Type</label>
                                                <div id="inputCarType" class="col-lg-10">
                                                    <input type="text" value="<?php echo $row->timetype ?>" placeholder="Enter Time Type" name="timetype" id="timetype" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="cartype">Description</label>
                                                <div id="inputCarType" class="col-lg-10">
                                                    <input type="text" value="<?php echo $row->description ?>" placeholder="Enter Description" name="description" id="description" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="seatingcapecity">Loading Capacity</label>
                                                <div id="inputSeatingCapecity" class="col-lg-10">
                                                    <input type="text" value="<?php echo $row->seat_capacity ?>" placeholder="Seating Capecity" name="seating_capacity" id="seating_capacity" class="form-control">
                                                    <!--                        	<select class="form-control" id="seatingCapecity">-->
                                                    <!--                          	<option>Select Capecity</option>-->
                                                    <!--														<option>1</option>-->
                                                    <!--														<option>2</option>-->
                                                    <!--														<option>3</option>-->
                                                    <!--														<option>4</option>-->
                                                    <!--														<option>5</option>-->
                                                    <!--													</select>-->
                                                    <!--
                                                    <input type="text" onkeydown="errorValidUser();" placeholder="Enter seating capecity" name="seatingcapecity" id="seatingCapecity" class="form-control">
                                                    -->
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-lg-offset-1 col-lg-10">
                                                    <button style="display:block;" class="btn btn-success" name="save" id="notification-trigger-bouncyflip" type="submit">
                                                        <span id="category_button" class="content">SUBMIT</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <footer class="row" id="footer-bar" style="opacity: 1;">
                    <p id="footer-copyright" class="col-xs-12">
                        Powered by Naqilcom.
                    </p>
                </footer>
            </div>
        </div>
    </div>
</div>

<div id="config-tool" class="closed" style="display:none;">
    <a id="config-tool-cog">
        <i class="fa fa-cog"></i>
    </a>

    <div id="config-tool-options">
        <h4>Layout Options</h4>
        <ul>
            <li>
                <div class="checkbox-nice">
                    <input type="checkbox" id="config-fixed-header" checked />
                    <label for="config-fixed-header">
                        Fixed Header
                    </label>
                </div>
            </li>
            <li>
                <div class="checkbox-nice">
                    <input type="checkbox" id="config-fixed-sidebar" checked />
                    <label for="config-fixed-sidebar">
                        Fixed Left Menu
                    </label>
                </div>
            </li>
            <li>
                <div class="checkbox-nice">
                    <input type="checkbox" id="config-fixed-footer" checked />
                    <label for="config-fixed-footer">
                        Fixed Footer
                    </label>
                </div>
            </li>
            <li>
                <div class="checkbox-nice">
                    <input type="checkbox" id="config-boxed-layout" />
                    <label for="config-boxed-layout">
                        Boxed Layout
                    </label>
                </div>
            </li>
            <li>
                <div class="checkbox-nice">
                    <input type="checkbox" id="config-rtl-layout" />
                    <label for="config-rtl-layout">
                        Right-to-Left
                    </label>
                </div>
            </li>
        </ul>
        <br/>
        <h4>Skin Color</h4>
        <ul id="skin-colors" class="clearfix">
            <li>
                <a class="skin-changer" data-skin="" data-toggle="tooltip" title="Default" style="background-color: #34495e;">
                </a>
            </li>
            <li>
                <a class="skin-changer" data-skin="theme-white" data-toggle="tooltip" title="White/Green" style="background-color: #2ecc71;">
                </a>
            </li>
            <li>
                <a class="skin-changer blue-gradient" data-skin="theme-blue-gradient" data-toggle="tooltip" title="Gradient">
                </a>
            </li>
            <li>
                <a class="skin-changer" data-skin="theme-turquoise" data-toggle="tooltip" title="Green Sea" style="background-color: #1abc9c;">
                </a>
            </li>
            <li>
                <a class="skin-changer" data-skin="theme-amethyst" data-toggle="tooltip" title="Amethyst" style="background-color: #9b59b6;">
                </a>
            </li>
            <li>
                <a class="skin-changer" data-skin="theme-blue" data-toggle="tooltip" title="Blue" style="background-color: #2980b9;">
                </a>
            </li>
            <li>
                <a class="skin-changer" data-skin="theme-red" data-toggle="tooltip" title="Red" style="background-color: #e74c3c;">
                </a>
            </li>
            <li>
                <a class="skin-changer" data-skin="theme-whbl" data-toggle="tooltip" title="White/Blue" style="background-color: #3498db;">
                </a>
            </li>
        </ul>
    </div>
</div>

<!-- global scripts -->
<script src="<?php echo base_url();?>application/views/js/demo-skin-changer.js"></script> <!-- only for demo -->

<script src="<?php echo base_url();?>application/views/js/jquery.js"></script>
<script src="<?php echo base_url();?>application/views/js/bootstrap.js"></script>
<script src="<?php echo base_url();?>application/views/js/jquery.nanoscroller.min.js"></script>

<script src="<?php echo base_url();?>application/views/js/demo.js"></script> <!-- only for demo -->

<!-- this page specific scripts -->
<script src="<?php echo base_url();?>application/views/js/moment.min.js"></script>
<script src="<?php echo base_url();?>application/views/js/gdp-data.js"></script>

<!-- theme scripts -->
<script src="<?php echo base_url();?>application/views/js/scripts.js"></script>
<script src="<?php echo base_url();?>application/views/js/pace.min.js"></script>

<!-- this page specific inline scripts -->
<script type="text/javascript">
    $(window).load(function() {
        $(".cover").fadeOut(2000);
    });
    $(document).ready(function() {
        //CHARTS
        function gd(year, day, month) {
            return new Date(year, month - 1, day).getTime();
        }
    });
</script>
<!--	<script>-->
<!--		function validate() {-->
<!--			var x = document.forms["add_user"]["cartype"].value;-->
<!--			var car_rate = document.forms["add_user"]["carrate"].value;-->
<!--			var seating_capacity = document.forms["add_user"]["seating_capacity"].value;-->
<!--			var filename=document.getElementById('uploadImageFile').value;-->
<!--			var extension=filename.substr(filename.lastIndexOf('.')+1).toLowerCase();-->
<!--			var image=filename.substr(filename.lastIndexOf('.')+1).toLowerCase();-->
<!--			//alert(extension);-->
<!--		 if(image=='')-->
<!--			{-->
<!--				alert('car Image must be filled out');-->
<!--				return false;-->
<!--			}-->
<!--//		 else if(extension=='jpg' || extension=='gif' || extension=='jpeg' || extension=='png' ) {-->
<!--//				return true;-->
<!--//			}-->
<!--//-->
<!--//		 else-->
<!--//		 {-->
<!--//			 alert('Not Allowed Extension!');-->
<!--//			 return false;-->
<!--//		 }-->
<!--		else if (x == null || x == "") {-->
<!--				alert("Car Type must be filled out");-->
<!--				return false;-->
<!--			}-->
<!--			 else if (car_rate == null || car_rate == "") {-->
<!--			 alert("car rate must be filled out");-->
<!--			 return false;-->
<!--		 	}-->
<!--		 else if (seating_capacity == null || seating_capacity == "") {-->
<!--			 alert("seating capacity must be filled out");-->
<!--			 return false;-->
<!--		 }-->
<!---->
<!--		}-->
<!--	</script>-->
</body>
</html>
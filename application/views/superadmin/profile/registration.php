<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<title>::Art Gallery Admin Panel::</title>
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<!-- Custom CSS -->
<link href="css/custom.css" rel="stylesheet" type="text/css"/>
<link href="css/responsive.css" rel="stylesheet" type="text/css"/>
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
</head>
<body>
    <?php include 'header.php';?>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="container-fluid">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad">
             <div class="bread col-lg-7 col-md-7 col-sm-7 col-xs-12">
                <ul>
                    <li><a href="#" class="active"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                    <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
                     <li><a href="#">Products</a></li>
                    <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
                     <li><a href="#" class="active">Describe Products</a></li>
                </ul>
                 <div class="clearfix"></div>
            </div>
            <div class="bread col-lg-4 col-md-4 col-sm-4 col-xs-12 pull-right">
                <button class="btn btn-success btn-md"><i class="fa fa-check" aria-hidden="true"></i>&nbsp;Active</button>
                <button class="btn btn-warning btn-md"><i class="fa fa-ban" aria-hidden="true"></i>&nbsp;In Active</button>
                <button class="btn btn-primary btn-md"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Create New</button>
                <button class="btn btn-danger btn-md"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;Delete</button>
            </div>
        </div>
             <div class="clearfix"></div>
            <div class="details col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 details-date">
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 pull-left">
                      <select name="city" id="city" class="minimal chanagecity col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <option value="1" data-city="1">&nbsp;Nellore</option>
                        <option value="19" data-city="19">&nbsp;Tirupathi</option>
                    </select>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 pull-left">
                      <select name="city" id="city" class="minimal chanagecity col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <option value="1" data-city="1">&nbsp;Nellore</option>
                        <option value="19" data-city="19">&nbsp;Tirupathi</option>
                    </select>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pull-left search">
                      <div class="input-group">
                      <input type="text" class="form-control" placeholder="Search" aria-describedby="basic-addon2">
                      <span class="input-group-addon" id="basic-addon2"><i class="fa fa-search" aria-hidden="true"></i></span>
                    </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 pull-left search">
                     <div id="datepicker" class="input-group date" data-date-format="mm-dd-yyyy">
                        <input class="form-control" type="text" readonly />
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                    </div>
                    </div>
                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12 pull-left search">
                      <button class="btn btn-success btn-md">Search</button>
                    </div>
                    
                </div>
                <div class="clearfix"></div>
               <div class="alert alert-warning fade in">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <strong>Warning!</strong> There was a problem with your network connection.
                </div>
                 <div class="alert alert-danger fade in">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <strong>Error!</strong> A problem has been occurred while submitting your data.
                </div>
                <div class="alert alert-success fade in">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>Success!</strong> Your message has been sent successfully.
                </div>
                <div class="clearfix"></div>
                <div class="info col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="reg col-lg-8 col-md-8 col-sm-8 col-xs-12 col-lg-push-2 col-md-push-2 col-sm-push-3 col-xs-push-0">
                        <h4 class="text-center">Registration</h4>
                            <form role="form">
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
                                    <label>First Name<sup>*</sup><span>Please enter vaild Name</span></label>
			                         <input type="text" name="first_name" id="first_name" class="form-control input-md floatlabel" placeholder="First Name">
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
                                        <label>Last Name<sup>*</sup><span>Please enter vaild Name</span></label>
			    						<input type="text" name="last_name" id="last_name" class="form-control input-md" placeholder="Last Name">
			    					</div>
			    				</div>
			    			</div>
                            <div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
                                    <label>Select City<sup>*</sup><span>Please enter vaild Name</span></label>
			                        <select class="selectpicker form-control input-md">
                                        <option>--Select Your City--</option>
                                        <option>Kurnool</option>
                                        <option>Hyderabad</option>
                                         <option>Nellore</option>
                                        <option>Medak</option>
                                    </select>
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
                                        <label>Address<sup>*</sup><span>Please enter vaild Name</span></label>
			    						<textarea class="form-control input-md">
                                        
                                        </textarea>
			    					</div>
			    				</div>
			    			</div>
                            <div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
                                      <label><input type="checkbox" />&nbsp;Yes</label>
                                      <label><input type="checkbox" />&nbsp;No</label>
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
                                      <label><input type="radio" />&nbsp;Yes</label>
                                      <label><input type="radio" />&nbsp;No</label>
			    					</div>
			    				</div>
			    			</div>
                            <div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
                                       <button class="btn btn-default  btn-md pull-right">Reset</button>
                                        <button class="btn btn-danger btn-md pull-right">Submit</button>
			    					</div>
			    				</div>
			    			</div>
                        </form>
                    </div>
            </div>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>  
         <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
    <?php include 'footer.php';?>
   <div class="clearfix"></div>
		<!-- jQuery -->
		<script src="js/jquery.js"></script>
		<!-- Bootstrap Core JavaScript -->
		<script src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/date-picker.js"></script>
        <script type='text/javascript'>
        $(function () {
  $("#datepicker").datepicker({ 
        autoclose: true, 
        todayHighlight: true
  }).datepicker('update', new Date());;
});
        </script>

	</body>

</html>
<script type="text/javascript" src="js/jquery.smartmenus.js"></script>
<script type="text/javascript" src="js/jquery.smartmenus.bootstrap.js"></script>


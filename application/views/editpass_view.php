<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">  
	
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	    <title>hiện thị danh sách  nhân viên </title>
</head>
<style>
input[type=text], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=submit] {
  width: 100%;
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}


</style>
<body>
<nav class="navbar navbar-inverse ">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="<?php echo base_url() ?>/backend/backendmanager"><?php echo "Welcome nguyenmanh" ?></a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="<?php echo base_url() ?>/editpass">Thay đổi mật khẩu </a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login out</a></li>
    </ul>
  </div>
</nav>
<h3 style="margin-left:30%">Change password</h3>

<div>
<?php foreach ($dulieuketqua as $value): ?>
  <div id="Chanegedpass"  style="width:500px;margin-left:30%">
   <input type="hidden" id="id" value=<?php echo $value['id']?>>
    <label for="fname">old password</label>
    <input type="text" id="oldpassword" name="oldpassword" >
    <label for="lname">New Password</label>
    <input type="text" id="NewPassword" name="NewPassword">
    <label for="country">confirm Password</label>
    <input type="text" id="cfNewPassword" name="cfNewPassword">
    <button id="changepasswords"  value="Submit"> Submit </button>
</div>
  <?php endforeach ?>
</div>
  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url(); ?>vendors/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>vendors/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url(); ?>vendors/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo base_url(); ?>js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="<?php echo base_url(); ?>vendors/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="<?php echo base_url(); ?>js/demo/chart-area-demo.js"></script>
  <script src="<?php echo base_url(); ?>js/demo/chart-pie-demo.js"></script>
  <script type="text/javascript" src=" <?php echo base_url(); ?>1.js"></script>

</body>
</html>
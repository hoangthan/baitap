<!DOCTYPE html>
<html lang="en"><head>
	<title> Example </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body >
     <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
   
      <a class="navbar-brand" href="<?php echo base_url() ?>/backend/backendmanager"> Xin chào : <?php echo $_SESSION['uname']  ?></a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="<?php echo base_url() ?>/editpass">Thay đổi mật khẩu </a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a  href="<?php echo base_url()?>sinhvien/logout"><span class="glyphicon glyphicon-log-in"></span> Login out</a></li>
    </ul>
  </div>
</nav>
<!-- --end menu-- -->

<h3 style="text-align: center;"> Sách mới nhất </h3>
    <div class="container">
        <div class="row col-md-12">
            <div class="card col-md-4 col-lg-4" >
                <img class="card-img-top" src="https://www.ikea.com/us/en/images/products/matvra-book-hey-flavours-__0751118_PE746923_S5.JPG?f=xs" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Cơ sở lý thuyết mật mã </h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Mượn ngay</a>
                </div>
            </div>
            <div class="card col-md-4 col-lg-4" >
                <img class="card-img-top" src="https://www.ikea.com/us/en/images/products/matvra-book-hey-flavours-__0751118_PE746923_S5.JPG?f=xs" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">cơ sở an toàn thông tin</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
            <div class="card col-md-4 col-lg-4" >
                <img class="card-img-top" src="https://www.ikea.com/us/en/images/products/matvra-book-hey-flavours-__0751118_PE746923_S5.JPG?f=xs" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Phát triển phần mềm </h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
    </div>
     <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url(); ?>vendors/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>vendors/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url(); ?>vendors/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo base_url(); ?>js/sb-admin-2.min.js"></script>
  <script type="text/javascript" src=" <?php echo base_url(); ?>1.js"></script>
</body>
</html>
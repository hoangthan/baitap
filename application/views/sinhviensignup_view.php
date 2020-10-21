<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin 2 - Register</title>

  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url(); ?>vendors/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?php echo base_url(); ?>css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Đăng ký</h1>
              </div>
              <div class="user">
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="tel" class="form-control form-control-user"  placeholder="Nhập số điện thoại" name="phone" id="phone">
                  </div>
                  <div class="col-sm-6">
                    <input type="email" class="form-control form-control-user" placeholder="Nhập Email" name="email" id="email" required>
                  </div>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" placeholder="Địa chỉ" name="address" id="address" required>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user"  placeholder="Username" name="username" id="username" required>
                </div>
                <div class="form-group">
                <select name="roldangky"  class="form-control" id="exampleFormControlSelect">
                    <option>Sinh viên</option>
                    <option>Giáo viên</option>
                  </select>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" id="password" placeholder="Mật khẩu" name="password" required>
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user"id="passwordconfirms" placeholder="Nhập lại mật khẩu" name="psw-repeat" required>
                  </div>
                </div>
                <button type="submit" class="signupbtn btn btn-primary btn-user btn-block">
                  Đăng ký
                </button>
              </div>
              <hr>
              <div class="text-center">
                <a class="small" href="<?php echo base_url() ?>sinhvien/quenmatkhau">Quên mật khẩu</a>
              </div>
              <div class="text-center">
                <a class="small" href="<?php echo base_url() ?>login">Bạn đã có tài khoản? Đăng nhập</a>
              </div>
            </div>
          </div>
          <div class="col-lg-5">
                  <h2 style = "text-align: center; padding-top: 150px;">Hoàng Quang Thân</h2>
                  <h2 style = "text-align: center">AT130449</h2>
              </div>
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
  <script src="<?php echo base_url(); ?>script.js"></script>

</body>

</html>

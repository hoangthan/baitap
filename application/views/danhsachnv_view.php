<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">  
			<script type="text/javascript" src="<?php echo base_url(); ?>vendor/bootstrap.js"></script>
		 	<script type="text/javascript" src=" <?php echo base_url(); ?>script.js"></script>
		 	<script type="text/javascript" src=" <?php echo base_url(); ?>jqueryupload/js/vendor/jquery.ui.widget.js"></script>
		 	<script type="text/javascript" src=" <?php echo base_url(); ?>jqueryupload/js/jquery.fileupload.js"></script>
			<link rel="stylesheet" href=" <?php echo base_url(); ?>vendor/bootstrap.css">
			<link rel="stylesheet" href=" <?php echo base_url(); ?>vendor/font-awesome.css">
		 	<link rel="stylesheet" href=" <?php echo base_url(); ?>1.css">
	<title>hiện thị danh sách  nhân viên </title>
</head>
<body>
	<div class="container">
		<div class="text-xs-center">
			<h3> quan ly nhan vien </h3>
		</div>
	</div>

	<div class="container">
		<div class="row "> 
			<div class="card-deck-wrapper"> 
				<div class="card-deck">
				<?php foreach ($mangketqua as $value): ?>
					<div class="col-sm-4">
						<div class="card">
					<img class="card-img-top img-fluid" src="<?=  $value['anh']; ?>" alt="Card image cap">
					<div class="card-block">
						<h4 class="card-title ten"><?=  $value['ten']; ?></h4>
						<p class="card-text "> Tuôi :<?=  $value['tuoi']; ?> </p>
						<p class="card-text"> Địa chỉ :<?=  $value['diachi']; ?> </p>	
						<p class="card-text"> Số điện thoại:<?=  $value['sdt']; ?></p>
						<p class="card-text"> Đơn hàng : <?=  $value['donhang']; ?></p>	
							<a href="<?= base_url() ?>/index.php/nhansu/xoanhansu/<?=  $value['id']; ?>" class="btn btn-danger xoa"> <i class="fa fa-times"></i></a>
						<a href=" <?= base_url() ?>/index.php/nhansu/suanhansu/<?=  $value['id']; ?> " class="btn btn-success xoa"> <i class="fa fa-pencil"></i></a>
						<p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
					</div>
				</div>
					</div>
				<?php endforeach ?>
				</div>
			</div>
			
			</div>
		</div><!--  endroww -->
		</div>
            <div class="container">
		<div class="text-xs-center">
			<h3> Thêm mới nhân sự </h3>
		</div>
	
		<div class="row">
			<!-- <form method="post" enctype="multipart/form-data" action=" <?= base_url() ?>/index.php/nhansu/addinfor/ "> -->
				<div class="form-group row">
					<div class="col-sm-6">
						<div class="row">
							<label  class="col-sm-4 form-control-label text-xs-right">Ảnh đại diện</label>
								<div class="col-sm-8">
								<input name="files[]"type="file" class="form-control" id="anh">
								</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="row">
							<label  class="col-sm-4 form-control-label text-xs-right">Tên</label>
								<div class="col-sm-8">
								<input name="ten"type="text" class="form-control" id="ten" placeholder="thanhq">
								</div>
						</div>
					</div>
					
				</div>

				<div class="form-group row">
					<div class="col-sm-6">
						<div class="row">
							   <label  class="col-sm-4 form-control-label text-xs-right">Tuổi</label>
							<div class="col-sm-8">
								<input name="tuoi"type="number" class="form-control" id="tuoi">
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="row">
								<label class="col-sm-4 form-control-label text-xs-right">Điện thoại</label>
							<div class="col-sm-8">
									<input name="phone"type="text" class="form-control" id="phone">
							</div>
						</div>
					</div>
					
				</div>
				<div class="form-group row">
					<div class="col-sm-6">
						<div class="row">
							<label class="col-sm-4 form-control-label text-xs-right">Địa chỉ</label>
							<div class="col-sm-8">
								<input name="diachi"type="text" class="form-control" id="diachi">
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="row">
								<label class="col-sm-4 form-control-label text-xs-right">Đơn hàng</label>
								<div class="col-sm-8">
									<input name="donhang"type="text" class="form-control" id="donhang">
								</div>
						</div>
					</div>
					
				</div>
				<div class="form-group row">
					<div class=" col-sm-8">
						<button type="button" class="btn btn-success float-xl-right xulyajax ">thêm mới</button>
						<button type="submit" class="btn btn-danger float-xl-right ">Nhập lại</button>
					</div>
				</div>
			<!-- </form>  -->
		</div>
	</div>
	<script >    
		// sử lý upload file bằng ajax
		duongdan = '<?php echo base_url() ?>';

		$('#anh').fileupload({
			url: duongdan + 'index.php/nhansu/uploadajax',
			dataType:'json',
			done: function(e, data){
				$.each(data.result.files, function (index, file) { 
					tenfile = file.url ;
					
				});

			}
		})
		// sử lý dữ luieuj nội dung về form 
		$('.xulyajax').click(function(event) {
			$.ajax({
		url:'nhansu/ajaxadd',
		type:'POST',
		dataType:'json',
		data: {
			ten: $('#ten').val(),
			tuoi: $('#tuoi').val(),
			diachi: $('#diachi').val(),
			phone: $('#phone').val(),
			anh: tenfile,
			donhang: $('#donhang').val(),
			},
	})
	.done(function() {
		console.log("success");

	})
	.fail(function() {
		console.log("error");
	})
	.always(function() {
		// thêm nội dung bằng hàm apppen sử lý dữ liệu bên ngoài 
		noidung= '<div class="col-sm-4">';
		noidung+='<div class="card">';
		noidung+='<img class="card-img-top img-fluid" src="'+tenfile+'" alt="Card image cap">';
		noidung+='<div class="card-block">';
		noidung+='<h4 class="card-title ten">' +$('#ten').val()+' </h4>';
		noidung+='<p class="card-text "> Tuôi :' +$('#tuoi').val()+ '</p>';
		noidung+='<p class="card-text"> Địa chỉ :' +$('#diachi').val()+ '</p>';
		noidung+='<p class="card-text"> Số điện thoại:'+$('#phone').val()+'</p>';
		noidung+='<p class="card-text"> Đơn hàng : '+$('#donhang').val()+'</p>';
		noidung+='<a href=" <?= base_url() ?>/index.php/nhansu/suanhansu/<?=  $value['id']; ?> " class="btn btn-success xoa"> <i class="fa fa-pencil"></i></a>';
		noidung+='<p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>';
		noidung+='</div>';
		noidung+='</div>';
		noidung+='</div>';
			$('.card-deck').append(noidung);
			// reset nội dung  đã điền 
		 	$('#ten').val('');
			 $('#tuoi').val('');
			 $('#diachi').val('');
			 $('#phone').val('');
			//anh: $('#anh').val(),
			 $('#donhang').val('');
			
		console.log("complete");
	});
	
		});
	
	</script>
</body>
</html>
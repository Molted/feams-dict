<?= $this->extend('temp') ?>

<?= $this->section('styles') ?>
    <link rel="stylesheet" href="<?= base_url();?>/public/css/login.css">
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div id="login">
    <div class="container">
        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6">
                <div id="login-box" class="col-md-12">
                    <form id="login-form" class="form" action="<?= base_url();?>/forgot-password" method="post">
                        <img src= "<?= esc(base_url());?>/public/img/fealogo.png" alt="logo" style="height: 65px; margin-bottom: 50px; margin-left: 78px;">
                        <h6 class="text-center" style="padding-bottom: 20px; color: black; opacity: 0.5;">Forgot Password</h6>
                            <div class="form-group">
                                <label style="color: #616161;">Enter your email to send a link to reset your password: </label><br>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email" required>
                            </div>
                            

                            <input type="submit" name="submit" class="btn btn-info btn-md login-btn" value="Reset Password">
                    </form>
                    <div id="register-links" class="text-center" style="padding-top: 35px; font-size: 12px; <?php if(!empty(session()->getFlashdata('failMsg')) || !empty(session()->getFlashdata('successMsg'))) echo 'margin-top: -60px;'?>">
                        <label>Don't have an account?</label> <a href="<?= base_url('register');?>" class="text-info">Register here</a>
                        <br>
                        <a href="<?= base_url('login');?>" class="text-info">Log In</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

<!-- SweetAlert JS -->
<script src="<?= base_url();?>/public/js/sweetalert.min.js"></script>
<script src="<?= base_url();?>/public/js/sweetalert2.all.min.js"></script>

<?php if(!empty(session()->getFlashdata('successMsg'))):?>
	<!-- SweetAlert JS -->
	<script src="<?= base_url();?>/public/js/sweetalert.min.js"></script>
	<script src="<?= base_url();?>/public/js/sweetalert2.all.min.js"></script>
	<script>
		window.onload = function() {

			Swal.fire({
				icon: 'success',
				title: 'Success!',
				text: '<?= session()->getFlashdata('successMsg');?>',
				confirmButtonColor: '#3085d6',
				confirmButtonText: 'Okay'
			})/*swal2*/.then((result) =>
			{
				/* Read more about isConfirmed, isDenied below */
				if (result.isConfirmed)
				{
					Swal.close()
				}
			})//then
		};
	</script>
<?php elseif(!empty(session()->getFlashdata('failMsg'))):?>
	<script>
		window.onload = function() {

			Swal.fire({
				icon: 'error',
				title: 'Error!',
				text: '<?= session()->getFlashdata('failMsg');?>',
				confirmButtonColor: '#3085d6',
				confirmButtonText: 'Okay'
			})/*swal2*/.then((result) =>
			{
				/* Read more about isConfirmed, isDenied below */
				if (result.isConfirmed)
				{
					Swal.close()
				}
			})//then
		};
	</script>
<?php endif;?>


<script>
  function resetStyle() {
      document.getElementById("register-links").style.marginTop = "1px";
  }

  document.querySelector('.custom-file-input').addEventListener('change', function (e) {
    var name = document.getElementById("proof").files[0].name;
    var nextSibling = e.target.nextElementSibling
    nextSibling.innerText = name
  })
</script>

<?= $this->endSection() ?>
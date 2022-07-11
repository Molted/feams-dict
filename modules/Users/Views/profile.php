<?= $this->extend('adminlte') ?>

<?= $this->section('styles') ?>
  <!-- Select2 -->
  <link rel="stylesheet" href="<?= base_url()?>/public/dist/adminlte/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?= base_url()?>/public/dist/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

  <style>
    .required:after {
        content:" *";
        color: red;
    }

    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }

    /* Firefox */
    input[type=number] {
      -moz-appearance: textfield;
    }
  </style>
<?= $this->endSection() ?>

<?= $this->section('page_header') ?>
<div class="row mb-2">
    <div class="col-sm-6">
            <h1><?= ucwords(strtolower(esc($title)))?></h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('admin/users')?>">Users</a></li>
            <li class="breadcrumb-item active"><?= esc($title)?></li>
        </ol>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?php if(!empty(session()->getFlashdata('failMsg'))):?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <?= session()->getFlashdata('failMsg');?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php endif;?>
<?php if(!empty(session()->getFlashdata('successMsg'))):?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <?= session()->getFlashdata('successMsg');?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php endif;?>

<div class="row">
    <div class="col-md-3">
        <!-- Profile Image -->
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <!-- <img class="profile-user-img img-fluid img-circle"
                        src="<?= base_url()?>/public/uploads/profile_pic/<?= esc($user['profile_pic'])?>"
                        alt="User profile picture"> -->
                    <img class="profile-user-img img-fluid img-circle"
                        src="<?= empty($user['profile_pic']) ? base_url().'/public/img/blank.jpg' : base_url().'/public/uploads/profile_pic/'.esc($user['profile_pic'])?>"
                        alt="User profile picture">
                </div>
                <h3 class="profile-username text-center"><?= ucwords(strtolower(esc($user['first_name'])))?> <?= ucwords(strtolower(esc($user['last_name'])))?></h3>
                <p class="text-muted text-center"><?= esc($user['role_name'])?></p>
                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>Birthdate</b> 
                        <a class="float-right">
                          <?php
                            $date = date_create(esc($user['birthdate']));
                            echo esc(date_format($date, 'F d, Y'));
                          ?>
                        </a>
                    </li>
                    <li class="list-group-item">
                      <b>Gender</b> <a class="float-right"> <?= esc($user['gender'])?> </a>
                    </li>
                    <li class="list-group-item">
                      <b>Status</b>
                      <a class="float-right">
                        <?php
                          switch(esc($user['status'])) {
                            case '1': echo 'Active'; break;
                            case '2': echo 'Inactive'; break;
                            case '3': echo 'Paid'; break;
                            case '4': echo 'Unpaid'; break;
                          }
                        ?>
                      </a>
                    </li>
                </ul>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
    <div class="col-md-9">
        <!-- User details -->
        <div class="card">
            <div class="card-header">
              User details
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="mb-2">
                <b>Username</b> <a class="float-right"><?= esc($user['username'])?></a> <br>
              </div>
              <div class="mb-2">
                <b>Contact Number</b> <a class="float-right"><?= esc($user['contact_number'])?></a> <br>
              </div>
              <div class="mb-2">
                <b>Email</b> <a class="float-right"><?= esc($user['email'])?></a> <br>
              </div>
            </div><!-- /.card-body -->
        </div>
        <!-- /.card -->
        <div class="card">
            <div class="card-header">
                Files uploaded
            </div><!-- /.card-header -->
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">File</th>
                            <th scope="col">Date uploaded</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $ctr = 1?>
                        <?php if(empty($files)): ?>
                        <tr>
                            <td colspan="4" class="text-center">No files uploaded by user</td>
                        </tr>
                        <?php else: ?>
                            <?php foreach($files as $file): ?>
                                <tr>
                                <td><?=esc($ctr)?></td>
                                <td><a href="<?= base_url()?>/public/uploads/files/<?=esc($file['category'])?>/<?=esc($file['name'])?>" class="card-link" target="_blank" rel="noopener noreferrer"><?= esc($file['name'])?></a></td>
                                <td>
                                    <?php
                                    $date = date_create(esc($file['uploaded_at']));
                                    echo date_format($date, 'F d, Y H:i');
                                    ?>
                                </td>
                                </tr>
                                <?php $ctr++?>            
                            <?php endforeach;?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div><!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->

<!-- Payments -->
  <div class="card">
      <div class="card-header">
        Contribution details
      </div><!-- /.card-header -->
      <div class="card-body">
        <table class="table" id="table_pay">
          <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Contribution</th>
                <th scope="col">Cost</th>
                <th scope="col">Paid</th>
                <th scope="col">Balance</th>
            </tr>
          </thead>
          <tbody>
            <?php $ctr = 1?>
            <?php foreach($contribs as $contri):?>
              <tr>
                <td><?= esc($ctr)?></td>
                <td><?= esc($contri['name'])?></td>
                <td><?= esc($contri['cost'])?></td>
                <td>
                  <?php $amt = 0;
                    foreach($payments as $pay) {
                      if($pay['contri_id'] == $contri['id']) {
                        $amt += $pay['amount'];
                      }
                    }
                    echo esc($amt);
                    ?>
                </td>
                <td>
                  <?php $total = $contri['cost'] - $amt; echo esc($total)?>
                </td>
              </tr>
              <?php $ctr++;?>
            <?php endforeach?>
          </tbody>
        </table>
      </div><!-- /.card-body -->
  </div>
<!-- End Payments -->

<?php $status = false; $role = false;
foreach($perm_id['perm_id'] as $perms) {
  if(!$status) {
    if($perms == '3') {
      $status = true;
      // echo '<h3>status</h3>';
    }
  }
  if(!$role) {
    if($perms == '4') {
      $role = true;
      // echo '<h3>role</h3>';
    }
  }
}?>

<?php if(session()->get('user_id') == $user['id'] || isset($edit)):?>
<div class="card">
  <div class="card-header">
    Edit User Information
  </div>
  <div class="card-body">
    <form action="<?= base_url()?>/user/<?= esc($user['username'])?>" method="post" enctype="multipart/form-data" id="userForm">
      <div class="form-row">
        <div class="form-group col-md-4">
          <label for="first_name">First Name</label>
          <input type="text" class="form-control <?=isset($errors['first_name']) ? 'is-invalid': ''?>" id="first_name" name="first_name" placeholder="Enter first name" value="<?= $user['first_name']?>" required>
          <?php if(isset($errors['first_name'])):?>
            <div class="invalid-feedback">
                <?=esc($errors['first_name'])?>
            </div>
          <?php endif;?>
        </div>
        <div class="form-group col-md-4">
          <label for="middle_name">Middle Name</label>
          <input type="text" class="form-control <?=isset($errors['middle_name']) ? 'is-invalid': ''?>" name="middle_name" value="<?= $user['middle_name']?>" required>
          <?php if(isset($errors['middle_name'])):?>
            <div class="invalid-feedback">
                <?=esc($errors['middle_name'])?>
            </div>
          <?php endif;?>
        </div>
        <div class="form-group col-md-4">
          <label for="last_name">Last Name</label>
          <input type="text" class="form-control <?=isset($errors['last_name']) ? 'is-invalid': ''?>" name="last_name" value="<?= $user['last_name']?>" required>
          <?php if(isset($errors['last_name'])):?>
            <div class="invalid-feedback">
                <?=esc($errors['last_name'])?>
            </div>
          <?php endif;?>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="email">Email address</label>
          <input type="email" class="form-control <?=isset($errors['email']) ? 'is-invalid': ''?>" name="email" value="<?= $user['email']?>">
          <?php if(isset($errors['email'])):?>
            <div class="invalid-feedback">
                <?=esc($errors['email'])?>
            </div>
          <?php endif;?>
        </div>
        <div class="form-group col-md-6">
          <label for="contact_number">Contact Number</label>
          <input type="text" class="form-control <?=isset($errors['contact_number']) ? 'is-invalid': ''?>" name="contact_number" value="<?= $user['contact_number']?>" required>
          <?php if(isset($errors['contact_number'])):?>
            <div class="invalid-feedback">
                <?=esc($errors['contact_number'])?>
            </div>
          <?php endif;?>
        </div>
      </div>
      <?php if($user['role'] != '0'):?>
        <div class="form-group">
          <label for="exampleInputFile">Profile Picture</label>
          <div class="input-group">
              <div class="custom-file">
                  <input type="file" class="custom-file-input <?php if(!empty($errors['image'])) echo 'is-invalid';?>" id="image" name="image" required>
                  <label class="custom-file-label" for="exampleInputFile">Choose file</label>
              </div>
          </div>
          <?php if(isset($errors['image'])): ?>
              <small id="emailHelp" class="form-text text-danger"><?= $errors['image']?></small>
          <?php endif; ?>
        </div>
      <?php endif;?>
      <?php if($role):?>
        <!-- Role -->
        <?php if($user['role'] == 0):?>
          <div class="form-group">
            <label for="role">Role</label>
            <select class="form-control form-control-sm select2bs4" name="role" disabled>
              <option value="0" selected>Temporary</option>
            </select>
          </div>
        <?php else:?>
          <div class="form-group">
            <label for="role">Role</label>
            <select class="form-control form-control-sm select2bs4" name="role">
              <?php foreach($roles as $role):?>
                <option value="<?= esc($role['id'])?>" <?= $user['role'] ==$role['id'] ? 'selected' : ''?>><?= esc($role['role_name'])?></option>
              <?php endforeach;?>
            </select>
          </div>
        <?php endif;?>
        <div class="form-group">
          <label for="type">Employee Type</label>
          <select class="form-control form-control-sm select2bs4" name="type">
            <option value="1" <?= $user['type'] == '1' ? 'selected' : ''?>>Regular</option>
            <option value="2" <?= $user['type'] == '2' ? 'selected' : ''?>>Part-time</option>
            <option value="3" <?= $user['type'] == '3' ? 'selected' : ''?>>Admin</option>
          </select>
        </div>
      <?php endif;?>
      <?php if($status):?>
        <!-- Role -->
        <div class="form-group">
          <label for="status">Status</label>
          <select class="form-control form-control-sm select2bs4" name="status">
            <option value="1" <?= $user['status'] == '1' ? 'selected' : ''?>>Active</option>
            <option value="2" <?= $user['status'] == '2' ? 'selected' : ''?>>Inactive</option>
            <option value="3" <?= $user['status'] == '3' ? 'selected' : ''?>>Paid</option>
            <option value="0" <?= $user['status'] == '0' ? 'selected' : ''?>>Unpaid</option>
          </select>
        </div>
      <?php else:?>
        <input type="hidden" name="status" value="<?= $user['status']?>">
      <?php endif;?>
      <input type="hidden" name="form_type" value="userdetails">
  </div>
  <div class="card-footer">
    <button class="btn btn-primary btn-sm sub" type="button">Save changes</button>
    </form>
  </div>
</div>
<?php endif;?>
<?php if(session()->get('role') == 1):?>
  <?php if(session()->get('user_id') == $user['id']):?>
    <div class="card">
      <div class="card-header">
        Update Password
      </div>
      <div class="card-body">
        <form action="<?= base_url()?>/user/<?= esc($user['username'])?>" method="post" enctype="multipart/form-data" id="passForm">
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="current_password">Current Password</label>
                <input type="password" class="form-control <?php if(!empty($errors['current_password'])) echo 'is-invalid';?>" id="current_password" name="current_password" placeholder="Enter current password">
                <?php if(isset($errors['current_password'])): ?>
                  <small id="current_password_help" class="form-text text-danger"><?= $errors['current_password']?></small>
                <?php endif; ?>
              </div>
              <div class="form-group col-md-4">
                <label for="new_password">New Password</label>
                <input type="password" class="form-control <?php if(!empty($errors['new_password'])) echo 'is-invalid';?>" id="new_password" name="new_password" placeholder="Enter new password">
                <input type="checkbox" onclick="showPass()"> Show Password
                <?php if(isset($errors['new_password'])): ?>
                  <small id="new_password_help" class="form-text text-danger"><?= $errors['new_password']?></small>
                <?php endif; ?>
              </div>
              <div class="form-group col-md-4">
                <label for="confirm_new_password">Confirm New Password</label>
                <input type="password" class="form-control <?php if(!empty($errors['new_password'])) echo 'is-invalid';?>" id="confirm_new_password" name="confirm_new_password" placeholder="Confirm new password">
              </div>
            </div>
          <input type="hidden" name="form_type" value="updatepass">
      </div>
      <div class="card-footer">
        <button class="btn btn-primary btn-sm pass" type="button">Update Password</button>
        </form>
      </div>
    </div>
  <?php endif;?>
<?php else:?>
  <?php if(session()->get('user_id') == $user['id']):?>
    <div class="card">
      <div class="card-header">
        Update Password
      </div>
      <div class="card-body">
        <form action="<?= base_url()?>/user/<?= esc($user['username'])?>" method="post" enctype="multipart/form-data" id="passForm">
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="current_password">Current Password</label>
                <input type="password" class="form-control <?php if(!empty($errors['current_password'])) echo 'is-invalid';?>" id="current_password" name="current_password" placeholder="Enter current password">
                <?php if(isset($errors['current_password'])): ?>
                  <small id="current_password_help" class="form-text text-danger"><?= $errors['current_password']?></small>
                <?php endif; ?>
              </div>
              <div class="form-group col-md-4">
                <label for="new_password">New Password</label>
                <input type="password" class="form-control <?php if(!empty($errors['new_password'])) echo 'is-invalid';?>" id="new_password" name="new_password" placeholder="Enter new password">
                <?php if(isset($errors['new_password'])): ?>
                  <small id="new_password_help" class="form-text text-danger"><?= $errors['new_password']?></small>
                <?php endif; ?>
              </div>
              <div class="form-group col-md-4">
                <label for="confirm_new_password">Confirm New Password</label>
                <input type="password" class="form-control <?php if(!empty($errors['new_password'])) echo 'is-invalid';?>" id="confirm_new_password" name="confirm_new_password" placeholder="Confirm new password">
              </div>
            </div>
          <input type="hidden" name="form_type" value="updatepass">
      </div>
      <div class="card-footer">
        <button class="btn btn-primary btn-sm pass" type="button">Update Password</button>
        </form>
      </div>
    </div>
    <?php endif;?>
<?php endif;?>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

<script>
  function showPass() {
  var x = document.getElementById("new_password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>

<!-- Select2 -->
<script src="<?= base_url();?>/public/dist/select2/js/select2.full.min.js"></script>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4',
    })
  })
</script>

<script>
// BS4 tooltips
  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })
  
  // DataTables
  $(function () {
    $('#table_pay').DataTable({
      "responsive": true,
      "autoWidth": false,
      });
  });
</script>

<!-- SweetAlert JS -->
<script src="<?= base_url();?>/public/js/sweetalert.min.js"></script>
<script src="<?= base_url();?>/public/js/sweetalert2.all.min.js"></script>
<!-- SweetAlert2 -->
<script type="text/javascript">

  $(document).ready(function ()
  {
    $('.status').on('change', function() {
      var $form = $(this).closest('form');
      $form.submit();
    });

    $('.sub').click(function (e)
    {
      e.preventDefault();
      var id = $(this).val();
      console.log(id);

      Swal.fire({
        icon: 'question',
        title: 'Edit?',
        text: 'If email is changed, it needs to verify again',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, edit it!'
      })/*swal2*/.then((result) =>
      {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed)
        {
          $('#userForm').submit();
        }
        else if (result.isDenied)
        {
          Swal.fire('Changes are not saved', '', 'info')
        }
      })//then
    });

    $('.pass').click(function (e)
    {
      e.preventDefault();
      var id = $(this).val();
      console.log(id);

      Swal.fire({
        icon: 'question',
        title: 'Update Password?',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, update it!'
      })/*swal2*/.then((result) =>
      {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed)
        {
          $('#passForm').submit();
        }
        else if (result.isDenied)
        {
          Swal.fire('Changes are not saved', '', 'info')
        }
      })//then
    });
  });
</script>

<!-- file uploads para mapalitan agad file name once makaselect na ng file -->
<script>
    document.querySelector('.custom-file-input').addEventListener('change', function (e)
    {
    var name = document.getElementById("image").files[0].name;
    var nextSibling = e.target.nextElementSibling
    nextSibling.innerText = name
    })
</script>
<?= $this->endSection() ?>
    

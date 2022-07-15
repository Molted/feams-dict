<?= $this->extend('adminlte') ?>

<?= $this->section('styles') ?>
  <!-- Select2 -->
  <link rel="stylesheet" href="<?= base_url()?>/public/dist/adminlte/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?= base_url()?>/public/dist/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<?= $this->endSection() ?>

<?= $this->section('page_header');?>
<div class="row mb-2">
    <div class="col-sm-6">
            <h1><?= $edit ? 'Edit': 'Add'?> <?= esc($title)?></h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('admin/elections')?>">Elections</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('admin/positions');?>">Positions</a></li>
            <li class="breadcrumb-item active"><?= $edit ? 'Edit': 'Add'?></li>
        </ol>
    </div>
</div>
<?= $this->endSection();?>

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

<form action="<?= base_url('admin/positions')?>/edit/<?= esc($election['id'])?>" method="post" enctype="multipart/form-data" id="posForm">
  <div class="card card-light">
    <div class="card-body">
      <div class="form-group">
        <label for="election_id">Election Name</label>
        <input type="text" id="" class="form-control" placeholder="<?= esc($election['title'])?>" disabled>
        <input type="hidden" value="<?= esc($election['id'])?>" name="election_id">
      </div>
      <div class="form-group">
        <label for="positions">Positions</label>
        <select class="form-control select2bs4 <?=isset($errors['position_id']) ? 'is-invalid': ''?>" multiple="multiple" id="position_id" name="position_id[]" data-placeholder="Select Position/s" required>
          <option value="">Select...</option>
          <?php foreach($electoralPosition as $elec):?>
            <?php $selected = false;?>
            <?php foreach($positions as $pos):?>
              <?php if($elec['id'] == $pos['elec_position_id']):?>
                  <option value="<?= esc($elec['id'])?>" selected><?= esc($elec['position_name'])?></option>
                  <?php $selected = true;?>
              <?php endif;?>
            <?php endforeach;?>
            <?php if(!$selected):?>
              <option value="<?= esc($elec['id'])?>"><?= esc($elec['position_name'])?></option>
            <?php endif;?>
          <?php endforeach;?>
        </select>
        <?php if(isset($errors['position_id'])):?>
            <div class="invalid-feedback">
                <?=esc($errors['position_id'])?>
            </div>
        <?php endif;?>
      </div>
    </div>
    <div class="card-footer">
      <button type="submit" class="float-end btn btn-primary btn-sm" >Submit</button>
    </div>
  </div>
</form>

<?= $this->endSection();?>

<?= $this->section('scripts') ?>

<!-- SweetAlert JS -->
<script src="<?= base_url();?>/public/js/sweetalert.min.js"></script>
<script src="<?= base_url();?>/public/js/sweetalert2.all.min.js"></script>
<!-- Select2 -->
<script src="<?= base_url();?>/public/dist/adminlte/plugins/select2/js/select2.full.min.js"></script>
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
<!-- SweetAlert2 -->
<script type="text/javascript">

  $(document).ready(function ()
  {
    $('input[type="submit"]').click(function (e)
    {
      e.preventDefault();

      Swal.fire({
        icon: 'question',
        title: 'Add?',
        text: 'Are you sure to add position?',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, add it!'
      })/*swal2*/.then((result) =>
      {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed)
        {
          document.getElementById('posForm').submit();
        }
        else if (result.isDenied)
        {
          Swal.fire('Changes are not saved', '', 'info')
        }
      })//then
    });
  });
</script>

<?= $this->endSection();?>
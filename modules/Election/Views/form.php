<?= $this->extend('adminlte') ?>

<?= $this->section('styles') ?>
  <!-- daterange picker -->
  <link rel="stylesheet" href="<?= base_url()?>/public/dist/adminlte/plugins/daterangepicker/daterangepicker.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?= base_url()?>/public/dist/adminlte/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?= base_url()?>/public/dist/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<?= $this->endSection() ?>

<?= $this->section('page_header');?>
<div class="row mb-2">
    <div class="col-sm-6">
            <h1><?= esc($title)?></h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('admin/election')?>">Elections</a></li>
            <li class="breadcrumb-item active"><?= esc($title)?></li>
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

<form action="<?= base_url('admin/election')?>/<?= $edit ? 'edit/'.esc($id): 'add'?>" method="post" enctype="multipart/form-data">

<div class="card card-light">
  <div class="card-body">
      <div class="form-group">
        <label for="title">Election Title</label>
        <input type="text" class="form-control <?=isset($errors['title']) ? 'is-invalid': ''?>" id="title" placeholder="Election Title" name="title" value="<?=isset($value['title']) ? esc($value['title']): ''?>">
        <?php if(isset($errors['title'])):?>
            <div class="invalid-feedback">
                <?=esc($errors['title'])?>
            </div>
        <?php endif;?>
      </div>
      <div class="form-group">
        <label for="type">Election Type</label>
        <select class="form-control <?=isset($errors['type']) ? 'is-invalid': ''?>" id="type" placeholder="Election Type" name="type" value="<?=isset($value['type']) ? esc($value['type']): ''?>">
          <option value=''>Choose one...</option>
          <option value='1'>By Party</option>
          <option value='2'>By employee type</option>
        </select>
        <!-- <input type="text" class="form-control <?=isset($errors['type']) ? 'is-invalid': ''?>" id="title" placeholder="Election Title" name="title" value="<?=isset($value['title']) ? esc($value['title']): ''?>"> -->
        <?php if(isset($errors['type'])):?>
            <div class="invalid-feedback">
                <?=esc($errors['type'])?>
            </div>
        <?php endif;?>
      </div>
      <div class="form-row">
        <!-- Vote datetime -->
        <div class="form-group col-md-12">
          <label for="title">Vote Dates</label>
          <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  <i class="far fa-calendar-alt"></i>
                </span>
              </div>
              <input type="text" class="form-control float-right <?=isset($errors['vote_start']) ? 'is-invalid': ''?>  <?=isset($errors['vote_end']) ? 'is-invalid': ''?>" id="voteTime">
              <?php if(isset($errors['vote_start']) && !isset($errors['vote_end'])):?>
                <div class="invalid-feedback">
                    <?=esc($errors['vote_start'])?>
                </div>
              <?php endif;?>
              <?php if(isset($errors['vote_end']) && !isset($errors['vote_start'])):?>
                <div class="invalid-feedback">
                    <?=esc($errors['vote_end'])?>
                </div>
              <?php endif;?>
              <?php if(isset($errors['vote_end']) && isset($errors['vote_start'])):?>
                <div class="invalid-feedback">
                    Start and end date is invalid
                </div>
              <?php endif;?>
          </div>
          <input type="hidden" name="vote_start" id="vote_start">
          <input type="hidden" name="vote_end" id="vote_end">
        </div>
      </div>
  </div>
  <div class="card-footer">
      <button type="submit" class="float-end btn btn-primary btn-sm" >Submit</button>
  </div>
</div>
</form>

<?= $this->endSection();?>

<?= $this->section('scripts') ?>

<!-- InputMask -->
<script src="<?= base_url();?>/public/dist/adminlte/plugins/moment/moment.min.js"></script>
<script src="<?= base_url();?>/public/dist/adminlte/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<!-- date-range-picker -->
<script src="<?= base_url();?>/public/dist/adminlte/plugins/daterangepicker/daterangepicker.js"></script>
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
<!-- datetime -->
<script>
$(function() {
  $('#voteTime').daterangepicker({
    autoUpdateInput: false,
    timePicker: true,
    minDate: new Date(),
    maxYear: moment().year(),
    startDate: moment().startOf('hour'),
    endDate: moment().startOf('hour').add(32, 'hour'),
    locale: {
      format: 'MMM DD,YYYY hh:mm A',
      cancelLabel: 'Clear'
    }
  }, function(start, end, label) {
    document.getElementById('vote_start').value = start.format('YYYY-MM-DD HH:mm:ss');
    document.getElementById('vote_end').value = end.format('YYYY-MM-DD HH:mm:ss');
  });
  
  $('#voteTime').on('apply.daterangepicker', function(ev, picker) {
    $(this).val(picker.startDate.format('MMM DD,YYYY hh:mm:ss') + ' - ' + picker.endDate.format('MMM DD,YYYY hh:mm:ss'));
    document.getElementById('vote_start').value = picker.startDate.format('YYYY-MM-DD HH:mm:ss');
    document.getElementById('vote_end').value = picker.endDate.format('YYYY-MM-DD HH:mm:ss');
  });

  $('#voteTime').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
  });
});
</script>
<!-- date only -->
<script>
  $(function () {
    $('#votes').daterangepicker({
      autoUpdateInput: false,
      minDate: new Date(),
      maxYear: moment().year(),
      locale: {
        format: 'MMM DD,YYYY',
        cancelLabel: 'Clear'
      }
    }, function(start, end, label) {
        document.getElementById('vote_start').value = start.format('YYYY-MM-DD');
        document.getElementById('vote_end').value = end.format('YYYY-MM-DD');
    });

    $('#votes').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('MMM DD,YYYY') + ' - ' + picker.endDate.format('MMM DD,YYYY'));
    });

    $('#votes').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });
  })
</script>
<?= $this->endSection();?>
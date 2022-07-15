<?= $this->extend('adminlte') ?>

<?= $this->section('page_header') ?>
<div class="row mb-2">
    <div class="col-sm-6">
            <h1><?= esc($title)?></h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url();?>">Home</a></li>
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

<div class="card">
  <?php foreach($perm_id['perm_id'] as $perms):?>
    <?php if($perms == '15'):?>
      <div class="card-header">
        <div class="float-right">
            <a class="btn btn-primary btn-sm" href="<?= base_url('admin/sliders/add')?>" role="button">Add Slider</a>
        </div>
      </div>
    <?php endif;?>
  <?php endforeach;?>
  <div class="card-body">
    <table class="table table-hover" id="sliders">
        <thead class="thead-light">
            <tr>
              <th scope="col" style="width: 5%">#</th>
              <th scope="col" style="width: 20%">Title</th>
              <th scope="col" style="width: 20%">Uploader</th>
              <th scope="col" style="width: 40%">Description</th>
              <th scope="col" style="width: 15%">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $ctr = 1?>
            <?php foreach($sliders as $slider):?>
              <tr>
                  <th scope="row"><?= esc($ctr)?></th>
                  <td><?= esc($slider['title'])?></td>
                  <td><?= esc($slider['first_name'])?> <?= esc($slider['last_name'])?></td>
                  <td><?= esc($slider['description'], 'raw')?></td>
                  <td>
                    <!-- <a class="btn btn-info btn-sm" href="#" role="button">Link</a> -->
                    <?php foreach($perm_id['perm_id'] as $perms):?>
                      <?php if($perms == '12'):?>
                        <a class="btn btn-warning btn-sm" href="<?=base_url('admin/sliders/edit/' . esc($slider['id'], 'url'))?>" data-toggle="tooltip" data-placement="bottom" title="Edit Slider"> <i class="fas fa-edit"></i> </a>
                      <?php elseif($perms == '13'):?>
                        <button type="button" value="<?= esc($slider['id'])?>" class="btn btn-danger btn-sm del" data-toggle="tooltip" data-placement="bottom" title="Delete Slider"><i class="fas fa-trash"></i></button>
                      <?php endif;?>
                    <?php endforeach;?>
                  </td>
              </tr>
              <?php $ctr++?>    
            <?php endforeach;?>
        </tbody>
    </table>
  </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

<script>
// BS4 tooltips
  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })
  
  // DataTables
  $(function () {
    $('#sliders').DataTable({
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
    $('.del').click(function (e)
    {
      e.preventDefault();
      var link = $(this).val();
      console.log(link);

      Swal.fire({
        icon: 'question',
        title: 'Delete?',
        text: 'Are you sure to delete slider?',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      })/*swal2*/.then((result) =>
      {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed)
        {
          window.location = '<?= base_url()?>/admin/sliders/delete/' + link;
        }
        else if (result.isDenied)
        {
          Swal.fire('Changes are not saved', '', 'info')
        }
      })//then
    });
  });
</script>
<?= $this->endSection() ?>
    
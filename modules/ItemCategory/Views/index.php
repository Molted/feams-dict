<?= $this->extend('adminlte') ?>

<?= $this->section('styles') ?>
  <!-- Select2 -->
  <link rel="stylesheet" href="<?= base_url();?>/public/dist/select2/css/select2.min.css">
  <!-- <link rel="stylesheet" href="<?= base_url();?>dist/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css"> -->
<?= $this->endSection() ?>

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
  <div class="card-header">
    <!-- <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#exampleModal">
      <i class="fas fa-upload"></i> 
    </button> -->
    <div class="float-right">
            <a class="btn btn-primary btn-sm" href="<?= base_url('admin/category/add')?>" role="button">Add Category</a>
        </div>
  </div>

  <div class="card-body">
    
    <table class="table table-hover" id="users">
        <thead class="thead-light">
            <tr>
              <th scope="col">#</th>
              <th scope="col" style="width: 50%;">Category Name</th>
              <th scope="col" style="width: 10%;">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $ctr = 1;?>
            <?php foreach($categories as $category): ?>
                <tr>
                    <th scope="row"><?= esc($ctr)?></th>
                    <td scope="row"><?= esc($category['category_name'])?></td>
                    <td>
                      <button type="button" value="<?= esc($category['id'])?>" class="btn btn-danger btn-sm del" data-toggle="tooltip" data-placement="bottom" title="Delete Category"><i class="fas fa-trash"></i></button>
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

  // DataTables
  $(function () {
    $('#users').DataTable({
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

    $('.del').click(function (e)
    {
      e.preventDefault();
      var id = $(this).val();
      console.log(id);

      Swal.fire({
        icon: 'question',
        title: 'Delete?',
        text: 'Are you sure to delete Category?',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      })/*swal2*/.then((result) =>
      {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed)
        {
          window.location = 'category/delete/' + id;
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


    
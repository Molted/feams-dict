<?= $this->extend('adminlte') ?>

<?= $this->section('page_header') ?>
<div class="row mb-2">
    <div class="col-sm-6">
            <h1><?= esc($title)?></h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
            <li class="breadcrumb-item active"><?=esc($title)?></li>
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
    <div class="d-flex justify-content-between">
      <span class="mt-1">Contributions</span>
      <a class="btn btn-primary btn-sm" href="<?= base_url('admin/contributions/add')?>" role="button">Add Contribution</a>
    </div>
  </div>
  <div class="card-body">
    <table class="table table-hover" id="contributions">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col" style="width: 40%;">Name</th>
          <th scope="col">Cost</th>
          <th scope="col">Added by</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php $ctr = 1;?>
        <?php foreach($contributions as $contri):?>
          <tr>
            <th><?= esc($ctr)?></th>
            <td><?= esc($contri['name'])?></td>
            <td><?= esc($contri['cost'])?></td>
            <td><?= esc($contri['first_name'])?> <?= esc($contri['last_name'])?></td>
            <td>
              <a class="btn btn-info btn-sm" href="<?= base_url()?>/admin/contributions/print/<?= $contri['id']?>" role="button" data-toggle="tooltip" data-placement="bottom" title="Print contribution" target="_blank"><i class="fas fa-print"></i></a>
              <button type="button" class="btn btn-danger btn-sm del" data-toggle="tooltip" data-placement="bottom" title="Delete contribution" value="<?= esc($contri['id'])?>"><i class="fas fa-trash"></i></button>
            </td>
          </tr>
          <?php $ctr++;?>
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
    $('#contributions').DataTable({
        "responsive": true,
        "autoWidth": false,
      });
  });
</script>

<!-- SweetAlert JS -->
<script src="<?= base_url();?>/public/js/sweetalert.min.js"></script>
<script src="<?= base_url();?>/public/js/sweetalert2.all.min.js"></script>

<script type="text/javascript">

  $(document).ready(function ()
  {
   
    $('.del').click(function (e)
    {
      e.preventDefault();
      var id = $(this).val();
      console.log(id);

      Swal.fire({
        icon: 'question',
        title: 'Delete?',
        text: 'Are you sure to delete this contribution?',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      })/*swal2*/.then((result) =>
      {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed)
        {
          window.location = '<?= base_url()?>/admin/contributions/delete/' + id;
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
    
<?= $this->extend('adminlte') ?>

<?= $this->section('styles') ?>

<?= $this->endSection() ?>

<?= $this->section('page_header');?>
<div class="row mb-2">
    <div class="col-sm-6">
            <h1><?= esc($title)?></h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
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

<div class="card">
  <?php foreach($perm_id['perm_id'] as $perms):?>
    <?php if($perms == '23'):?>
      <div class="card-header">
        <a class="btn btn-primary btn-sm float-right" href="<?= base_url('admin/electoral-positions/add')?>" role="button">Add Position</a>
      </div>
    <?php endif;?>
  <?php endforeach;?>
  <div class="card-body">
    <table class="table" id="positions">
      <thead class="thead-light">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Position Name</th>
          <th scope="col">Max Candidates</th>
          <?php foreach($perm_id['perm_id'] as $perms):?>
            <?php if($perms == '25'):?>
              <th scope="col" style="width: 10%;">Action</th>
            <?php endif;?>
          <?php endforeach;?>
        </tr>
      </thead>
      <tbody>
        <?php $ctr = 1?>
        <?php if(empty($elec_positions)): ?>
          <tr>
            <td colspan="3" class="text-center">No current positions</td>
          </tr>
        <?php else: ?>
          <?php foreach($elec_positions as $position): ?>
            <tr>
              <td><?=esc($ctr)?></td>
              <td><?=esc($position['position_name'])?></td>
              <td><?=esc($position['max_candidate'])?></td>
              <?php foreach($perm_id['perm_id'] as $perms):?>
                <?php if($perms == '25'):?>
                    <td>
                      <a href="<?= base_url()?>/admin/electoral-positions/edit/<?= esc($position['id'])?>" role="button" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="bottom" title="Edit position"><i class="fas fa-edit"></i></a>
                      <button type="button" value="<?= esc($position['id'])?>" class="btn btn-danger btn-sm del" data-toggle="tooltip" data-placement="bottom" title="Delete position"><i class="fas fa-trash"></i></button>
                    </td>
                <?php endif;?>
              <?php endforeach;?>
            </tr>
            <?php $ctr++?>            
          <?php endforeach;?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<?= $this->endSection();?>

<?= $this->section('scripts') ?>

<script>
// BS4 tooltips
  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })
  
  // DataTables
  $(function () {
    $('#positions').DataTable({
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
      var id = $(this).val();
      console.log(id);

      Swal.fire({
        icon: 'question',
        title: 'Delete?',
        text: 'Are you sure to delete electoral position?',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      })/*swal2*/.then((result) =>
      {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed)
        {
          window.location = '<?= base_url()?>/admin/electoral-positions/delete/' + id;
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
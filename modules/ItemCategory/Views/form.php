<?= $this->extend('adminlte') ?>

<?= $this->section('styles') ?>

<?= $this->endSection() ?>

<?= $this->section('page_header');?>
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">Add Category</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url();?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('admin/category');?>">Category</a></li>
            <li class="breadcrumb-item active"><?= 'Add'?></li>
        </ol>
    </div>
</div>
<?= $this->endSection();?>

<?= $this->section('content') ?>

<form action="<?= base_url('admin/category')?>/<?='add'?>" method="post" enctype="multipart/form-data" id="form">

<div class="card card-light">
    <div class="card-body">
        <div class="form-group"> <!-- Category Name -->
            <label for="category_name">Category Name</label>
            <input type="text" class="form-control <?=isset($errors['category_name']) ? 'is-invalid': ''?>" id="category_name" name="category_name" placeholder="Enter category name" value="<?=isset($value['category_name']) ? esc($value['category_name']): ''?>">
            <?php if(isset($errors['category_name'])):?>
                <div class="invalid-feedback">
                    <?=esc($errors['category_name'])?>
                </div>
            <?php endif;?>
        </div>
        <button type="button" class="float-end btn btn-primary btn-sm submit" >Submit</button>
</div>
</form>

<?= $this->endSection() ?>

<?= $this->section('scripts');?>

<!-- SweetAlert JS -->
<script src="<?= base_url();?>/public/js/sweetalert.min.js"></script>
<script src="<?= base_url();?>/public/js/sweetalert2.all.min.js"></script>
<!-- SweetAlert2 -->
<script type="text/javascript">

  $(document).ready(function() {
    $(window).keydown(function(event){
        if(event.keyCode == 13) {
        event.preventDefault();
        return false;
        }
    });
  });

  $(document).ready(function ()
  {
    $('.submit').click(function (e)
    {
      e.preventDefault();

      Swal.fire({
        icon: 'question',
        title: 'Add?',
        text: 'Are you sure to add category?',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, add it!'
      })/*swal2*/.then((result) =>
      {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed)
        {
          document.getElementById('form').submit();
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
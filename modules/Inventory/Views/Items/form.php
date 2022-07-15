<?= $this->extend('adminlte') ?>

<?= $this->section('styles') ?>

<?= $this->endSection() ?>

<?= $this->section('page_header');?>
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark"><?= $edit ? 'Edit': 'Add'?> <?= $title ?></h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url();?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('admin/inventory');?>"><?= esc($title)?></a></li>
            <li class="breadcrumb-item active"><?= $edit ? 'Edit': 'Add'?></li>
        </ol>
    </div>
</div>
<?= $this->endSection();?>

<?= $this->section('content') ?>

<form action="<?= base_url('admin/inventory')?>/<?= $edit ? 'edit/'.esc($id): 'add'?>" method="post" enctype="multipart/form-data" id="form">
  <div class="card card-light">
    <div class="card-body">
      <div class="form-group"> <!-- Item Name -->
        <label for="item_name">Item Name</label>
        <input type="text" class="form-control <?=isset($errors['item_name']) ? 'is-invalid': ''?>" id="item_name" name="item_name" placeholder="Enter Item name" value="<?=isset($value['item_name']) ? esc($value['item_name']): ''?>">
        <?php if(isset($errors['item_name'])):?>
            <div class="invalid-feedback">
                <?=esc($errors['item_name'])?>
            </div>
        <?php endif;?>
      </div>
      <div class="form-group"> <!-- Date Purchased -->
        <label for="date_purchased">Date Purchased</label>
        <input type="text" name="date_purchased" id="date_purchased" value="<?=isset($value['date_purchased']) ? esc($value['date_purchased']): ''?>">
        <?php if(isset($errors['date_purchased'])):?>
            <div class="invalid-feedback">
                <?=esc($errors['date_purchased'])?>
            </div>
        <?php endif;?>
      </div>
      <div class="form-group"> <!-- Category -->
        <label for="category_id">Category</label>
        <select class="form-control <?=isset($errors['category']) ? 'is-invalid': ''?>" id="category" name="category_id" data-placeholder="Select a Category" required>
            <option value="" selected>Select...</option>
            <?php foreach($categories as $category):?>
            <option value="<?= esc($category['id'])?>"><?= esc($category['category_name'])?></option>            
            <?php endforeach;?>
        </select>
        <?php if(isset($errors['category_id'])):?>
            <div class="invalid-feedback">
                <?=esc($errors['category_id'])?>
            </div>
        <?php endif;?>
      </div> 
      <div class="form-group"> <!-- Cost -->
        <label for="cost">Cost</label>
        <input type="text" class="form-control <?=isset($errors['cost']) ? 'is-invalid': ''?>" id="cost" name="cost" placeholder="Enter cost" value="<?=isset($value['cost']) ? esc($value['cost']): ''?>" onkeypress="return isNumberKey(event)">
        <?php if(isset($errors['cost'])):?>
          <div class="invalid-feedback">
              <?=esc($errors['cost'])?>
          </div>
        <?php endif;?>
      </div>
    </div>
    <div class="card-footer">
      <button type="button" class="float-end btn btn-primary btn-sm submit" >Submit</button>
    </div>
  </div>  
</form>

<?= $this->endSection() ?>

<?= $this->section('scripts');?>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<!-- SweetAlert JS -->
<script src="<?= base_url();?>/public/js/sweetalert.min.js"></script>
<script src="<?= base_url();?>/public/js/sweetalert2.all.min.js"></script>
<!-- SweetAlert2 -->
<script type="text/javascript">

  $(function() {

    $('#date_purchased').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        minYear: 1980,
        maxYear: parseInt(moment().format('YYYY'),10),
        locale: {
          format: 'YYYY-MM-DD',
        },
    });
    $('#date_purchased').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('YYYY-MM-DD'));
        document.getElementById('date_purchased').value = picker.startDate.format('YYYY-MM-DD');
    });
  });

  $(document).ready(function() {
    $(window).keydown(function(event){
        if(event.keyCode == 13) {
        event.preventDefault();
        return false;
        }
    });
  });
</script>

<script>
  function isNumberKey(evt)
  {
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode != 46 && charCode > 31 
      && (charCode < 48 || charCode > 57))
       return false;

    return true;
  }

  $(document).ready(function ()
  {
    var edit = <?php echo(json_encode($edit)); ?>;

    if(!edit){
      $('.submit').click(function (e)
      {
        e.preventDefault();

        Swal.fire({
          icon: 'question',
          title: 'Add?',
          text: 'Are you sure to add item?',
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
    } 
    else {
      $('.submit').click(function (e)
      {
        e.preventDefault();

        Swal.fire({
          icon: 'question',
          title: 'Edit?',
          text: 'Are you sure to edit item?',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, edit it!'
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
    }
  });

</script>
<?= $this->endSection() ?>










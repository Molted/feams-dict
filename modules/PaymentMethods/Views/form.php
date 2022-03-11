<?= $this->extend('adminlte') ?>

<?= $this->section('styles') ?>

<?= $this->endSection() ?>

<?= $this->section('page_header');?>
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark"><?= $edit ? 'Edit': 'Add'?> <?= esc($title)?></h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url();?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('admin/payment-methods');?>"><?= esc($title)?></a></li>
            <li class="breadcrumb-item active"><?= $edit ? 'Edit': 'Add'?></li>
        </ol>
    </div><!-- /.col -->
</div>
<?= $this->endSection();?>

<?= $this->section('content') ?>

<form action="<?= base_url('admin/payment-methods')?>/<?= $edit ? 'edit/'.esc($id): 'add'?>" method="post" enctype="multipart/form-data">

<div class="card card-light">
    <div class="card-body">
        <div class="form-group"> <!-- Name -->
            <label for="name">Name</label>
            <input type="text" class="form-control <?=isset($errors['name']) ? 'is-invalid': ''?>" id="name" name="name" placeholder="Enter name" value="<?=isset($value['name']) ? esc($value['name']): ''?>">
            <?php if(isset($errors['name'])):?>
                <div class="invalid-feedback">
                    <?=esc($errors['name'])?>
                </div>
            <?php endif;?>
        </div>
        <div class="form-group"> <!-- Description -->
            <label for="steps">Steps to Pay</label>
            <textarea class="form-control <?=isset($errors['steps']) ? 'is-invalid': ''?>" name="steps" id="steps"><?=isset($value['steps']) ? esc($value['steps']): ''?></textarea>
            <?php if(isset($errors['steps'])):?>
                <div class="invalid-feedback">
                    <?=esc($errors['steps'])?>
                </div>
            <?php endif;?>
        </div>
        <div class="form-group"> <!-- Image -->
            <label for="image">Image</label>
            <div class="custom-file"> 
                <input type="file" class="custom-file-input <?=isset($errors['image']) ? 'is-invalid': ''?>" id="image" name="image">
                <label class="custom-file-label" for="customFile"><?= $edit ? 'Replace or Upload an Image (optional)' : 'Upload an Image (optional)'?></label>
            </div>
            <?php if(isset($errors['image'])):?>
                <div class="text-danger" style="font-size: 80%; color: #dc3545; margin-top: .25rem;">
                    <?=esc($errors['image'])?>
                </div>
            <?php endif;?>
        </div>
        <?php if(isset($value['image'])): ?>
            <?php if(esc($value['image'])):?>
                <img src="<?= base_url()?>/public/uploads/paymentmethods/<?= esc($value['image'])?>" class="rounded img-thumbnail" width="25%" alt="image">
            <?php else:?>
                No Image Uploaded
            <?php endif;?>
        <?php endif;?>
    </div>
    <div class="card-footer">
        <button type="submit" class="float-end btn btn-primary btn-sm" >Submit</button>
    </div>
</div>
</form>

<?= $this->endSection() ?>

<?= $this->section('scripts');?>


<script>
    $('#steps').summernote({
        toolbar: [
            // [groupName, [list of button]]
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['para', ['ul', 'ol', 'paragraph']],
        ]
    });
</script>
<script>
  document.querySelector('.custom-file-input').addEventListener('change', function (e) {
    var name = document.getElementById("image").files[0].name;
    var nextSibling = e.target.nextElementSibling
    nextSibling.innerText = name
  })
</script>
<?= $this->endSection() ?>
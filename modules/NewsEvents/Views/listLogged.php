<?= $this->extend('adminlte') ?>

<?= $this->section('page_header') ?>
<div class="card container-fluid m-1 p-2">
  <div class="row mb-2">
      <div class="col">
          <h1><?= esc($title)?></h1>
      </div>
      <div class="col">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url()?>">Home</a></li>
            <li class="breadcrumb-item active"><?= esc($title)?></li>
          </ol>
    </div>
  </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container-fluid m-2">
  <div class="row justify-content-center">
    <!-- News Start here -->
    <div class="card col-sm-7 m-2 p-2">     
      <div class="card-body">        
        <?php if(esc($firstNews['image'])):?>
          <img src="<?= base_url()?>/public/uploads/news/<?= esc($firstNews['image'])?>" alt="<?= esc($firstNews['title'])?>" class="img-thumbnail">
        <?php endif;?>
        <h5 class="mt-3" style="font-weight: 800;"><?= (isset($firstNews['title'])) ? esc($firstNews['title']) : 'No News to Display'?></h5>
        <p><?= (isset($firstNews['content'])) ? esc($firstNews['content'], 'raw') : ''?></p>
      </div>
    </div>
    <div class="card col-sm-4 m-2 p-2">
      <div class="card-header">
        <h3>More news</h3>
      </div>
      <ul class="list-group list-group-flush">
        <?php foreach($news as $news):?>
          <a href="<?= base_url()?>/news/<?= esc($news['id'])?>" class="list-group-item list-group-item-action" style="background-color: transparent;"><?= esc($news['title'])?></a>
        <?php endforeach?>
      </ul>
    </div>

  </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

<?= $this->endSection() ?>
    
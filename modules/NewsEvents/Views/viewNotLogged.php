<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title><?= esc($news['title'])?> | FEAMS</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?= base_url()?>/public/dist/adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url()?>/public/dist/adminlte/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-dark navbar-dark">
    <div class="container">
      <a href="<?= base_url();?>" class="navbar-brand">
        <img src="<?= base_url()?>/public/img/puplogo.png" alt="PUP Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">PUPTFEA</span>
      </a>
      
      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="<?= base_url();?>" class="nav-link">Home</a>
          </li>
          <li class="nav-item <?= $active == 'announcements' ? 'active' : ''?>">
            <a href="<?= base_url('announcements');?>" class="nav-link">Announcements</a>
          </li>
          <li class="nav-item <?= $active == 'news' ? 'active' : ''?>">
            <a href="<?= base_url('news');?>" class="nav-link">News</a>
          </li>
        </ul>
      </div>

      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <li class="nav-item">
          <span style="color: #adb5bd">Already have an account?</span> <a href="<?= base_url()?>/login" class="ml-1"> Login</a>
        </li>
      </ul>
    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
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
      </div><!-- /.row -->
    </div><!-- /.row -->
    <!-- /.container-fluid -->

    <!-- /.content-header -->

    <!-- Main content -->
    <div class="container-fluid m-2">
      <div class="row justify-content-center">
        <!-- News Start here -->
        <div class="card col-sm-7 m-2 p-2">      
          <div class="card-body">
            <img src="<?= base_url()?>/public/uploads/news/<?= esc($news['image'])?>" class="rounded img-fluid" alt="News image">
            <p><?= esc($news['content'], 'raw')?></p>
          </div>
        </div>
        <div class="card col-sm-4 m-2 p-2">
          <div class="card-header">
            <h4>Other News</h4>
          </div>
          <ul class="list-group list-group-flush">
            <?php foreach($otherNews as $others):?>
              <a href="<?= base_url();?>/news/<?= $others['id']?>" class="list-group-item list-group-item-action" style="background-color: transparent;"><?= $others['title']?></a>
            <?php endforeach?>
          </ul>
        </div>
      </div>
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <!-- <div class="float-right d-none d-sm-inline">
      Anything you want
    </div> -->
    <!-- <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.5
    </div> -->
    <strong>Copyright &copy; 2021 <a href="#" data-toggle="modal" data-target="#developerModal">Data Driven Squad</a>.</strong> All rights
    reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?= base_url()?>/public/dist/adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url()?>/public/dist/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url()?>/public/dist/adminlte/js/adminlte.min.js"></script>
</body>
</html>

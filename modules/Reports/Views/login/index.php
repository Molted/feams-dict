<?= $this->extend('adminlte') ?>

<?= $this->section('styles') ?>

<?= $this->endSection() ?>

<?= $this->section('page_header');?>
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark"><?= esc($title)?></h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url();?>">Home</a></li>
            <li class="breadcrumb-item active">Reports</li>
            <li class="breadcrumb-item active">Login</li>
        </ol>
    </div><!-- /.col -->
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
  <div class="card-body">
    <form action="<?= base_url('admin/reports/login')?>" method="post">

      <div class="row mb-3">
        <div class="col-md-3">
          <select class="custom-select" id="records" name="records">
            <option value="1" selected>Daily</option>
            <option value="2">This day</option>
            <option value="3">Weekly</option>
            <option value="4">Monthly</option>
            <option value="5">Custom Range</option>
          </select>
        </div>
        <div class="col-md-2 offset-md-7 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary align-self-end">Generate PDF</button>
        </div>
      </div>
      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">

            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Login Report</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">              
              <div class="form-group ranges" id="ranges">
                <label for="formGroupExampleInput">Date range</label>
                <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                    <i class="fa fa-calendar"></i>&nbsp;  
                    <span></span> <i class="fa fa-caret-down"></i>
                </div>
                <input type="hidden" name="start" id="start">
                <input type="hidden" name="end" id="end">
              </div>
            </div>

            <div class="modal-footer">
              <button type="submit" id="saveBtn" class="btn btn-secondary" data-dismiss="modal">Save Changes</button>
            </div>
          </div>
        </div>
      </div>
    </form>
    <div id="table">
      <table class="table table-hover" id="login_report">
        <thead class="thead-light">
          <tr>
          <th scope="col" style="width: 10%">#</th>
          <th scope="col">Name</th>
          <th scope="col">Username</th>
          <th scope="col">Role Name</th>
          <th scope="col">Login Date</th>
          </tr>
        </thead>
        <tbody>
          <?php $ctr = 1?>
          <?php foreach($logins as $login):?>
          <tr>
              <td><?= esc($ctr)?></td>
              <td><?= esc($login['first_name'])?> <?= esc($login['last_name'])?></td>
              <td><?= esc($login['username'])?></td>
              <td><?= esc($login['role_name'])?></td>
              <td><?= esc($login['login_date'])?></td>
          </tr>
          <?php $ctr++?>
          <?php endforeach?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?= $this->endSection();?>

<?= $this->section('scripts') ?>

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script type="text/javascript">
  // DataTables
  $(function () {
    $('#login_report').DataTable({
        "responsive": true,
        "autoWidth": false,
      });
  });

  // Select on change
  $('#records').change(function(){
    console.log(this.value);
    
    if(this.value == '5'){
      $("#exampleModal").modal('show');

      var start = moment().subtract(29, 'days');
      var end = moment();

      function cb(start, end) {
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
      }
      $('#reportrange').daterangepicker({
          startDate: start,
          endDate: end,
      }, cb);
      cb(start, end);
      $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
          document.getElementById('start').value = picker.startDate.format('YYYY-MM-DD');
          document.getElementById('end').value = picker.endDate.format('YYYY-MM-DD');
      });

      document.getElementById('start').value = moment().subtract(29, 'days').format('YYYY-MM-DD');
      document.getElementById('end').value = moment().format('YYYY-MM-DD');
    }

    $('#saveBtn').on("click", function(){
      $.ajax({
        url: "<?php echo base_url('admin/reports/login/table/5'); ?>",
        type: "POST",
        data: { start: $('#start').val(), end: $('#end').val(), id: $('#records').val(), },
        beforeSend: function (f) {
          $('#table').html('Loading Table ...');
        },
        success: function (data) {
          $('#table').html(data);
        },
        error: function(f) {
          $('#table').html('Error sa Date range');
        }
      })
    });

    if($(this).val() != '5'){
      $.ajax({        
          url: "<?php echo base_url('admin/reports/login/table'); ?>" + "/" + $(this).val(),
          beforeSend: function (f) {
            $('#table').html('Loading Table ...');
          },
          success: function (data) {
            $('#table').html(data);
          },
          error: function(f) {
            $('#table').html('Error occured please try again');
          } 
      })
    }
  });
</script>

<?= $this->endSection() ?>

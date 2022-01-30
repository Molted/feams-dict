<h3 style="text-align: center;"><?= esc($cont['name'])?> Contribution Report</h3>
<h4 style="text-align: center;">Date Started: <?= esc($contStart)?></h4>

<br>
<div style="width: 100%">
  <table cellspacing="0" cellpadding="5" border="1" style="margin-left: auto; margin-right: auto; margin-top: 5px; width: 100%;">
    <thead>
      <tr style="text-align: center;">
        <td width="5%"> <b>#</b> </td>
        <td width="25%"> <b>Name</b> </td>
        <td width="20%"> <b>Amount Paid</b> </td>
        <td width="20%"> <b>Status</b> </td>
        <td width="30%"> <b>Date paid</b> </td>
      </tr>
    </thead>
    <tbody>
      <?php if (empty($users)): ?>
        <tr>
          <td colspan="5" style="text-align: center;"> No Available Data </td>
        </tr>
      <?php else: ?>
        <?php $ctr = 1; ?>
        <?php foreach ($users as $user): ?>
          <tr style="text-align: justify;">
            <?php if($user['status'] == '1'):?>
              <?php $amountPaid = 0;?>
              <?php $total = 0;?>
              <?php foreach($payments as $pay){
                if($pay['user_id'] == $user['id'] && $pay['is_approved'] == '1') {
                  $amountPaid += $pay['amount'];
                  $datePaid = $pay['created_at'];
                }
              }?>
              <?php $total += $amountPaid?>
              <?php if($amountPaid === 0):?>
                <td style="text-align: center; vertical-align: middle;"> <?=$ctr?> </td>
                <td style="text-align: center; vertical-align: middle;"> <?= ucwords(strtolower($user['first_name']))?> <?= ucwords(strtolower($user['last_name']))?></td>
                <td style="text-align: center; vertical-align: middle;">0.00</td>
                <td style="text-align: center; vertical-align: middle;">Not paid</td>
                <td style="text-align: center; vertical-align: middle;"></td>
              <?php elseif($amountPaid == $cont['cost']):?>
                <td style="text-align: center; vertical-align: middle;"> <?=$ctr?> </td>
                <td style="text-align: center; vertical-align: middle;"> <?= ucwords(strtolower($user['first_name']))?> <?= ucwords(strtolower($user['last_name']))?></td>
                <td style="text-align: center; vertical-align: middle;"><?= esc($amountPaid)?>.00</td>
                <td style="text-align: center; vertical-align: middle;">Fully paid</td>
                <td style="text-align: center; vertical-align: middle;"><?= esc($datePaid)?></td>
              <?php endif?>
            <?php endif?>
          <?php $ctr++; ?>
          </tr>
        <?php endforeach; ?>
        <tr>
          <td colspan="5"style="text-align: right;">Total: <?= esc($total)?>.00</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>
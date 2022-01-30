<h4 style="text-align: center; margin-bottom: 5px;"><?= esc($electionName)?> Election Results</h4>
<h5 style="text-align: center;">Vote dates: <?= date('M d,Y g:iA', strtotime($startDate))?> - <?= date('M d,Y g:iA', strtotime($endDate))?></h5>
<p></p>
<h5 style="text-align: center; margin-top: 10px;">Top 4 Full-time that is elected</h5>
<br>
<table cellspacing="0" cellpadding="5" border="1" style="margin-left: auto; margin-right: auto; margin-top: 5px;">
  <tr style="text-align: center;">
    <td width="5%"> <b>#</b> </td>
    <td width="50%"> <b>Name</b> </td>
    <td width="45%"> <b>Number of votes</b> </td>
  </tr>
  <?php $totalVote = 0; $count = 1; $ctr = 0; foreach($votes as $vote):?>
    <?php if($vote['type'] == '1' && $ctr != 4):?>
      <tr style="text-align: center;">
        <td><?= esc($count)?></td>
        <td><?= ucwords(strtolower(esc($vote['first_name'])))?> <?= ucwords(strtolower(esc($vote['last_name'])))?></td>
        <td><?= esc($vote['voteCount'])?></td>
        <?php $totalVote += $vote['voteCount']?>
      </tr>
      <?php $ctr++;?>
      <?php $count++;?>
    <?php endif;?>
  <?php endforeach?>
  <tr>
    <td colspan="3"style="text-align: right;">Total number of votes: <?= esc($totalVote)?></td>
  </tr>
</table>

<h5 style="text-align: center;">Top 4 Part-time that is elected</h5>
<br>
<table cellspacing="0" cellpadding="5" border="1" style="margin-left: auto; margin-right: auto; margin-top: 5px;">
  <tr style="text-align: center;">
    <td width="5%"> <b>#</b> </td>
    <td width="50%"> <b>Name</b> </td>
    <td width="45%"> <b>Number of votes</b> </td>
  </tr>
  <?php $totalVote = 0; $count = 1; $ctr = 0; foreach($votes as $vote):?>
    <?php if($vote['type'] == '2' && $ctr != 4):?>
      <tr style="text-align: center;">
        <td><?= esc($count)?></td>
        <td><?= ucwords(strtolower(esc($vote['first_name'])))?> <?= ucwords(strtolower(esc($vote['last_name'])))?></td>
        <td><?= esc($vote['voteCount'])?></td>
        <?php $totalVote += $vote['voteCount']?>
      </tr>
      <?php $ctr++;?>
      <?php $count++;?>
    <?php endif;?>
  <?php endforeach?>
  <tr>
    <td colspan="3"style="text-align: right;">Total number of votes: <?= esc($totalVote)?></td>
  </tr>
</table>

<h5 style="text-align: center;">Top 4 Admin that is elected</h5>
<br>
<table cellspacing="0" cellpadding="5" border="1" style="margin-left: auto; margin-right: auto; margin-top: 5px;">
  <tr style="text-align: center;">
    <td width="5%"> <b>#</b> </td>
    <td width="50%"> <b>Name</b> </td>
    <td width="45%"> <b>Number of votes</b> </td>
  </tr>
  <?php $totalVote = 0; $count = 1; $ctr = 0; foreach($votes as $vote):?>
    <?php if($vote['type'] == '3' && $ctr != 4):?>
      <tr style="text-align: center;">
        <td><?= esc($count)?></td>
        <td><?= ucwords(strtolower(esc($vote['first_name'])))?> <?= ucwords(strtolower(esc($vote['last_name'])))?></td>
        <td><?= esc($vote['voteCount'])?></td>
        <?php $totalVote += $vote['voteCount']?>
      </tr>
      <?php $ctr++;?>
      <?php $count++;?>
    <?php endif;?>
  <?php endforeach?>
  <tr>
    <td colspan="3"style="text-align: right;">Total number of votes: <?= esc($totalVote)?></td>
  </tr>
</table>

<h5 style="text-align: center;">Elected officers</h5>
<br>
<table cellspacing="0" cellpadding="5" border="1" style="margin-left: auto; margin-right: auto; margin-top: 5px;">
  <tr style="text-align: center;">
    <td width="5%"> <b>#</b> </td>
    <td width="50%"> <b>Position</b> </td>
    <td width="45%"> <b>Name</b> </td>
  </tr>
  <?php $ctr=1; foreach($officers as $officer):?>
    <tr style="text-align: center;">
      <td><?= esc($ctr)?></td>
      <td>
        <?php switch(esc($officer['position'])) {
          case 'pres':
            echo 'President';
            break;
          case 'vpint':
            echo 'VP Internal';
            break;
          case 'vpext':
            echo 'VP External';
            break;
          case 'sect':
            echo 'Secretary';
            break;
          case 'assect':
            echo 'Assistant Secretary';
            break;
          case 'treas':
            echo 'Treasurer';
            break;
          case 'astreas':
            echo 'Assistant Treasurer';
            break;
          case 'audit':
            echo 'Auditor';
            break;
          case 'busMan1':
            echo 'Business Manager';
            break;
          case 'busMan2':
            echo 'Business Manager';
            break;
          case 'pro1':
            echo 'Public Relations Officer';
            break;
          case 'pro2':
            echo 'Public Relations Officer';
            break;
        }?>
      </td>
      <td><?= ucwords(strtolower(esc($officer['first_name'])))?> <?= ucwords(strtolower(esc($officer['last_name'])))?></td>
      <?php $ctr++;?>
    </tr>
  <?php endforeach;?>
</table>



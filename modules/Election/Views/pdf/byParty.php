<h4 style="text-align: center; margin-bottom: 5px;"><?= esc($electionName)?> Election Results</h4>
<h5 style="text-align: center;">Vote dates: <?= date('M d,Y g:iA', strtotime($startDate))?> - <?= date('M d,Y g:iA', strtotime($endDate))?></h5>
<p></p>

<table>
  <tr>
    <td style="text-align: left; margin-top: 10px;">Number of candidates: <?= esc($candidateCount)?></td>
    <td style="text-align: right; margin-top: 10px;">Number of positions: <?= esc($positionCount)?></td>
  </tr>
</table>
<!-- <span style="text-align: right; margin-top: 10px;">Number of positions: <?= esc($positionCount)?></span>
<span style="text-align: left; margin-top: 10px;">Number of candidates: <?= esc($candidateCount)?></span> -->
<h5 style="text-align: center; margin-top: 10px;">Candidates who run and their number of votes</h5>
<br>
<table cellspacing="0" cellpadding="5" border="1" style="margin-left: auto; margin-right: auto; margin-top: 5px;">
  <tr style="text-align: center;">
    <td width="5%"> <b>#</b> </td>
    <td width="50%"> <b>Name</b> </td>
    <td width="45%"> <b>Number of votes</b> </td>
  </tr>
  <?php foreach($positions as $position):?>
    <tr>
      <td colspan="3"><?= $position['name']?></td>
    </tr>
    <?php $ctr = 1;?>
    <?php foreach($candidates as $candidate):?>
      <?php if($candidate['position_id'] == $position['id']):?>
        <tr style="text-align: center;">
          <td><?= esc($ctr)?></td>
          <td><?= ucwords(strtolower(esc($candidate['first_name'])))?> <?= ucwords(strtolower(esc($candidate['last_name'])))?></td>
          <td>
            <?php $votectr = 0;?>
            <?php foreach($votes as $vote) {
              if($vote['candidate_id'] == $candidate['id'] && $vote['position_id'] == $position['id']) {
                $votectr ++;
              }
            }?>
            <?= esc($votectr)?>
          </td>
        </tr>
        <?php $ctr++;?>
      <?php endif;?>
    <?php endforeach;?>
    <tr style="text-align: center;">
      <td colspan="2">Abstain</td>
      <td>
        <?php $absvotes = 0;?>
        <?php foreach($votes as $vote){
          if($vote['candidate_id'] == '0' && $vote['position_id'] == $position['id']){
            $absvotes++;
          }
        }?>
        <?= esc($absvotes)?>
      </td>
    </tr>
  <?php endforeach;?>
</table>
	
<h3 style="text-align: center;">File Sharing Reports</h3>
<h4 style="text-align: center;">Number of downloads per file</h4>

<br>
<div style="width: 100%">
  <table cellspacing="0" cellpadding="5" border="1" style="margin-left: auto; margin-right: auto; margin-top: 5px; width: 100%;">
    <tr style="text-align: center;">
      <td width="5%"> <b>#</b> </td>
      <td width="40%"> <b>File Name</b> </td>
      <td width="35%"> <b>Category</b> </td>
      <td width="20%"> <b>Number of Downloads</b> </td>
    </tr>
    <?php if (empty($files['files'])): ?>
      <tr>
        <td colspan="5" style="text-align: center;"> No Available Data </td>
      </tr>
    <?php else: ?>
      <?php $ctr = 1; ?>
      <?php foreach ($files['files'] as $file): ?>
        <tr style="text-align: justify;">
          <td style="text-align: center; vertical-align: middle;"> <?=$ctr?> </td>
          <td style="text-align: center; vertical-align: middle;"> <?=$file['file_name']?> </td>
          <td style="text-align: center; vertical-align: middle;"> <?=$file['category']?> </td>
          <td style="text-align: center; vertical-align: middle;"> <?=$file['downloads']?> </td>
        </tr>
        <?php $ctr++; ?>
      <?php endforeach; ?>
      <tr>
          <td colspan="4">Number of files: <?= esc($files['totalFiles'][0]['totalCount'])?></td>
      </tr>
      <tr>
          <td colspan="4">Number of downloads: <?= esc($files['totalDownloads'][0]['downloads'])?></td>
      </tr>
    <?php endif; ?>
  </table>
</div>
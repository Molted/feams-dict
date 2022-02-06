<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    </head>
    <body>
        <p>Hello <?= esc($first_name)?> <?= esc($last_name)?>,</p>
        <p>Request for resetting your password:</p>
        <br>
        <label>Please click the link </label><a href="<?= base_url().'/reset-password/token/'.$token;?>">here</a> to continue.
        <br>
        <small>The link is only valid for 30 mins.</small>
    </body>
</html>
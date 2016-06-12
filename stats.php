<!DOCTYPE html>
<?php
require_once './config.php';
?>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title>Simple Redirector Stats</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous" />
    </head>
    <body>
        <div class="container">
            <?php
            if (!isset($_POST['pw']) || $_POST['pw'] != $statsPw) {
                ?>
                <div class="row" style="margin-top: 30px;">
                    <div class="col-md-5">
                        <form method="POST">
                            <label>Password</label>
                            <input type="password" name="pw" class="form-control" />
                        </form>
                    </div>
                </div>
                <?php
            } else {
                ?>
                <div class="row">
                    <div class="col-md-6">
                        <h1>Simple Redirector</h1>
                        <h2>Statistics</h2>
                        <table class="table">
                            <thead style="font-weight: bold;">
                                <tr>
                                    <td>Link</td>
                                    <td>Clicks</td>
                                    <td>Last Clicked</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $stats = json_decode(file_get_contents('log.json'));
                                foreach ($stats as $key => $data) {
                                    ?>
                                    <tr>
                                        <td><?php echo $key; ?></td>
                                        <td><?php echo $data->clicks; ?></td>
                                        <td><?php echo date('d.m.Y H:i', $data->lastClicked); ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <hr />
                <a href="https://github.com/MrKrisKrisu/Simple-Redirector">Simple Redirector on Github</a>
                <?php
            }
            ?>
        </div>
    </body>
</html>

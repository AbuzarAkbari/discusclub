<?php
$levels = [];
require_once("../../includes/tools/security.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge"><link rel="shortcut icon" href="/favicon.ico" />
    <title>Discusclub Holland</title>

    <!-- custom css -->
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/nieuws.css">
    <!-- font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <!-- bootstrap style -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>

<body>
    <div id="fb-root"></div>
    <script>
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/nl_NL/sdk.js#xfbml=1&version=v2.10";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
    <?php
        require_once("../../includes/components/nav.php");
    ?>
<br><br>
    <div class="container main">
        <div class="row columns">
            <div class="col-md-12">
                <div class="">
                <ol class="breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li><a href="/admin">Admin</a></li>
                    <li class="active">Inschrijvingen</li>
                </ol>
            </div>
                <div class="panel panel-primary ">
                    <div class="panel-heading border-colors">Inschrijvingen Leden</div>
                    <div class="panel-body padding-padding table-responsive">
                        <table>
                            <tr>
                                <th>Naam</th>
                                <th>IP Adres</th>
                                <th>Rekeningnummer</th>
                                <th>Telefoonnummer</th>
                                <th>Postcode</th>
                                <th>Adres</th>
                                <th>Stad</th>
                                <th>Tools</th>
                                <th>Status</th>
                            </tr>
                            <?php
                                // $sql = "SELECT *, ip.id, user.id as user_id, user.created_at as user_created_at FROM user LEFT JOIN ip ON ip.user_id = user.id";
                                $sql = "SELECT * FROM approval_signup as app LEFT JOIN user as u JOIN ip ON u.id = ip.user_id ON u.id = app.user_id";
                                $result = $dbc->prepare($sql);
                                $result->execute();
                                $rows = $result->fetchAll(PDO::FETCH_ASSOC);
                            ?>
                            <?php
                            foreach ($rows as $ip) :
                                ?>
                                <tr>
                                    <td><a href="/user/<?php echo $ip["user_id"]; ?>"><?php
                                     echo $ip['first_name'] . " " . $ip['last_name'];
                                    ?></a></td>
                                    <td><?php
                                     echo $ip['ip_address'];
                                    ?></td>
                                    <td><?php
                                     echo isset($ip['user_created_at']) ? $ip['user_created_at'] : $ip['created_at'];
                                    ?></td>
                                    <td><?php
                                     echo $ip['phone'];
                                    ?></td>
                                    <td><?php
                                     echo $ip['postal_code'];
                                    ?></td>
                                    <td><?php
                                     echo $ip['address'],$ip['house_number'];
                                    ?></td>
                                    <!-- <td><?php
                                    // echo $ip['birthdate'];
                                    ?></td> -->
                                    <td><?php
                                     echo $ip['city'];
                                    ?></td>
                                    <td>
                                        <a title="Blokeer" href="/includes/tools/approval/accept-signup?id=<?php echo $ip["id"]; ?>&new=1" class="btn btn-danger" name="button">
                                             <i class="glyphicon glyphicon-remove"></i></a>
                                        <a title="Deblokeer" href="/includes/tools/approval/accept-signup?id=<?php echo $ip["id"]; ?>&new=2" class="btn btn-success" name="button">
                                         <i class="glyphicon glyphicon-ok"></i></a>
                                    </td>
                                    <td>  <?php

                                    $sql = "SELECT * FROM approval_signup";
                                    $result = $dbc->prepare($sql);
                                    $result->execute();
                                    $status = $result->fetchAll(PDO::FETCH_ASSOC);

                                    switch ($status['approved']) {
                                        case 0:
                                        echo "<div class='status-block text-center'><span class='open-eye glyphicon glyphicon-eye-open'></span></div>";
                                        break;
                                        case 1:
                                        echo "<div class='status-block text-center'><span class='ok glyphicon glyphicon-ok'></span></div>";
                                        break;
                                        case 2:
                                        echo "<div class='status-block text-center'><span class='remove glyphicon glyphicon-remove '></span></div>";
                                        break;
                                    }?>
                                   </td>
                                </tr>
                            <?php
                            endforeach;
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer>
<?php require_once("../../includes/components/footer.php") ; ?>
    </footer>
    <!-- bootstrap script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>

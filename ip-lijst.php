<?php require_once("includes/security.php");
require_once('dbc.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Discusclub Holland</title>

    <!-- custom css -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/nieuws.css">
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
        require_once("includes/nav.php");
    ?>
<br><br>
    <div class="container main">
        <div class="row columns">
            <div class="col-md-12">
                <div class="panel panel-primary ">
                    <div class="panel-heading border-colors">Ip lijst</div>
                    <div class="panel-body padding-padding">
                        <table>
                            <tr>
                                <th>gebruiker</th>
                                <th>Ip adres</th>
                                <th>wanneer je account heb gemaakt</th>
                                <th>topics</th>
                                <th>Admin tools</th>
                            </tr>
                            <?php
                                $sql = "SELECT * FROM ips INNER JOIN user ON ips.user_id = user.id";
                                $result = $dbc->prepare($sql);
                                $result->execute();
                                $rows = $result->fetchAll(PDO::FETCH_ASSOC);

                            ?>
                            <?php
                            foreach ($rows as $ip) :
                                ?>
                                <tr>
                                    <td><a href=""><?php
                                     echo $ip['first_name'] . " " . $ip['last_name'];
                                    ?></a></td>
                                    <td><?php
                                     echo $ip['ip_adres'];
                                    ?></td>
                                    <td><?php
                                     echo $ip['created_at'];
                                    ?></td>
                                    <td><?php
                                     echo $ip['topic_id'];
                                    ?></td>
                                    <td>
                                     <a title="Blokeer" href="" type="button" class="btn btn-primary  " name="button"><i class="glyphicon glyphicon-remove-sign"></i></a>
                                     <a title="Deblokeer" href="" type="button" class="btn btn-primary  " name="button"><i class="glyphicon glyphicon-ok-sign"></i></a></td>
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
<?php require 'footer.php' ; ?>
    </footer>
    <!-- bootstrap script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>

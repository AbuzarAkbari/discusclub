<?php
$levels = [];
require_once("../../includes/tools/security.php");

$page = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
if (false === intval($page)) {
    exit;
}
$perPage = 20;
?>
<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="/css/gebruiker.css">
<link rel="stylesheet" href="/css/nieuws.css">
<head>
    <title>Discusclub Holland</title>
    <?php require_once("../../includes/components/head.php"); ?>
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
                                $a = $page * $perPage - $perPage;
                                $sql = "SELECT * FROM approval_signup as app LEFT JOIN user as u LEFT JOIN ip ON u.id = ip.user_id ON u.id = app.user_id LIMIT {$perPage} OFFSET {$a}";
                                $result = $dbc->prepare($sql);
                                $result->execute();
                                $rows = $result->fetchAll(PDO::FETCH_ASSOC);
                            ?>
                            <?php if(!empty($rows)) : ?>
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
                                        <a title="Weiger" href="/includes/tools/approval/accept-signup?id=<?php echo $ip["id"]; ?>&new=2" class="btn btn-danger" name="button">
                                             <i class="glyphicon glyphicon-remove"></i></a>
                                        <a title="Accepteer" href="/includes/tools/approval/accept-signup?id=<?php echo $ip["id"]; ?>&new=3" class="btn btn-success" name="button">
                                         <i class="glyphicon glyphicon-ok"></i></a>
                                    </td>
                                    <td>  <?php

                                    switch ($ip['approved']) {
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
                        <?php else : ?>
                            <tr>
                                <td>Geen leden</td>
                            </tr>
                        <?php endif; ?>
                        </table>
                    </div>
                    <?php
                    $path = "/admin/approval-signup/:page";
                    $sql = "SELECT COUNT(*) AS x FROM approval_signup";
                    require_once("../../includes/components/pagination.php");
                    ?>
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

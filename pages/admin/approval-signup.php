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

<body><!-- Global site tag (gtag.js) - Google Analytics --><script async src="https://www.googletagmanager.com/gtag/js?id=UA-110090721-1"></script><script>window.dataLayer = window.dataLayer || [];function gtag(){dataLayer.push(arguments);}gtag('js', new Date());gtag('config', 'UA-110090721-1');</script>
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
                                <th>Status</th>
                                <th>Naam</th>
                                <th>Rekeningnummer</th>
                                <th>Telefoonnummer</th>
                                <th>Postcode</th>
                                <th>Adres</th>
                                <th>Stad</th>
                                <th>Tools</th>
                            </tr>
                            <?php
                                $a = $page * $perPage - $perPage;
                                $sql = "SELECT *, u.id FROM approval_signup as app JOIN user as u ON u.id = app.user_id ORDER BY app.approved LIMIT {$perPage} OFFSET {$a}";
                                $result = $dbc->prepare($sql);
                                $result->execute();
                                $rows = $result->fetchAll(PDO::FETCH_ASSOC);
                            ?>
                            <?php if(!empty($rows)) : ?>
                            <?php
                            foreach ($rows as $appr) :
                                ?>
                                <tr>
                                    <td>  <?php

                                        switch ($appr['approved']) {
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
                                    <td><a href="/user/<?php echo $appr["user_id"]; ?>"><?php
                                     echo $appr['first_name'] . " " . $appr['last_name'];
                                    ?></a></td>
                                    <td><?php
                                     echo $appr['iban'];
                                    ?></td>
                                    <td><?php
                                     echo $appr['phone'];
                                    ?></td>
                                    <td><?php
                                     echo $appr['postal_code'];
                                    ?></td>
                                    <td><?php
                                     echo $appr['address'],$appr['house_number'];
                                    ?></td>
                                    <!-- <td><?php
                                    // echo $appr['birthdate'];
                                    ?></td> -->
                                    <td><?php
                                     echo $appr['city'];
                                    ?></td>
                                    <td>
                                        <a title="Weiger" href="/includes/tools/approval/accept-signup?id=<?php echo $appr["id"]; ?>&new=2" class="btn btn-danger" name="button">
                                             <i class="glyphicon glyphicon-remove"></i></a>
                                        <a title="Accepteer" href="/includes/tools/approval/accept-signup?id=<?php echo $appr["id"]; ?>&new=3" class="btn btn-success" name="button">
                                         <i class="glyphicon glyphicon-ok"></i></a>
                                    </td>
                                </tr>
                            <?php
                            endforeach;
                            ?>
                        <?php else : ?>
                            <tr>
                                <td>Geen leden gevonden</td>
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

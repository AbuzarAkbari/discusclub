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
                                $a = $page * $perPage - $perPage;
                                $sql = "SELECT * FROM approval_signup as app LEFT JOIN user as u JOIN ip ON u.id = ip.user_id ON u.id = app.user_id LIMIT {$perPage} OFFSET {$a}";
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
                        </table>
                    </div>
                    <!-- Pagination system -->
                    <div class="col-xs-12">

                        <?php
                            $query = $dbc->prepare('SELECT COUNT(*) AS x FROM approval_signup');
                            $query->execute();
                            $results = $query->fetch();
                            $count = ceil($results['x'] / $perPage);
                            if(($results['x'] % $perPage) > 0) {
                                $count++;
                            }
                        ?>
                        <?php if ($results['x'] > $perPage) : ?>
                            <nav aria-label="Page navigation">
                                <ul class="pagination">
                                    <li>
                                        <a href="/admin/approval-signup/1" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/admin/approval-signup/<?php echo $page-1 <= 0 ? $page : $page-1; ?>" aria-label="Next">
                                            <span aria-hidden="true"><</span>
                                        </a>
                                    </li>
                                    <?php
                                    $diff = $count - $page;
                                    $x = $diff < 5 ? ($page - (4-$diff)) : $page;
                                    $y = (($page < $count-5) ? ($page + 5) : ($count+1));
                                    echo $diff;
                                    for ($x = $x; $x < $y; $x++) : ?>
                                        <li<?php echo ($x == $page) ? ' class="active"' : ''; ?>>
                                            <a href="/admin/approval-signup/<?php echo $x; ?>"><?php echo $x; ?></a>
                                        </li>
                                    <?php                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         endfor; ?>
                                    <li>
                                        <a href="/admin/approval-signup/<?php echo $page+1 > $count ? $page : $page+1; ?>" aria-label="Next">
                                            <span aria-hidden="true">></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/admin/approval-signup/<?php echo $count ?>" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        <?php endif; ?>
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

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
<br>
    <div class="container main">
        <div class="row columns">
            <div class="col-md-12">
                <div class="">
                <ol class="breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li><a href="/admin">Admin</a></li>
                    <li class="active">Ledenlijst</li>
                </ol>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading border-colors">
                    <h3 class="panel-title">Zoek op leden</h3>
                </div>
                <div class="panel-body">
                    <form method="get" action="/admin/user_search">
                        <input type="text" class="form-control" name="q" placeholder='Zoek op leden..' required ><br>
                        <button type="submit" class="form-control btn btn-primary">Zoek op leden</button>
                    </form>
                </div>
            </div>
                <div class="panel panel-primary ">
                    <div class="panel-heading border-colors">Ledenlijst</div>
                    <div class="panel-body padding-padding table-responsive">
                        <table>
                            <tr>
                                <th>id</th>
                                <th>Naam</th>
                                <th>IP Adres</th>
                                <th>Registratiedatum</th>
                                <th>Telefoonnummer</th>
                                <th>Postcode</th>
                                <th>Adres</th>
                                <th>Stad</th>
                                <th>tools</th>
                            </tr>
                            <?php
                                $a = $page * $perPage - $perPage;
                                $sql = "SELECT *, ip.id, user.id as user_id, user.created_at as user_created_at FROM user LEFT JOIN ip ON ip.user_id = user.id LIMIT {$perPage} OFFSET {$a}";
                                $result = $dbc->prepare($sql);
                                $result->execute();
                                $rows = $result->fetchAll(PDO::FETCH_ASSOC);
                            ?>
                            <?php if(!empty($rows)) :
                            foreach ($rows as $ip) :
                                ?>
                                <tr>
                                    <td><a href="/user/<?php echo $ip["user_id"]; ?>">
                                        <?php echo $ip["user_id"]; ?>
                                    </a></td>
                                    <td><a href="/user/<?php echo $ip["user_id"]; ?>">
                                        <?php $name = $ip['first_name'] . " " . $ip['last_name']; ?>
                                        <?php echo isset($ip['first_name']) ? $name : 'Gast'; ?>
                                    </a></td>
                                    <td><?php
                                     echo isset($ip['ip_address']) ? $ip['ip_address'] : 'Geen ip-adres bekend';
                                    ?></td>
                                    <td><?php
                                     echo isset($ip['user_created_at']) ? $ip['user_created_at'] : $ip['created_at'];
                                    ?></td>
                                    <td><?php
                                     echo isset($ip['phone']) ? $ip['phone'] : 'Geen telefoonnummer bekend';
                                    ?></td>
                                    <td><?php
                                     echo isset($ip['postal_code']) ? $ip['postal_code'] : 'Geen postcode bekend';
                                    ?></td>
                                    <td><?php
                                     echo isset($ip['address']) && isset($ip['house_number']) ? $ip['address'].''.$ip['house_number'] : 'Geen adres bekend';
                                    ?></td>
                                    <td><?php
                                     echo isset($ip['city']) ? $ip['city'] : 'Geen stad bekend';
                                    ?></td>
                                    <td>
                                        <?php if($ip["deleted_at"]): ?>
                                            <a href="/includes/tools/admin/delete_user?id=<?php echo $ip["user_id"]; ?>" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                                        <?php else : ?>
                                            <a href="/includes/tools/admin/add_user?id=<?php echo $ip["user_id"]; ?>" class="btn btn-success"><i class="glyphicon glyphicon-ok"></i></a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php
                            endforeach;
                            ?>
                            <?php else : ?>
                            <tr><td>Geen leden gevonden</td></tr>
                            <?php endif; ?>
                        </table>
                    </div>
                    <?php
                    $path = "/admin/user-list/:page";
                    $sql = "SELECT COUNT(*) AS x FROM user WHERE deleted_at IS NULL";
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

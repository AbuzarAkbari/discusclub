<?php
$levels= [];
require_once("../../includes/tools/security.php");
if(isset($_GET["id"]) && isset($_GET["new"])) {
    $sth = $dbc->prepare("UPDATE sponsor SET approved = :new WHERE id = :id");
    $sth->execute([":id" => $_GET["id"], ":new" => $_GET["new"]]);
}

$page = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
if (false === intval($page)) {
    exit;
}
$perPage = 10;
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
                    <li class="active">Sponsoren</li>
                </ol>
            </div>
                <div class="panel panel-primary ">
                    <div class="panel-heading border-colors">Inschrijvingen Sponsoren</div>
                    <div class="panel-body padding-padding table-responsive">
                        <table>
                            <tr>
                                <th>Naam</th>
                                <th>Url</th>
                                <th>Inschrijfdatum</th>
                                <th>Banner</th>
                                <th>Tools</th>
                                <th>Status</th>
                            </tr>
                            <?php
                                $a = $page * $perPage - $perPage;
                                $sql = "SELECT *, sponsor.id FROM sponsor JOIN image ON sponsor.image_id = image.id ORDER BY approved LIMIT {$perPage} OFFSET {$a}";
                                $result = $dbc->prepare($sql);
                                $result->execute();
                                $rows = $result->fetchAll(PDO::FETCH_ASSOC);
                            ?>
                            <?php
                            foreach ($rows as $sponsor) :
                                ?>
                                <tr>
                                    <td>
                                    <?php
                                     echo $sponsor['name'];
                                    ?></a></td>
                                    <td>
                                    <a target="_blank" href="<?php echo $sponsor['url'];?>"><?php echo $sponsor['url'];?></a>
                                    </td>
                                    <td>
                                    <?php
                                     echo $sponsor['created_at'];
                                    ?>
                                    </td>
                                    <td>
                                        <img alt='Banner' class="sponsor_vak" src="/images<?php echo $sponsor['path'];?>" alt="">
                                    </td>
                                    <td>
                                        <a title="Blokeer" href="<?php echo  "/admin/approval-sponsor?id=" . $sponsor["id"]; ?>&new=2" class="btn btn-danger" name="button">
                                             <i class="glyphicon glyphicon-remove"></i></a>
                                        <a title="Deblokeer" href="<?php echo "/admin/approval-sponsor?id=" . $sponsor["id"]; ?>&new=1" class="btn btn-success" name="button">
                                         <i class="glyphicon glyphicon-ok"></i></a>
                                    </td>
                                 <td>  <?php
                                 switch ($sponsor['approved']) {
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
                    <?php
                    $path = "/admin/approval-sponsor/:page";
                    $sql = "SELECT COUNT(*) AS x FROM sponsor";
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

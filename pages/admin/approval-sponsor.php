<?php require_once("../../includes/tools/security.php"); ?>
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
                                <th>Inschrijf datum</th>
                                <th>Banner</th>
                                <th>Admin tools</th>
                            </tr>
                            <?php
                                $sql = "SELECT * FROM sponsor LEFT JOIN image ON sponsor.image_id = image.id";
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
                                    <?php
                                     echo $sponsor['url'];
                                    ?>
                                    </td>
                                    <td>
                                    <?php
                                     echo $sponsor['created_at'];
                                    ?>
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                     <a title="Blokeer" href="" type="button" class="btn btn-danger" name="button"><i class="glyphicon glyphicon-remove"></i></a>
                                     <a title="Deblokeer" href="" type="button" class="btn btn-success" name="button"><i class="glyphicon glyphicon-ok"></i></a></td>
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

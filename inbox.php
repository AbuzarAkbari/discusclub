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
                    <div class="panel-heading border-colors">Inbox</div>
                    <div class="panel-body padding-padding">
                        <table>
                            <tr>
                                <th>titel</th>
                                <th>afzender</th>
                                <th>laatste bericht</th>
                            </tr>
                            <?php
                                $result = $dbc->prepare("SELECT m.id, m.title, m.created_at, u1.first_name as u1_first_name, u2.first_name as u2_first_name, u1.last_name as u1_last_name, u2.last_name as u2_last_name, u1.id as u1_id, u2.id as u2_id FROM message as m JOIN user as u1 ON u1.id = m.user_1_id JOIN user as u2 ON u2.id = m.user_2_id WHERE m.user_1_id = :id OR m.user_2_id = :id");
                                $result->execute([":id" => $_SESSION["user"]->id]);
                                $rows = $result->fetchAll(PDO::FETCH_OBJ);
                            ?>
                            <?php
                            foreach ($rows as $message) :
                                ?>
                                <tr>
                                    <td><a href=""><?php
                                     echo $message->title;
                                    ?></a></td>
                                    <td><a href="/gebruiker.php?id=<?php echo $_SESSION["user"]->id === $message->u1_id ? $message->u2_id : $message->u1_id; ?>"><?php
                                     echo $_SESSION["user"]->id === $message->u1_id ? $message->u2_first_name . " " . $message->u2_last_name : $message->u1_first_name . " " . $message->u1_last_name;
                                    ?></a></td>
                                    <td>
                                    <?php echo $message->created_at; ?>
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
<?php require 'footer.php' ; ?>
    </footer>
    <!-- bootstrap script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>

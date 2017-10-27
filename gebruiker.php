<?php $levels = ["gebruiker", "lid"];
require_once("includes/security.php"); ?>
<?php
if (isset($_GET["id"])) {
    $sth = $dbc->prepare("SELECT u.id, u.first_name, u.last_name, u.username, u.password, r.name as role_name, u.created_at, u.last_changed, u.signature, u.birthdate, u.location, i.path as profile_img FROM user as u JOIN role as r ON r.id = u.role_id JOIN image as i ON u.profile_img = i.id WHERE u.id = :id");
    $sth->execute([":id" => $_GET["id"]]);

    $user_data = $sth->fetch(PDO::FETCH_OBJ);
} else {
    $user_data = $_SESSION["user"];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Discusclub Holland</title>

    <!-- custom css -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/gebruiker.css">
    <!-- font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <!-- bootstrap style -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>

<body>
    <div id="fb-root"></div>
    <script>
    ;(function(d, s, id) {
  var js,
    fjs = d.getElementsByTagName(s)[0]
  if (d.getElementById(id)) return
  js = d.createElement(s)
  js.id = id
  js.src = '//connect.facebook.net/nl_NL/sdk.js#xfbml=1&version=v2.10'
  fjs.parentNode.insertBefore(js, fjs)
})(document, 'script', 'facebook-jssdk')
</script>
    <?php require_once("includes/nav.php"); ?>
      <div class="container main">
          <br><br>
        <div class="col-md-12">
            <div class="panel panel-primary border-color-blues">
                <div class="panel-heading border-color-blue">Gebruiker</div>
                <div class="panel-body text-right">
                    <a><input type="submit" class="btn btn-primary" name="send" value="Fotoalbums"></a>
                    <a href="profiel-aanpassen.php"><input type="submit" class="btn btn-primary" name="send" value="Wijzig profiel"></a>
                    </div>
                </div>
            </div>
        <div class="col-md-4">
            <div class="panel panel-primary border-color-blues">
                <div class="panel-heading border-color-blue">Informatie</div>
                <div class="panel-body text-left">
                    <div class="text-center"><div  style="background-image:url('images/profiel/<?php echo isset($user_data->profile_img) ? $user_data->profile_img : ""; ?>')"; class="img "></div></div>
                    <div class="col-md-12">
                        <strong>Locatie</strong><br>
                        <?php echo isset($user_data->location) ? $user_data->location : "Onbekend"; ?><br>
                        <strong>Leeftijd</strong><br>
                        <?php $leeftijd = date_diff(date_create(date('Y-m-d')), date_create($user_data->birthdate))->format('%y');  ?>
                        <?php echo isset($user_data->birthdate) ? $leeftijd : "Onbekend"; ?><br>
                        <strong>rol</strong> <br>
                        <?php echo isset($user_data->role_name) ? $user_data->role_name : "Onbekend"; ?><br>
                        <strong>Geregistreerd</strong><br>
                        <?php echo isset($user_data->created_at) ? $user_data->created_at : "Onbekend"; ?><br>
                        <strong>Forum handtekening</strong><br>
                        <?php echo isset($user_data->signature) ? $user_data->signature : ""; ?><br>
                </div>
                    </div>
                </div>
            </div>
        <div class="col-md-8">
            <div class="panel panel-primary border-color-blues">
                <div class="panel-heading border-color-blue">Laatste reacties op topics</div>
                <div class="panel-body text-right paddingNone">

                <table>
                    <tr class="border-color-black">
                    <th class="col-md-4 col-xs-4">Topic</th>
                    <th class="col-md-4 col-xs-4">Forum</th>
                    <th class="col-md-4 col-xs-4">Datum</th>
                    <tr>

                    <tr>
                        <td class="col-md-4 col-xs-4">bla</td>
                        <td class="col-md-4 col-xs-4">bla</td>
                        <td class="col-md-4 col-xs-4">bla</td>
                    </tr>
                    </table>
                </div>
                </div>
            </div>
        <div class="col-md-8">
            <div class="panel panel-primary border-color-blues">
                <div class="panel-heading border-color-blue">Albums</div>
                <div class="panel-body text-right">
                    Geen albums gevonden
                    </div>
                </div>
            </div>
            <div class="col-md-12"></div>
        <div class="col-md-4">
            <div class="panel panel-primary border-color-blues">
                <div class="panel-heading border-color-blue">Statistieken</div>
                <div class="panel-body text-left">

                    <?php
                        //Get number of topic from logged_in user
                        $topicSql = "SELECT COUNT(id) AS t FROM topic WHERE user_id = ?";
                        $topicResult = $dbc->prepare($topicSql);
                        $topicResult->bindParam(1, $user_data->id);
                        $topicResult->execute();
                        $x_topic = $topicResult->fetch(PDO::FETCH_OBJ);

                        //Get number of reply from logged_in user
                        $replySql = "SELECT COUNT(id) AS r FROM reply WHERE user_id = ?";
                        $replyResult = $dbc->prepare($replySql);
                        $replyResult->bindParam(1, $user_data->id);
                        $replyResult->execute();
                        $x_reply = $replyResult->fetch(PDO::FETCH_OBJ);

                        if($x_topic->t > 1)
                        {
                            $x_topic->t = $x_topic->t.' topics';
                        }
                        else
                        {
                            $x_topic->t = $x_topic->t.' topic';
                        }

                        if($x_reply->r > 1)
                        {
                            $x_reply->r = $x_reply->r.' berichten';
                        }
                        else
                        {
                            $x_reply->r = $x_reply->r.' bericht';
                        }
                    ?>
                    <strong>Aantal forum topics
                    </strong><br>
                    <?php if($x_topic->t == 0) { echo 'Geen topics'; } else { echo $x_topic->t; } ?><br>
                    <strong>Aantal forum berichten</strong><br>
                    <?php if($x_reply->r == 0) { echo 'Geen berichten'; } else { echo $x_reply->r; } ?><br>
                    </div>
                </div>
            </div>
        <div class="col-md-8">

            </div>
        </div>

    <div class="conainter-fluid"></div>
    <footer>
<?php require 'footer.php' ; ?>
    </footer>
    <!-- bootstrap script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
<!-- https://twitter.com/DiscusHolland -->

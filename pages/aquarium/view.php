<?php
$levels = ["lid", "gebruiker"];
require_once("../../includes/tools/security.php");

//Pagination variables
$page = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
if (false === intval($page)) {
    exit;
}
$perPage = 10;
?>
<!DOCTYPE html>
<html lang="en">

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
    <?php require_once("../../includes/components/nav.php"); ?>

    <br><br>
    <?php
      $id = $_GET['id'];
      $haal_aquariums = "SELECT * , a.created_at AS aquarium_created_at FROM image as i JOIN aquarium as a ON a.id = i.aquarium_id JOIN user as u ON u.id = a.user_id WHERE aquarium_id = ?";

      $aquariumResult = $dbc->prepare($haal_aquariums);
      $aquariumResult->bindParam(1, $id);
      $aquariumResult->execute();
      $aquarium = $aquariumResult->fetchAll(PDO::FETCH_ASSOC);
      $user_id = $_SESSION['user']->id;
      ?>
    <div class="container main">
        <?php if(!$aquarium) :?>
        <div class="message error">Deze pagina bestaat niet, <a href="/aquarium/"> ga terug</a></div>
        <?php else : ?>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="">
                    <ol class="breadcrumb">
                        <li><a href="/">Home</a></li>
                        <li><a href="/aquarium/">Aquarium</a></li>
                        <li class="active"><?php echo $aquarium[0]['title']; ?></li>
                    </ol>
                </div>
                <div class="panel panel-primary">
                    <div class="panel-heading heading-padding">
                        <?php



                            $haal_aquariums = "SELECT *, a.created_at AS aquarium_created_at, count(i.aquarium_id) as aantal_fotos, u.id as user_id, a.created_at as created_at FROM image as i JOIN aquarium as a ON a.id = i.aquarium_id JOIN user as u ON u.id = a.user_id WHERE a.deleted_at IS NULL GROUP BY i.aquarium_id ORDER BY aquarium_created_at DESC";
                            $aquariumResult = $dbc->prepare($haal_aquariums);
                            $aquariumResult->execute();
                            $aquariumpje = $aquariumResult->fetch(PDO::FETCH_ASSOC);

                            $sql = "SELECT COUNT(*) AS x FROM `like` WHERE aquarium_id = :aid";
                            $result = $dbc->prepare($sql);
                            $result->execute([":aid" => $aquariumpje['aquarium_id']]);
                            $like = $result->fetch();

                            $contestSql = "SELECT count(*) as amount FROM contest WHERE start_at <= :aca AND end_at >= :aca AND start_at <= NOW() AND end_at >= NOW()";
                            $contestResult = $dbc->prepare($contestSql);
                            $contestResult->execute([":aca" => $aquariumpje["aquarium_created_at"]]);
                            $contest = $contestResult->fetch();
                        ?>

                        <div class="panel-title col-md-6"><?php echo $aquarium[0]['title'] . ' | <i> Geplaatst door: </i> &nbsp; <a href="/user/'. $user_id .'">' . $aquarium[0]['first_name'].' '.
                            $aquarium[0]['last_name'] . '</a>' ;?>
                        </div>
                        <?php if(intval($contest["amount"]) > 0) : ?>
                            <div class="text-right col-md-6">
                                <?php echo isset($like['x']) ? $like['x'] : '0'; ?> <a href="/includes/tools/aquarium/add-like?aid=<?php echo $aquariumpje['aquarium_id']; ?>"><img alt="like-vis" class="like-vis" src="/images/favicon-wit.png" alt=""></a>
                            </div>
                        <?php endif; ?>
                        <br>
                    </div>
                    <div class="panel-body">
                        <div class="container-fluid">
                            <div class="row sliderbox">
                                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        <?php foreach ($aquarium as $key => $image) : ?>
                                            <div class="item<?php echo $key == 0 ? " active" : null ?>">
                                                <img class="slider" src="/images<?php echo $image['path'] ?>" alt="<?php echo $aquarium[0]['title'] ?>">
                                            </div>
                                        <?php endforeach; ?>
                                    </div>

                                    <!-- Indicators -->


                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                                        <span class="glyphicon glyphicon-chevron-left"> </span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="right carousel-control" href="#myCarousel" data-slide="next">
                                        <span class="glyphicon glyphicon-chevron-right"> </span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            <div class="slider">
                                <!-- Images -->
                                <?php foreach ($aquarium as $key => $image) : ?>

                                    <div class=" img" style="background-image:url('/images<?php echo $image['path'] ?>');overflow: hidden;
                                    margin-left: 1em;
                                    margin-right: 1em;
                                    display: inline-block;
                                    position: relative;float:none;"; data-target="#myCarousel" data-slide-to="<?php echo $key; ?>"></div>
                                <?php endforeach; ?>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer text-right">
                        <span class="text-right"> Geplaatst op: <?php echo $aquarium[0]['aquarium_created_at']; ?></span>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <!-- Quoting system -->
            <?php
            $aantal = $page * $perPage - $perPage;
            $sql2 = "SELECT *, aquarium_reply.id AS aquarium_reply_id, aquarium_reply.content AS reply_content, aquarium_reply.created_at AS reply_created_at, user.id AS user_id FROM aquarium_reply JOIN user ON aquarium_reply.user_id = user.id JOIN image ON user.profile_img = image.id WHERE aquarium_reply.aquarium_id = ? ORDER BY reply_created_at ASC LIMIT {$perPage} OFFSET {$aantal}";
            $result2 = $dbc->prepare($sql2);
            $result2->bindParam(1, $_GET['id']);
            $result2->execute();
            $rows = $result2->fetchAll(PDO::FETCH_ASSOC);
            ?>

             <?php foreach ($rows as $row) : ?>

                 <?php
                 $matches = [
                     [],
                     [1]
                 ];
                 while ($matches[1]) {
                     preg_match_all('/\[quote\s(\d+)\]/', $row['reply_content'], $matches);

                     foreach ($matches[1] as $match) {
                         $sql = "SELECT *, reply.id FROM reply JOIN user as u ON u.id = reply.user_id WHERE reply.id = :id AND reply.deleted_at IS NULL";
                         $query = $dbc->prepare($sql);
                         $query->execute([
                             ':id' => $match
                         ]);
                         $results = $query->fetch(PDO::FETCH_ASSOC);

                         $naam = $results["first_name"] . " " . $results["last_name"];

                         if (!isset($results)) {
                             $replace = 'Oops, deze post bestaat niet meer';
                         } else {
                             $replace = $naam . ' schreef:<br>' . $results['content'];
                         }

                         $row['reply_content'] = str_replace('[quote ' . $match . ']', '<div style="background-color: lightgray; padding: 10px;border:1px solid black">' . $replace . '</div>', $row['reply_content']);
                     }
                 }
                 ?>
                 <div class="col-xs-12">
                <div class="panel panel-primary">
                    <div class="panel-heading border-color-blue">
<h3 class="panel-title text-left"><?php echo "Geplaatst door: <b><a style='color: white;' href='/user/".$row['user_id']."'>". $row['first_name'].' '.$row['last_name'].'</a></b>';?></h3>
                    </div>

                    <div class="panel-body">
                        <div class="wrapper-box col-xs-12  ">
                            <div class="col-xs-2">
                               <img alt='Album-img' class="img" src="/images<?php echo $row['path']; ?>">
                            </div>
                            <div class="col-xs-10 ">
                                <p><?php echo html_entity_decode($row['reply_content']); ?></p>
                            </div>
                        </div>

                    </div>


                    <div class="panel-footer">


                <i>op
                    <?php echo $row['reply_created_at']; ?>
                </i>
                </h3>
                <div class="pull-right">

                    <button class="btn btn-primary quote-btn" data-id="<?php echo $row['aquarium_reply_id']; ?>">
                        Quote deze post
                    </button>
                </div>

                <div class="clearfix"></div>
                </div>
            </div>
            </div>

                    <?php endforeach; ?>





            <?php
                $path = "/aquarium/post/".$_GET["id"]."/:page";
                $sql = "SELECT COUNT(*) AS x FROM aquarium_reply WHERE aquarium_id = :id AND aquarium_reply.deleted_at IS NULL";
                $pagination_bindings = [":id" => $_GET["id"]];
                require_once("../../includes/components/pagination.php");
            ?>

                <?php if ($logged_in && $aquarium) : ?>
                    <div class="col-xs-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title">Antwoord op aquarium toevoegen</h3>
                            </div>
                            <div class="panel-body">
                                <form class="form-horizontal" action="/includes/tools/aquariumParse" method="post">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                <textarea required class="form-control editor" col="8" rows="8" name="reply_content"
                                          style="resize: none;" placeholder="Uw bericht.."></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <input type="hidden" name="aquarium_id" value="<?php echo $_GET['id']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <input type="submit" class="btn btn-primary" class="form-control" name="post_aquarium_reply"
                                                   value="Plaats reactie">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            </div>

        <br>
        <footer>
            <?php require_once("../../includes/components/footer.php") ; ?>
        </footer>

    <!-- bootstrap script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- slider -->
<script type="text/javascript" src="//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick.min.js"></script>
    <!-- summer note -->
    <!-- summernote js -->
    <?php require_once("../../includes/components/summernote.php"); ?>

</body>
</html>

<?php
$levels = ["lid", "gebruiker"];
require_once("../../includes/tools/security.php"); ?>
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
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo $aquarium[0]['title'] . ' | <i> Geplaatst door: </i> &nbsp; <a href="/user/'. $user_id .'">' . $aquarium[0]['first_name'].' '.
                        $aquarium[0]['last_name'] . '</a>  <span style="float: right;"> Geplaatst op: '.$aquarium[0]['aquarium_created_at'].'</span>'  ;?></h3>
                    </div>
                    <div class="panel-body">
                        <div class="container-fluid">
                            <div class="row sliderbox">
                                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        <?php foreach ($aquarium as $key => $image) : ?>
                                            <div class="item<?php echo $key == 0 ? " active" : null ?>">
                                                <img alt='Album-img' class="sliderImg" src="/images<?php echo $image['path'] ?>"  alt="fishing">
                                            </div>
                                        <?php endforeach; ?>
                                    </div>

                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                        <!-- <li data-target="#myCarousel" data-slide-to="0" class="active"></li> -->
                                    <?php foreach ($aquarium as $key => $image) : ?>
                                        <li class="<?php echo $key == 0 ? "active" : null; ?> " data-target="#myCarousel" data-slide-to="<?php echo $key; ?>"></li>
                                    <?php endforeach; ?>
                                    </ol>

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

                                <!-- Images -->
                                <?php foreach ($aquarium as $key => $image) : ?>
                                    <div class=" img" style="background-image:url('/images<?php echo $image['path'] ?>')"; data-target="#myCarousel" data-slide-to="<?php echo $key; ?>"></div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        <?php
            $sql2 = "SELECT *, aquarium_reply.created_at AS reply_created_at, user.id AS user_id FROM aquarium_reply JOIN user ON aquarium_reply.user_id = user.id JOIN image ON user.profile_img = image.id WHERE aquarium_reply.aquarium_id = ?";
            $result2 = $dbc->prepare($sql2);
            $result2->bindParam(1, $_GET['id']);
            $result2->execute();
            $rows = $result2->fetchAll(PDO::FETCH_ASSOC);
        ?>

             <?php foreach ($rows as $row) : ?>
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
                                <p><?php echo html_entity_decode($row['content']); ?></p>
                            </div>
                        </div>

                    </div>


                    <div class="panel-footer">


                <i>op
                    <?php echo $row['reply_created_at']; ?>
                </i>
                </h3>
                <div class="pull-right">

                    <button class="btn btn-primary quote-btn" data-id="<?php echo $row2['id']; ?>">
                        Quote deze post
                    </button>
                </div>

                <div class="clearfix"></div>
                </div>
            </div>
            </div>

                    <?php endforeach; ?>






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
    <script type="text/javascript" src="/js/summernote.min.js"></script>
    <script>
        $('.editor').summernote({
            disableResizeEditor: true,
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']]
            ]
        });

        $(document).ready(function () {
            $('.quote-btn').on('click', function () {
                $('.editor').summernote('insertText', '[quote ' + ($(this).attr('data-id')) + ']')//.disabled = true
            });
        });
    </script>
</body>
</html>

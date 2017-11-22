<?php
$levels = [];
require_once("../../../includes/tools/security.php");

$sql = "UPDATE ";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Discusclub Holland</title>
    <?php require_once("../../components/head.php"); ?>
</head>

<body><!-- Global site tag (gtag.js) - Google Analytics --><script async src="https://www.googletagmanager.com/gtag/js?id=UA-110090721-1"></script><script>window.dataLayer = window.dataLayer || [];function gtag(){dataLayer.push(arguments);}gtag('js', new Date());gtag('config', 'UA-110090721-1');</script>
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
<?php
require_once("../../components/nav.php");
?>

<div class="container main">
    <div class="row columns">
        <div class="col-md-12">
            <div class="">
                <?php
                    $sql = "SELECT * FROM topic WHERE id = ? AND topic.deleted_at IS NULL";
                    $result = $dbc->prepare($sql);
                    $result->bindParam(1, $_GET['id']);
                    $result->execute();
                    $res = $result->fetch(PDO::FETCH_ASSOC);
                ?>
                <br><br>
            </div>
            <br>

        </div>
    </div>
    <?php if ($logged_in && $res) : ?>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Bewerk topic</h3>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" action="/includes/tools/edit-topic" method="post">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="edit_topic_title" minlength="3" maxlength="50" value="<?php echo isset($res['title']) ? $res['title'] : ''?>" placeholder="Topic Titel (max. 50 tekens)">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                <textarea required class="form-control editor" col="8" rows="8" name="edit_topic_content"
                                          style="resize: none !important;" placeholder="Uw bericht.."><?php echo isset($res['content']) ? $res['content'] : ''?></textarea>
                                </div>

                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input type="hidden" name="subId" value="<?php echo $_GET['id']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input type="submit" class="btn btn-primary" class="form-control" name="post_edit_topic"
                                           value="Bewerk topic">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
</div>
<footer>
    <?php require_once("../../components/footer.php") ; ?>
</footer>
<!-- bootstrap script -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!-- summernote js -->
<script type="text/javascript" src="/js/summernote.min.js"></script>
<script>
    $('.editor').summernote({
        disableResizeEditor: true,
        codemirror: {
            theme: 'yeti'
        }

    });
</script>
</body>
</html>

<?php
$levels = [];
require_once("../../includes/tools/security.php");

$id = isset($_GET["id"]) ? $_GET["id"] : 1;
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
    <?php
        require_once("../../includes/components/nav.php");

        $result = $dbc->prepare("SELECT * FROM `page` WHERE id = :id");
        $result->execute([":id" => $id]);
        $text = $result->fetch(PDO::FETCH_ASSOC);
    ?>
    <br><br>
    <div class="container main">
        <div class="row columns">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li><a href="/admin">Admin</a></li>
                    <li class="active">page</li>
                </ol>
            </div>
        </div>
        <?php
            $result = $dbc->prepare("SELECT * FROM `page`");
            $result->execute();
            $text = $result->fetchAll(PDO::FETCH_ASSOC);
         ?>
         <div class="col-md-12">

             <div class="col-md-12 ">
                 <label for="page_select">Selecteer de pagina die u wilt bewerken</label>
                 <select class="form-control" id="page_select" name="selector">
                     <?php foreach ($text as $nummer ) : ?>
                         <option <?php echo $id === $nummer["id"] ? "selected" : null; ?> value="/admin/page/<?php echo $nummer['id']; ?>" ><?php echo $nummer['name'];  ?></option>
                     <?php endforeach; ?>

                     <!-- <option value="/admin/page/1" >houden van</option>
                     <option value="/admin/page/2" >kweken</option> -->
                 </select>
             </div>
         </div>
        <?php
            $result = $dbc->prepare("SELECT * FROM `page` WHERE id = :id");
            $result->execute([":id" => $id]);
            $text = $result->fetch(PDO::FETCH_ASSOC);
        ?>
        <form class="" action="/includes/tools/page.php" method="post" enctype="multipart/form-data">
            <div class="col-md-7">
                <div class="col-md-12">
                    <label for="titel"><h3>Titel</h3></label>
                    <input id="titel" type="text" class="form-control" name="title"  value="<?php echo $text['name']; ?>">
                    <br>
                    <textarea name="content" required class="form-control editor" col="8" rows="8" value="" maxlength="50" placeholder="">
                        <?php echo $text['content']; ?>
                    </textarea>
                </div>
                <div class="col-md-12">
                    <input class="btn btn-primary" type="submit" name="send" value="Wijzig"><br><br><br>
                </div>
            </div>
            <div class="col-md-5">
                <label for="img-change text-center"><h3>Wijzig de afbeelding</h3></label>
                <label for="img-change" class="img-change text-center">Klik hier om een afbeelding te kiezen</label>
                <input id='img-change' accept="image/*" class="form-control" type="file" name="image" value="">
                <br>
            </div>
            <input type="hidden" name="slug" value="<?php echo $text['uri']; ?>">
            <input type="hidden" name="id" value="<?php echo $_GET['pagina']; ?>">
        </form>
    </div>
    <footer>
<?php require_once("../../includes/components/footer.php") ; ?>
    </footer>
    <!-- bootstrap script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- summernote js -->
    <script type="text/javascript" src="/js/summernote.min.js"></script>
    <script src="/js/summernote-ext-emoji.js" charset="utf-8"></script>
    <script>
        document.emojiSource = '/images/emoji/';
        $('.editor').summernote({
            disableResizeEditor: true,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['misc', ['emoji']],
                ['code', ['codeview']]
            ]
        });

        $(document).ready(function () {
            $('.quote-btn').on('click', function () {
                $('.editor').summernote('insertText', '[quote ' + ($(this).attr('data-id')) + ']')//.disabled = true
            });
        });

        document.querySelector("#page_select").addEventListener("change", e => {
            location.assign(e.target.selectedOptions[0].value)
        })

    </script>

</body>

</html>

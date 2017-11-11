<?php
$levels = [];
require_once("../../includes/tools/security.php");

$page = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
if (false === intval($page)) {
    exit;
}
$perPage = 20;
$id = isset($_GET["id"]) ? $_GET["id"] : 1;
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

    <!-- summernote css -->
    <link rel="stylesheet" href="/css/summernote.css">
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
                 <select class="form-control" id="page_select">
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
        <div class="col-md-7">
            <form class="" action="houden-van" method="post">
                <div class="col-md-12">
                    <label for="titel"><h3>Titel</h3></label>
                    <input id="titel" type="text" class="form-control" name="title"  value="<?php echo $text['name']; ?>">
                    <br>
                    <textarea required class="form-control editor" col="8" rows="8" value="" maxlength="50" placeholder="">
                        <?php echo $text['content']; ?>
                    </textarea>
                </div>
                <div class="col-md-12">
                    <input class="btn btn-primary" type="submit" name="send" value="Wijzig"><br><br><br>
                </div>
            </form>
        </div>
        <div class="col-md-5">
            <label for="img-change text-center"><h3>Wijzig de afbeelding</h3></label>
            <label for="img-change" class="img-change text-center">Klik hier om een afbeelding te kiezen</label>
            <input id='img-change' accept="image/*" class="form-control" type="file" name="" value="">
        </div>
    </div>
    <footer>
<?php require_once("../../includes/components/footer.php") ; ?>
    </footer>
    <!-- bootstrap script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

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

        document.querySelector("#page_select").addEventListener("change", e => {
            location.assign(e.target.selectedOptions[0].value)
        })

    </script>
</body>

</html>

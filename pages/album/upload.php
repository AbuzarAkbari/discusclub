<?php
$levels = ["gebruiker"];
include_once("../../includes/tools/security.php"); ?>
<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Discusclub Holland</title>
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:300,300italic,400" />
    <!-- custom css -->
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/album-upload.css">
    <link rel="canonical" href="https://css-tricks.com/examples/DragAndDropFileUploading/">
    <!-- font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <!-- bootstrap style -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <link rel="stylesheet" href="/css/dropzone.css">
<script>(function(e,t,n){var r=e.querySelectorAll("html")[0];r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")})(document,window,0);</script>
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
<?php require_once("../../includes/components/nav.php"); ?>

    <div class="container1 main">
        <div class="row">
            <br><br>
            <div class="panel panel-primary">
                <div class="panel-heading border-color-blue">
                    <h3 class="panel-title">Album uploaden</h3>
                </div>
                <div class="panel-body">
                    <input type="text" class="form-control" name="album-name" placeholder='Titel'><br>
                    <!-- <form action="/includes/tools/album-upload" class="dropzone col-md-12" id="my-awesome-dropzone">

                    </form> -->
                    <form method="post" action="https://css-tricks.com/examples/DragAndDropFileUploading//?submit-on-demand" enctype="multipart/form-data" novalidate="" class="box has-advanced-upload">


            		<div class="box__input">
            			<svg class="box__icon" xmlns="http://www.w3.org/2000/svg" width="50" height="43" viewBox="0 0 50 43"><path d="M48.4 26.5c-.9 0-1.7.7-1.7 1.7v11.6h-43.3v-11.6c0-.9-.7-1.7-1.7-1.7s-1.7.7-1.7 1.7v13.2c0 .9.7 1.7 1.7 1.7h46.7c.9 0 1.7-.7 1.7-1.7v-13.2c0-1-.7-1.7-1.7-1.7zm-24.5 6.1c.3.3.8.5 1.2.5.4 0 .9-.2 1.2-.5l10-11.6c.7-.7.7-1.7 0-2.4s-1.7-.7-2.4 0l-7.1 8.3v-25.3c0-.9-.7-1.7-1.7-1.7s-1.7.7-1.7 1.7v25.3l-7.1-8.3c-.7-.7-1.7-.7-2.4 0s-.7 1.7 0 2.4l10 11.6z"></path></svg>
            			<input type="file" name="files[]" id="file" class="box__file" data-multiple-caption="{count} files selected" multiple="">
            			<label for="file"><strong>Kies je bestand</strong><span class="box__dragndrop"> of sleep het hierheen.</span></label>
                        <br>
            			<button type="submit" class="btn btn-primary" name="button">Uploaden</button>
            		</div>


            		<div class="box__uploading">Aan het uploaden..</div>
            		<div class="box__success">Bestand succesvol geupload! <a href="https://css-tricks.com/examples/DragAndDropFileUploading//?submit-on-demand" class="box__restart" role="button">Meer uploaden?</a></div>
            		<div class="box__error">Error! <span></span>. <a href="https://css-tricks.com/examples/DragAndDropFileUploading//?submit-on-demand" class="box__restart" role="button">Probeer opnieuw!</a></div>
            	<input type="hidden" name="ajax" value="1"></form>

                </div>
            </div>
            <br>
        </div>
    </div>
    <!-- <div class="conainter-fluid"></div> -->
    <footer>
<?php require_once("../../includes/components/footer.php") ; ?>
    </footer>
    <script src="/js/album-upload.js"></script>

    <!-- bootstrap script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- dropzone script -->
    <script src="/js/dropzone.js" charset="utf-8"></script>
    <script type="text/javascript">
    // jQuery
        $("#my-awesome-dropzone").dropzone({ acceptedFiles: "image/*"});
    </script>
    <script src="/js/drag-drop.js" charset="utf-8"></script>
</body>
</html>
<!-- https://twitter.com/DiscusHolland -->

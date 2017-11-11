<?php
$levels = ["gebruiker"];
include_once("../../includes/tools/security.php"); ?>
<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
    <title>Discusclub Holland</title>
    <?php require_once("../../includes/components/head.php"); ?>
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

    <div class="container main">
        <div class="row">
            <br><br>
            <div class="">
                <ol class="breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li><a href="/album/">Album</a></li>
                    <li class="active">Upload</li>
                </ol>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading border-color-blue">
                    <h3 class="panel-title">Album uploaden</h3>
                </div><br>
                 <?php if(isset($_GET['error'])): ?>
                    <div class="alert alert-danger" role="alert"><?php echo $_GET['error']; ?></div>
                <?php endif; ?>
                <div class="panel-body ">
                    <form method="post" action="/includes/tools/album-upload" enctype="multipart/form-data">
                        <input type="text" class="form-control" name="album_name" placeholder='Titel' maxlength="40" required ><br>
                        <div class="text-center">
                        <div class="box has-advanced-upload" onclick="document.getElementById('dinges').click();" style="cursor: pointer;">
                	        <svg class="box__icon" xmlns="http://www.w3.org/2000/svg" width="50" height="43" viewBox="0 0 50 43"><path d="M48.4 26.5c-.9 0-1.7.7-1.7 1.7v11.6h-43.3v-11.6c0-.9-.7-1.7-1.7-1.7s-1.7.7-1.7 1.7v13.2c0 .9.7 1.7 1.7 1.7h46.7c.9 0 1.7-.7 1.7-1.7v-13.2c0-1-.7-1.7-1.7-1.7zm-24.5 6.1c.3.3.8.5 1.2.5.4 0 .9-.2 1.2-.5l10-11.6c.7-.7.7-1.7 0-2.4s-1.7-.7-2.4 0l-7.1 8.3v-25.3c0-.9-.7-1.7-1.7-1.7s-1.7.7-1.7 1.7v25.3l-7.1-8.3c-.7-.7-1.7-.7-2.4 0s-.7 1.7 0 2.4l10 11.6z"></path></svg>
                			<input required type="file" name="files[]" id="file" class="box__file" data-multiple-caption="{count} files selected" multiple="">
                			<label id="dinges" for="file"><strong>Kies je bestand</strong><span class="box__dragndrop "> of sleep het hierheen.</span>.</label>
                    		<div class="box__uploading">Aan het uploaden..</div>
                    		<div class="box__error">Er is iets misgegaan..<span></span>. <a href="#" class="box__restart" role="button">Probeer het opnieuw!</a></div>
                        	<input type="hidden" name="ajax" value="1">
                		</div>
                        <button type="submit" name="upload_album" class="box__button btn btn-primary">Upload album</button>
                    </div>
                    </form>
                </div>
            </div>
            <br>
        </div>
    </div>
    <!-- <div class="conainter-fluid"></div> -->
    <footer>
<?php require_once("../../includes/components/footer.php") ; ?>
    </footer>
    <!-- <script src="/js/album-upload.js"></script> -->

    <!-- bootstrap script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>(function(e,t,n){var r=e.querySelectorAll("html")[0];r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")})(document,window,0);</script>

    <script src="/js/drag-drop.js" charset="utf-8"></script>
</body>
</html>
<!-- https://twitter.com/DiscusHolland -->

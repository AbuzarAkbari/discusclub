<?php
$levels = ["gebruiker"];
include_once("includes/security.php"); ?>
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
<?php require_once("../../includes/components/nav.php"); ?>

    <div class="container main">
        <div class="row">
            <br><br>
            <div class="panel panel-primary">
              <div class="panel-heading border-color-blue">
                <h3 class="panel-title">Album uploaden</h3>
              </div>
              <div class="panel-body">
                  <div class="contact">
                  <form method="post" enctype="multipart/form-data"  action="#" id="image-form">

                        <div class="one_col file-upload">
                            <div id="file"><ul id="image-list"><p>Click or Drag in an image to upload</p></ul></div>
                            <input type="file" class="file" name="images" id="images"/>
                            <span class="error"></span>
                        </div>

                        <div class="one_col">
                            <input id="submit" type="submit" value="Upload album" class="btn btn-primary" />
                        </div>
                        <span class="clear"></span>
                    </form>
                </div>

            </div>
            </div><br>
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
</body>
</html>
<!-- https://twitter.com/DiscusHolland -->

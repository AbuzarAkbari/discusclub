<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge"><link rel="shortcut icon" href="/favicon.ico" />

<!-- custom css -->
<link rel="stylesheet" href="/css/style.css">
<link rel="stylesheet" href="/css/dropzone.css">
<link rel="stylesheet" href="/css/view.css">
<link rel="stylesheet" href="/css/summernote.css">


<?php
if(preg_match('/news|forum/', $_SERVER["REQUEST_URI"])) {
  echo '<link rel="stylesheet" href="/css/nieuws.css">';
}
if(preg_match('/about|admin/', $_SERVER["REQUEST_URI"])) {
  echo '<link rel="stylesheet" href="/css/overons.css">';
}
if(preg_match('/album/', $_SERVER["REQUEST_URI"])) {
  echo '<link rel="stylesheet" href="/css/albums.css">';
}
if(preg_match('/upload/', $_SERVER["REQUEST_URI"])) {
  echo '<link rel="stylesheet" href="/css/album-upload.css">';
}
if(preg_match('/user/', $_SERVER["REQUEST_URI"]) && !preg_match("/conf|register|user-list/", $_SERVER["REQUEST_URI"])) {
  echo '<link rel="stylesheet" href="/css/gebruiker.css">';
}
if(preg_match('/user/', $_SERVER["REQUEST_URI"])) {
  echo '<link rel="stylesheet" href="/css/datepicker.css">';
}
if(preg_match('/messen/', $_SERVER["REQUEST_URI"])) {
  echo '<link rel="stylesheet" href="/css/message.css">';
}
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<!-- <link rel="canonical" href="https://css-tricks.com/examples/DragAndDropFileUploading/"> -->

<!-- font -->
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<!-- <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:300,300italic,400,500" /> -->
<link href="https://fonts.googleapis.com/css?family=Raleway:400,500,600" rel="stylesheet">
<link href="https://www.w3schools.com/w3css/4/w3.css" rel="stylesheet">
<!-- bootstrap style -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<!-- summernote css -->
<link rel="stylesheet" href="/css/summernote.css">
<link rel="stylesheet" href="/css/summernote-emoji.css">

<!-- daterangepicker -->
<!-- Include Required Prerequisites -->
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap/3/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />

<!-- Add the slick-theme.css if you want default styling -->
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick-theme.css"/>

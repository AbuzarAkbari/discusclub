<?php require_once("../../includes/tools/security.php"); ?>
<?php
if(isset($_POST['search_news'])){
$search = $_POST['search_area'];
$sql = $dbc->prepare("SELECT *, sc.id AS sub_id , sc.name AS sub_name, n.id, n.created_at AS news_created_at FROM news AS n LEFT JOIN news_reply AS nr ON n.id = nr.news_id JOIN sub_category as sc ON sc.id = n.sub_category_id  WHERE n.title LIKE :search OR n.content LIKE :search OR nr.content LIKE :search GROUP BY n.id");
$sql->execute([":search" => isset($search) ? "%" . $search . "%" : "%"]);
$results = $sql->fetchAll(PDO::FETCH_OBJ);
} else{
  header('location: /news/index.php');
}
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
    ?>

    <br><br>
    <div class="container main">
      <?php if ($logged_in) :?>
      <div class="row columns">
          <div class="col-md-12">
              <ol class="breadcrumb">
                  <li><a href="/">Home</a></li>
                  <li><a href="/news/">Nieuws</a></li>
                  <li class="active">Zoek nieuws</li>
              </ol>
          </div>
      <div class="col-md-12">
        <div class="panel panel-primary ">
          <div class="panel-heading border-colors">Zoekresultaten</div>
           <div class="panel-body padding-padding table-responsive">
            <table>
              <?php if(sizeof($results) === 0):?>  
                <tr>
                    <td>Er zijn geen resultaten gevonden</td>
                  </tr> 
              <?php else : ?>
              <thead>
                <tr>
                  <th>Titel</th>
                  <th>Reacties</th>
                  <th>Categorie</th>
                  <th>Datum</th>
                </tr>
              </thead>
              <tbody>
                   
                  
                  <?php endif; ?>
                <?php foreach ($results as $key => $value) : ?>
                <?php
                  $sth = $dbc->prepare("SELECT count(*) as amount FROM news_reply WHERE news_id = :id");
                  $sth->execute([":id" => $value->id]);
                  $amount = $sth->fetch(PDO::FETCH_OBJ)->amount;
                  ?>   
                  <tr>
                    <td><a href="/news/post/<?php echo $value->id; ?>"><?php echo $value->title; ?></a></td>
                    <td><?php echo $amount; ?></td>
                    <td><a href="/forum/topic.php?id=<?php echo $value->sub_id; ?>"><?php echo $value->sub_name; ?></a></td>
                    <td><?php echo $value->news_created_at; ?></td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
           </div>
         </div>
        </div>
      <?php endif; ?>
    </div>
    </div>
    <footer>
<?php require_once("../../includes/components/footer.php") ; ?>
    </footer>
    <!-- bootstrap script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
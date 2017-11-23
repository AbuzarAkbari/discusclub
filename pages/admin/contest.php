<?php
$levels = [];
require_once("../../includes/tools/security.php");

if(isset($_POST['start_contest']))
{
    $date = explode(" - ", $_POST['daterange']);
    $begin = $date[0];
    $end = $date[1];

    $select = "SELECT * FROM contest WHERE start_at < :begin AND end_at > :end AND deleted_at IS NULL";
    $result = $dbc->prepare($select);
    $result->execute([":begin" => $begin, ":end" => $end]);
    $aantal = $result->fetchAll(PDO::FETCH_ASSOC);

    if(sizeof($aantal) === 0) {
        $sql = "INSERT INTO contest (start_at, end_at) VALUES (:start_at, :end_at)";
        $result = $dbc->prepare($sql);
        $result->execute([":start_at" => $begin, ":end_at" => $end]);
    }
    else
    {
        echo "Tussen deze begin en eind datum is er al een contest!";
        exit();
    }
}

if(isset($_POST["daterange"]) && isset($_POST["id"])) {
    $id = $_POST['id'];
    $date = explode(" - ", $_POST['daterange']);
    $begin = $date[0];
    $end = $date[1];



    $sql = "UPDATE contest SET start_at = :start_at, end_at = :end_at WHERE id = :id";
    $result = $dbc->prepare($sql);
    $result->execute([":start_at" => $begin, ":end_at" => $end, ":id" => $id]);
}

    $stm = $dbc->prepare("SELECT * FROM contest WHERE deleted_at IS NULL");
    $stm->execute();
    $contests = $stm->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Discusclub Holland</title>
    <?php require_once("../../includes/components/head.php"); ?>

</head>

<body><!-- Global site tag (gtag.js) - Google Analytics --><script async src="https://www.googletagmanager.com/gtag/js?id=UA-110090721-1"></script><script>window.dataLayer = window.dataLayer || [];function gtag(){dataLayer.push(arguments);}gtag('js', new Date());gtag('config', 'UA-110090721-1');</script>
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
        <div class="row">
            <div class="">
                <ol class="breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li><a href="/admin">Admin</a></li>
                    <li class="active">Contest</li>
                </ol>
            </div>
            <div class="col-md-6">
                <form class="" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
                    <div class="col-md-12">
                        <h2>Selecteer een begin en eind datum</h2>
                        <h5>Dit word de begin en einddatum van de beste aquarium wedstrijd</h5>
                        <br>
                    </div>
                    <div class="col-md-12">
                        <input type="text" class="form-control" name="daterange" value="" id="create"/>
                        <br>
                        <input type="submit" class="btn btn-primary" name="start_contest" value="Verzend!">
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <h2>Aankomende wedstrijden</h2>
                <hr>
                <div class="panel panel-primary">
                  <div class="panel-heading">
                    <h3 class="panel-title">Aankomende wedstrijden</h3>
                  </div>
                  <div class="panel-body">
                      <table class="col-md-12">
                          <?php if(sizeof($contests) != 0) : ?>
                              <tr>
                                  <th>start - einddatum</th>
                                  <th>Verwijder</th>
                              </tr>
                              <?php foreach($contests as $contest) : ?>
                              <tr class="contest-box">
                                  <td>
                                      <form id="contest-form-<?php echo $contest['id']; ?>" class="" action="<?php echo $_SERVER["REQUEST_URI"]; ?>" method="post">
                                          <input type="hidden" name="id" value="<?php echo $contest['id']; ?>">
                                          <input type="text" id="contest-<?php echo $contest['id']; ?>" class="form-control" name="daterange" data-start="<?php echo date('d/m/Y H:i', strtotime($contest['start_at'])); ?>" data-end="<?php echo date( 'd/m/Y H:i', strtotime($contest['end_at'])); ?>"/>
                                      </form>
                                  </td>
                                  <td>
                                      <a href="/includes/tools/contest/del.php?contest_id=<?php echo $contest['id']; ?>"><button class="status-block btn btn-danger" type="button" name="button"><span class="glyphicon glyphicon-remove"></span></button></a>
                                  </td>
                              </tr>
                              <?php endforeach; ?>

                          <?php else : ?>
                                  <tr>
                                      <td>Geen contest gevonden</td>
                                  </tr>
                          <?php endif; ?>
                      </table>
                  </div>
                </div>

            </div>
        </div>
    </div>
    <footer>
    <?php require_once("../../includes/components/footer.php") ; ?>
    </footer>
    <!-- bootstrap script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
    <script type="text/javascript">
        $(function() {
            $('#create').daterangepicker({
                timePicker: true,
                timePicker24Hour: true,
                timePickerIncrement: 1,
                minDate: new Date(),
                applyClass: "btn-primary",
                cancelClass: "btn-danger",
                locale: {
                    format: 'YYYY-MM-DD HH:mm',
                },
            });
        });

        <?php foreach($contests as $contest): ?>
            $(function() {
                $('#contest-<?php echo $contest['id']; ?>').daterangepicker({
                    timePicker: true,
                    timePicker24Hour: true,
                    timePickerIncrement: 1,
                    applyClass: "btn-primary",
                    cancelClass: "btn-danger",
                    locale: {
                        format: 'YYYY-MM-DD HH:mm',
                    },
                    startDate: '<?php echo date('Y-m-d H:i', strtotime($contest['start_at'])); ?>',
                    endDate: '<?php echo date('Y-m-d H:i', strtotime($contest['end_at'])); ?>'
                });
                $('#contest-<?php echo $contest['id']; ?>').on('apply.daterangepicker', function(ev, picker) {
                    document.querySelector("#contest-form-<?php echo $contest['id']; ?>").submit();
                });
            });

        <?php endforeach; ?>
    </script>
</body>
</html>

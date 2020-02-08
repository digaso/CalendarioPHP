<html lang="en">
<?php
include 'include/db.inc.php';
include 'include/functions.inc.php';

?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/main.css">
  <title>Calendário</title>

</head>

<?php
$today = date('j');
$month = date('n');
$year = date('Y');
$thisyear = isset($_GET['year']) ? $_GET['year'] : date('Y');
$thismonth = isset($_GET['month']) ? $_GET['month'] : date('n');
$totaldays = date('t', mktime(0, 0, 0, $thismonth, 1, $thisyear));

$thisdate = zeroOrNah($today) . $today . '-' . zeroOrNah($thismonth) . $thismonth . '-' . $thisyear;

if ($thismonth <= 0) {
  $thisyear -= 1;
  $thismonth = 12;
}
if ($thismonth >= 13) {
  $thisyear += 1;
  $thismonth = 1;
}


$weekdays = array(1 => 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab', 'Dom');
$months = array(1 => 'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro');
$monthStartDay = date('N', mktime(0, 0, 0, $thismonth, 1, $thisyear));

?>

<body>
  <table class="calendar">
    <tr>
      <?php
      echo '<td class="gold centered"><a class="seta gold" href="?year=' . ($thisyear - 1) . '&month=' . $thismonth . '"> <</a></td>';

      echo '<td class="gold  year" colspan=5 >' . $thisyear . '</td>';

      echo '<td class="gold centered"><a class="seta gold"  href="?year=' . ($thisyear + 1) . '&month=' . $thismonth . '">></a></td>' ?>
    </tr>
    <tr>
      <?php
      echo '<td class="gold centered"><a  class="seta gold" href="?year=' . $thisyear . '&month=' . ($thismonth - 1) . '"><</a></td>';

      echo '<td class="gold  month" colspan=5 ><a>' . $months[$thismonth] . '</a></td>';

      echo '<td class="gold centered"><a  class="seta gold" href="?year=' . $thisyear . '&month=' . ($thismonth + 1) . '">></a></td>';
      ?>
    </tr>
    <tr>
      <?php


      foreach ($weekdays as $day) {

        echo '<td class="weekday gold centered" >' . $day . '</td>';
      }
      ?>
    </tr>

    <?php
    echo '<tr >';
    for ($i = 1; $i <= $monthStartDay - 1; $i++) {
      echo '<td class"empty"> </td>';
    }
    $hasevent = '';
    $sql = "SELECT * FROM 12itm03_calendario ";
    $res = my_query($sql);
    $todayclass = "";


    for ($i = 1; $i <= $totaldays; $i++) {
      if ($today == $i && $month == $thismonth && $year == $thisyear) {
        $todayclass = " today";
      }

      foreach ($res as $value) {
        if ($value['data'] == '' . $thisyear . '-' . (zeroOrNah($thismonth)) . $thismonth . '-' . (zeroOrNah($i)) . $i) {
          $hasevent = ' comevento';
        }
      }
      echo '<td class="day centered' . $hasevent . ' gold' . $todayclass . '">' . $i . '</td>';
      if (($i + $monthStartDay - 1) % 7 == 0) {
        echo '</tr><tr>';
      }
      $hasevent = '';
      $todayclass = "";
    }

    ?>

  </table>
  <?php
  foreach ($res as $line) {
    echo '<div class="evento">';
    echo '<p>' . $line['descricao'] . '</p>';
    echo '<span>Local: ' . $line['local'] . '</span>';
    echo '</div>';
  }
  ?>

</body>

</html>
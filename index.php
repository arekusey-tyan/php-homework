<?php
require ('./config/db.php');
$months = array(
  1  => 'Январь',
  2  => 'Февраль',
  3  => 'Март',
  4  => 'Апрель',
  5  => 'Май',
  6  => 'Июнь',
  7  => 'Июль',
  8  => 'Август',
  9  => 'Сентябрь',
  10 => 'Октябрь',
  11 => 'Ноябрь',
  12 => 'Декабрь'
);
$weekdays = array(
  '1.01',
  '2.01',
  '3.01',
  '4.01',
  '5.01',
  '6.01',
  '23.02',
  '24.02',
  '8.03',
  '1.05',
  '8.05',
  '9.05',
  '12.06',
  '6.11'
)

?>

<style>
  .calendar-item {
    width: 200px;
    display: inline-block;
    vertical-align: top;
    margin: 0 16px 20px;
    font: 14px/1.2 Arial, sans-serif;
  }
  .calendar-head {
    text-align: center;
    padding: 5px;
    font-weight: 700;
    font-size: 14px;
  }
  .calendar-item table {
    border-collapse: collapse;
    width: 100%;
    font-weight: 600;
  }
  .calendar-item th {
    font-size: 12px;
    padding: 6px 7px;
    text-align: center;
    color: #888;
    font-weight: normal;
  }
  .calendar-item td {
    font-size: 13px;
    padding: 6px 5px;
    text-align: center;
    border: 1px solid #ddd;
  }
  .calendar-item tr th:nth-child(6), .calendar-item tr th:nth-child(7),
  .calendar-item tr td:nth-child(6), .calendar-item tr td:nth-child(7),
  .calendar-day.freeday  {
    color: #e65a5a;
  }	
  .calendar-day.last {
    color: #999 !important;
  }	
  .calendar-day.today {
    font-weight: bold;
    background: #ffe2ad;
  }
  .calendar-day.event {
    background: #ffe2ad;
    position: relative;
    cursor: pointer;
  }
  .calendar-day.event:hover .calendar-popup {
    display: block;
  }
  .calendar-popup {
    display: none;
    position: absolute;
    top: 40px;
    left: 0;
    min-width: 200px;
    padding: 15px;
    background: #fff;
    text-align: left;
    font-size: 13px;
    z-index: 100;
    box-shadow: 0 0 10px rgba(0,0,0,0.5);
    color: #000;
  }
  .calendar-popup:before {
    content: ""; 
    border: solid transparent;
    position: absolute;    
    left: 8px;    
    bottom: 100%;
    border-bottom-color: #fff;
    border-width: 9px;
    margin-left: 0;
  }
</style>

<form>
  Red: <input type="number" name="red" max="255" min="0" style="margin-left: 30px;width: 100px" /><br />
  Green: <input type="number" name="green" max="255" min="0" style="margin-left: 16px;width: 100px" /><br />
  Blue: <input type="number" name="blue" max="255" min="0" style="margin-left: 25px;width: 100px" /><br />
  <button>Send</button>
</form>

<?php
if (!empty($_GET['red']) || !empty($_GET['green']) || !empty($_GET['blue'])) {
?>
<span style="background: rgb(<?= $_GET['red'] !== "" ? +$_GET['red'] : 0; ?>, <?= $_GET['green'] !== "" ? +$_GET['green'] : 0; ?>, <?= $_GET['blue'] !== "" ? +$_GET['blue'] : 0; ?>);color: rgb(<?= random_int(0, 255); ?>, <?= random_int(0, 255); ?>, <?= random_int(0, 255); ?>)">
<?php } else { ?>
<span>
<?php } ?>
  Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatum, ducimus voluptates? Eius pariatur rem inventore odio. Provident necessitatibus similique enim, debitis magnam consequuntur laudantium quae dolores nostrum omnis animi accusamus?
</span>
<br /><hr /><br /><br />
<div>
  <form>
    <span>
      <input type="number" name="month" min=1 max=12 value=<?= +$_GET['month']; ?> />
    </span>
    <span>
      <button>Get month</button>
    </span>
  </form>
  <div>
    <?php if (!empty($_GET['month'])) {
      $month = +$_GET['month'];
      $out = '<div class="calendar-item">
        <div class="calendar-head">' . $months[$month] . ' 2023</div>
        <table>
          <tr>
            <th>Пн</th>
            <th>Вт</th>
            <th>Ср</th>
            <th>Чт</th>
            <th>Пт</th>
            <th>Сб</th>
            <th>Вс</th>
          </tr>';
      $day_week = date('N', mktime(0, 0, 0, $month, 1, 2023));
      $day_week--;
      $out .= '<tr>';
      for ($x = 0; $x < $day_week; $x++) {
        $out.= '<td></td>';
      }
      $days_counter = 0;
      $days_month = date('t', mktime(0, 0, 0, $month, 1, 2023));
      for ($day = 1; $day <= $days_month; $day++) {
        if (date('j.n.Y') == $day . '.' . $month . '.2023') {
          $class = 'today';
        } elseif (time() > strtotime($day . '.' . $month . '.2023')) {
          $class = 'last';
        } elseif (in_array($day . '.' . ($month > 9 ? $month : '0' . $month), $weekdays)) {
          $class = 'freeday';
        } else {
          $class = '';
        }
        $event_show = false;
			  $event_text = array();
        if (!empty($events)) {
          foreach ($events as $date => $text) {
            $date = explode('.', $date);
            if (count($date) == 3) {
              $y = explode(' ', $date[2]);
              if (count($y) == 2) {
                $date[2] = $y[0];
              }
              if ($day == intval($date[0]) && $month == intval($date[1]) && $year == $date[2]) {
                $event_show = true;
                $event_text[] = $text;
              }
            } elseif (count($date) == 2) {
              if ($day == intval($date[0]) && $month == intval($date[1])) {
                $event_show = true;
                $event_text[] = $text;
              }
            } elseif ($day == intval($date[0])) {
              $event_show = true;
              $event_text[] = $text;
            }				
          }
        }
        if ($event_show) {
          $out.= '<td class="calendar-day ' . $class . ' event">' . $day;
          if (!empty($event_text)) {
            $out.= '<div class="calendar-popup">' . implode('<br>', $event_text) . '</div>';
          }
          $out.= '</td>';
        } else {
          $out.= '<td class="calendar-day ' . $class . '">' . $day . '</td>';
        }
        if ($day_week == 6) {
          $out.= '</tr>';
          if (($days_counter + 1) != $days_month) {
            $out.= '<tr>';
          }
          $day_week = -1;
        }
        $day_week++; 
			  $days_counter++;
      }
      $out .= '</tr></table></div>';
      print $out;
    } ?>
  </div>
</div>
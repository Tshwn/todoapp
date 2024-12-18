<?php
//Web上で実行
//月曜始まりのカレンダー

date_default_timezone_set('Asia/Tokyo');

$weeks = [
    0=>'日',
    1=>'月',
    2=>'火',
    3=>'水',
    4=>'木',
    5=>'金',
    6=>'土'
];
    $days = [];
    $len = 0;
    $year = date('Y',strtotime('today'));
    $month = date('m',strtotime('today'));
    $start = date('Ym01',strtotime('today'));
    $end = date('Ymt', strtotime('today'));

    for($day=$start;$day<=$end;$day++) {
        $w = date("w",strtotime($day));
        if($w == 0) {
            $len++;
        }

        if(!isset($days[$len])) {
            foreach($weeks as $key_week => $value_week) {
                $days[$len][$key_week] = "";
            }
        }

        $days[$len][$w] = $day;
    }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>shiken2</title>
</head>
<body>
    <?php
    echo $year . "年" . "    " . $month . "月のカレンダー";
    ?>
        <table>
        <thead>
            <tr>
            <?php foreach($weeks as $key_week => $value_week): ?>
                <th><?php echo $value_week; ?></th>
            <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach($days as $day): ?>
                <tr>
                    <?php foreach($weeks as $key_week => $value_week): ?>
                        <?php
                        $style = "";
                        if ($key_week == 0) {
                            $style = 'color: red;';
                        }
                        elseif($key_week == 6) {
                            $style = 'color: blue;';
                        }
                        ?>
                        <?php if($day[$key_week]): ?>
                            <td style="text-align: center;<?php echo $style; ?>"><?php echo date('j',strtotime($day[$key_week])); ?></td>
                        <?php else: ?>
                            <td></td>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
        </table>
</body>
</html>
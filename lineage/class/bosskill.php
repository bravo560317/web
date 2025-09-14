<?php
// 資料庫連線設定
$mysqli = new mysqli("localhost", "root", "root", "class");
$mysqli->set_charset("utf8");

// 自訂職業對照表
$class_map = [
    0 => "王子(男)",
    1 => "公主(女)",
    37 => "妖精(女)",
    138 => "男妖精(男)",
    48 => "騎士(女)",
    61 => "騎士(男)",
    734 => "法師(男)",
    1186 => "法師(女)",
    2786 => "黑妖(男)",
    2796 => "黑妖(女)",
    6650 => "幻術師(女)",
    6671 => "幻術師(男)",
    6658 => "龍騎士(男)",
    6661 => "龍騎士(女)"
];

// 查詢排行榜資料
$sql = "SELECT char_name, PrestigeLv, Class FROM characters WHERE PrestigeLv > 0 ORDER BY PrestigeLv DESC LIMIT 10";
$result = $mysqli->query($sql);

// 整理資料
$data = [];
while ($row = $result->fetch_assoc()) {
    $class_name = isset($class_map[$row['Class']]) ? $class_map[$row['Class']] : "未知";
    $data[] = [
        'char_name' => $row['char_name'],
        'prestige' => intval($row['PrestigeLv']),
        'class' => $class_name
    ];
}
?>
<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8">
    <title>BOSS擊殺排行榜</title>
    <style>
        body { font-family: "Microsoft JhengHei", sans-serif; background-color: #f0f0f0; padding: 20px; }
        h1 { color: #333; }
        table { width: 100%; border-collapse: collapse; background: white; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #444; color: #fff; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .rank { width: 60px; text-align: center; }
    </style>
</head>
<body>
    <h1>★ 威望排行榜 ★</h1>
    <table>
        <thead>
            <tr>
                <th class="rank">排名</th>
                <th>角色名稱</th>
                <th>職業</th>
                <th>BOSS斬殺數</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $rank = 1;
            foreach ($data as $row) {
                echo "<tr>
                        <td class='rank'>{$rank}</td>
                        <td>{$row['char_name']}</td>
                        <td>{$row['class']}</td>
                        <td>{$row['prestige']}</td>
                      </tr>";
                $rank++;
            }
            ?>
        </tbody>
    </table>
</body>
</html>

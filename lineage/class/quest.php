<?php
// 連線資料庫
$db = new mysqli("localhost", "root", "root", "class");
$db->set_charset("utf8");

// 查詢每位玩家擁有的最高傲塔徽章編號
$sql = "
    SELECT c.char_name, MAX(i.item_id) AS max_item
    FROM character_items i
    JOIN characters c ON i.char_id = c.objid
    WHERE i.item_id BETWEEN 101001 AND 101600
    GROUP BY i.char_id
    ORDER BY max_item DESC
    LIMIT 50
";
$result = $db->query($sql);

// 整理資料
$data = [];
while ($row = $result->fetch_assoc()) {
    $progress = $row['max_item'] - 101000;
    $label = "傲塔徽章({$progress}/600)";
    $data[] = [
        'char_name' => $row['char_name'],
        'progress_label' => $label,
        'progress_num' => $progress
    ];
}
?>
<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8">
    <title>主線任務排行榜</title>
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
    <h1>★ 主線任務進度排行榜 ★</h1>
    <table>
        <thead>
            <tr>
                <th class="rank">排名</th>
                <th>玩家名稱</th>
                <th>主線進度</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $rank = 1;
            foreach ($data as $row) {
                echo "<tr>
                        <td class='rank'>{$rank}</td>
                        <td>{$row['char_name']}</td>
                        <td>{$row['progress_label']}</td>
                      </tr>";
                $rank++;
            }
            ?>
        </tbody>
    </table>
</body>
</html>

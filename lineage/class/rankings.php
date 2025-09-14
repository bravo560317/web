<?php
// 統一初始化資料庫連線
$db = new mysqli("localhost", "root", "root", "class");
$db->set_charset("utf8");
?>
<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8">
    <title>排行榜整合頁面</title>
    <style>
        body { font-family: "Microsoft JhengHei", sans-serif; background-color: #f0f0f0; padding: 20px; }
        h1 { color: #333; }
        .tabs {
            margin-bottom: 20px;
        }
        .tab-button {
            background-color: #ccc;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            margin-right: 5px;
        }
        .tab-button.active {
            background-color: #444;
            color: white;
        }
        .tab-content {
            display: none;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            margin-top: 10px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #444;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .rank {
            width: 60px;
            text-align: center;
        }
    </style>
    <script>
        function showTab(tabId) {
            var contents = document.getElementsByClassName("tab-content");
            for (var i = 0; i < contents.length; i++) {
                contents[i].style.display = "none";
            }
            var buttons = document.getElementsByClassName("tab-button");
            for (var i = 0; i < buttons.length; i++) {
                buttons[i].classList.remove("active");
            }
            document.getElementById(tabId).style.display = "block";
            document.getElementById("btn_" + tabId).classList.add("active");
        }
        window.onload = function() {
            showTab("weapon");
        };
    </script>
</head>
<body>
    <h1>★ 綜合排行榜 ★</h1>
    <div class="tabs">
        <button class="tab-button" id="btn_weapon" onclick="showTab('weapon')">武器排行榜</button>
        <button class="tab-button" id="btn_bosskill" onclick="showTab('bosskill')">打王排行榜</button>
        <button class="tab-button" id="btn_quest" onclick="showTab('quest')">主線任務排行榜</button>
    </div>
    <div id='weapon' class='tab-content' style='display:none;'>
<table>
        <thead>
            <tr>
                <th class="rank">排名</th>
                <th>玩家名稱</th>
                <th>武器名稱</th>
                <th>強化值</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $rank = 1;
            foreach ($data as $row) {
                echo "<tr>
                        <td class='rank'>{$rank}</td>
                        <td>{$row['char_name']}</td>
                        <td>{$row['weapon_name']}</td>
                        <td>+{$row['enchant']}</td>
                      </tr>";
                $rank++;
            }
            ?>
        </tbody>
    </table>
</div>
    <div id='bosskill' class='tab-content' style='display:none;'>
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
</div>
    <div id='quest' class='tab-content' style='display:none;'>
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
</div>
</body>
</html>

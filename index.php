<?php include "db.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <title>To-Do</title>
    <style>
        body { font-family: sans-serif; display: flex; justify-content: center; background: #f4f4f4; padding: 20px; }
        .container { background: white; padding: 20px; width: 450px; border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        .task { padding: 15px; margin: 10px 0; border-radius: 8px; display: flex; justify-content: space-between; color: white; font-weight: bold; }
        
        
        .high { background-color: #ff0000 !important; }    /* KIRMIZI */
        .medium { background-color: #ffa500 !important; }  /* TURUNCU */
        .low { background-color: #2ecc71 !important; }     /* YEŞİL */
    </style>
</head>
<body>
<div class="container">
    <h2>🚀 Görev Listesi</h2>
    <form action="add.php" method="POST">
        <input type="text" name="title" placeholder="Yeni görev..." required style="padding:8px;">
        <select name="priority" style="padding:8px;">
            <option value="3">Yüksek</option>
            <option value="2">Orta</option>
            <option value="1">Düşük</option>
        </select>
        <button type="submit" style="padding:8px;">Ekle</button>
    </form>
    <hr>
    <form method="GET" style="margin-bottom:15px;">

    <input type="text" name="search"
    placeholder="Görev ara..."
    style="padding:8px;"
    value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">

    <select name="filter" style="padding:8px;">
        <option value="">Hepsi</option>
        <option value="0">Tamamlanmayan</option>
        <option value="1">Tamamlanan</option>
    </select>

    <button type="submit" style="padding:8px;">Ara</button>

</form>
    <?php
    
    $sql = "SELECT * FROM tasks WHERE 1";

if(isset($_GET['search']) && $_GET['search'] != ''){
    $search = $_GET['search'];
    $sql .= " AND title LIKE '%$search%'";
}

if(isset($_GET['filter']) && $_GET['filter'] != ''){
    $filter = $_GET['filter'];
    $sql .= " AND status='$filter'";
}

$sql .= " ORDER BY priority DESC, id DESC";

$result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {

    $p = strtolower(trim($row['priority']));

    if ($p == '3' || $p == 'yüksek' || $p == 'yuksek' || $p == 'high') {
        $class = 'high';
        $emoji = '🔥';
    } elseif ($p == '2' || $p == 'orta' || $p == 'medium') {
        $class = 'medium';
        $emoji = '⏳';
    } else {
        $class = 'low';
        $emoji = '✅';
    }

    echo "<div class='task $class'>";

    echo "<span>" . $row['title'] . "</span>";

    echo "<span>
    <a href='update.php?id=".$row['id']."' style='color:white; margin-right:10px;'>Tamamla</a>

    <a href='delete.php?id=".$row['id']."' style='color:white;'>Sil</a>

    $emoji
    </span>";

    echo "</div>";
}
    ?>
</div>
</body>
</html>



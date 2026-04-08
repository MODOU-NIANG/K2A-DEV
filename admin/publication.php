<?php
include('config/app.php'); // inclure la connexion à la base de données
$stmt = $pdo->query("SELECT * FROM publications ORDER BY created_at DESC");

while ($row = $stmt->fetch()) {
    echo "<div class='publication'>";
    echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
    echo "<p>" . nl2br(htmlspecialchars($row['content'])) . "</p>";
    echo "<p><small>Publié le " . $row['created_at'] . "</small></p>";
    echo "</div>";
}
?>

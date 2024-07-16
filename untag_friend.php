<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $friend_id = $_POST['friend_id'];

    $stmt = $pdo->prepare('DELETE FROM friends WHERE user_id = ? AND friend_id = ?');
    $stmt->execute([$user_id, $friend_id]);

    header('Location: view_friends.php?user_id=' . $user_id);
    exit;
}


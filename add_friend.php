<?php
include 'db.php';

$user_id = $_GET['user_id'];
$users = $pdo->query('SELECT * FROM users WHERE id != ' . $pdo->quote($user_id))->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $friend_id = $_POST['friend_id'];

    $stmt = $pdo->prepare('INSERT INTO friends (user_id, friend_id) VALUES (?, ?)');
    $stmt->execute([$user_id, $friend_id]);

    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Friend</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="container mx-auto px-4 py-8">
    <div class="mb-4">
            <a href="index.php" class="text-blue-500 hover:underline">Back to Dashboard</a>
        </div>
        <h1 class="text-4xl font-bold mb-4 text-center">Add Friend</h1>
        <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
            <form method="POST" action="">
                <div class="mb-4">
                    <label for="friend_id" class="block text-gray-700 font-bold mb-2">Select Friend:</label>
                    <select name="friend_id" class="block w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" required>
                        <?php foreach ($users as $user): ?>
                            <option value="<?php echo $user['id']; ?>">
                                <?php echo htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="text-center">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add Friend</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

<?php
include 'db.php';

$user_id = $_GET['user_id'];
$stmt = $pdo->prepare('
    SELECT users.id, users.first_name, users.last_name, users.email 
    FROM friends 
    JOIN users ON friends.friend_id = users.id 
    WHERE friends.user_id = ?');
$stmt->execute([$user_id]);
$friends = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Friends</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold mb-4 text-center">Friends</h1>
        <div class="mb-4">
            <a href="index.php" class="text-blue-500 hover:underline">Back to Dashboard</a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="py-2 px-4 border-b border-gray-300">Full Name</th>
                        <th class="py-2 px-4 border-b border-gray-300">Email</th>
                        <th class="py-2 px-4 border-b border-gray-300">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($friends as $friend): ?>
                        <tr class="bg-gray-100 hover:bg-gray-200">
                            <td class="py-2 px-4 border-b border-gray-300"><?php echo htmlspecialchars($friend['first_name'] . ' ' . $friend['last_name']); ?></td>
                            <td class="py-2 px-4 border-b border-gray-300"><?php echo htmlspecialchars($friend['email']); ?></td>
                            <td class="py-2 px-4 border-b border-gray-300">
                                <form method="POST" action="untag_friend.php">
                                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                    <input type="hidden" name="friend_id" value="<?php echo $friend['id']; ?>">
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Untag as Friend</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

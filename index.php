<?php
include 'db.php';

$users = $pdo->query('SELECT * FROM users')->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Friends CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold mb-4 text-center">Friends CRUD</h1>
        <div class="mb-4 text-center">
            <a href="add_user.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add New User</a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="py-2 px-4 border-b border-gray-300">Full Name</th>
                        <th class="py-2 px-4 border-b border-gray-300">Email</th>
                        <th class="py-2 px-4 border-b border-gray-300">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr class="bg-gray-100 hover:bg-gray-200">
                            <td class="py-2 px-4 border-b border-gray-300"><?php echo htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); ?></td>
                            <td class="py-2 px-4 border-b border-gray-300"><?php echo htmlspecialchars($user['email']); ?></td>
                            <td class="py-2 px-4 border-b border-gray-300">
                                <a href="edit_user.php?user_id=<?php echo $user['id']; ?>" class="text-blue-500 hover:underline mr-2">Edit</a>
                                <a href="add_friend.php?user_id=<?php echo $user['id']; ?>" class="text-green-500 hover:underline mr-2">Add Friend</a>
                                <a href="view_friends.php?user_id=<?php echo $user['id']; ?>" class="text-yellow-500 hover:underline">View Friends</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

<?php
include 'db.php';

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];

    $stmt = $pdo->prepare('SELECT COUNT(*) FROM users WHERE email = ?');
    $stmt->execute([$email]);
    if ($stmt->fetchColumn() > 0) {
        $error_message = 'Email already exists!';
    } else {
        $stmt = $pdo->prepare('INSERT INTO users (first_name, last_name, email) VALUES (?, ?, ?)');
        $stmt->execute([$first_name, $last_name, $email]);
        header('Location: index.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add New User</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="container mx-auto px-4 py-8">
    <div class="mb-4">
            <a href="index.php" class="text-blue-500 hover:underline">Back to Dashboard</a>
        </div>
        <h1 class="text-4xl font-bold mb-4 text-center">Add New User</h1>
        <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
            <form method="POST" action="">
                <div class="mb-4">
                    <label for="first_name" class="block text-gray-700 font-bold mb-2">First Name:</label>
                    <input type="text" name="first_name" class="block w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" required>
                </div>
                <div class="mb-4">
                    <label for="last_name" class="block text-gray-700 font-bold mb-2">Last Name:</label>
                    <input type="text" name="last_name" class="block w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" required>
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-bold mb-2">Email:</label>
                    <input type="email" name="email" class="block w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" required>
                </div>
                <?php if (!empty($error_message)): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline"><?php echo $error_message; ?></span>
                </div>
                <?php endif; ?>
                <div class="text-center">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add User</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

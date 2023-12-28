<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My App</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto my-10 max-w-3xl">
        <header>
            <!-- Your header content here -->
        </header>

        <main>
            {{ $slot }}
        </main>

        <footer>
            <!-- Your footer content here -->
        </footer>
    </div>
</body>
</html>

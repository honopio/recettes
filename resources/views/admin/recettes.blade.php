<!DOCTYPE html>
<html>
<head>
    <title>Recipes List</title>
</head>
<body>
    <h1>Recipes List</h1>
    <ul>
        @foreach ($recipes as $recipe)
            <li>{{ $recipe->name }}</li>
        @endforeach
    </ul>
</body>
</html>

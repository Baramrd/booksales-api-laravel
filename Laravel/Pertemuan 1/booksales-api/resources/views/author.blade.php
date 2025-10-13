<!DOCTYPE html>
<html>
<head>
    <title>Author List</title>
</head>
<body>
    <h1>List of Authors</h1>
    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Nationality</th>
        </tr>
        @foreach ($authors as $author)
        <tr>
            <td>{{ $author['id'] }}</td>
            <td>{{ $author['name'] }}</td>
            <td>{{ $author['nationality'] }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>

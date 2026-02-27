<!DOCTYPE html>
<html>
<head>
    <title>All Routes</title>
</head>
<body>
    <h1>All Routes</h1>
    <table border="1">
        <thead>
            <tr>
                <th>URI</th>
                <th>Name</th>
                <th>Action</th>
                <th>Methods</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($routes as $route)
                <tr>
                    <td>{{ $route['uri'] }}</td>
                    <td>{{ $route['name'] }}</td>
                    <td>{{ $route['action'] }}</td>
                    <td>{{ implode(', ', $route['methods']) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

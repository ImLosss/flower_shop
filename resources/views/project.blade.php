<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h3>Projek: {{ $data->name }}</h3>
    <h4>Jumlah team: {{ $data->team->count() }}</h4>
    <h4>Manager: {{ $data->user->name }}</h4>
    <table border=1>
        <thead>
            <th>user_id</th>
            <th>name</th>
            <th>projek_id</th>
        </thead>
        <tbody>
            @foreach ($data->team as $team)
            <tr>
                <td>{{ $team->user_id }}  </td>
                <td>{{ $team->user->name }}</td>
                <td>{{ $team->project_id }}</td>
            </tr>  
            @endforeach
        </tbody>
    </table>
</body>
</html>
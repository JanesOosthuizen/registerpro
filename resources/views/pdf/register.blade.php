<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Register for {{ $className }}</h1>
    <table>
        <thead>
            <tr>
                <th>Key</th>
                <th>Class</th>
                <th>Subject</th>
                <th>Pupils</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $item['key'] }}</td>
                    <td>{{ $item['className'] }}</td>
                    <td>{{ $item['subjectName'] }}</td>
                    <td>{{ implode(', ', $item['pupilIds']) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

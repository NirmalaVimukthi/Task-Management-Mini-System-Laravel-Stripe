<!DOCTYPE html>
<html>
<head>
    <title>Task Complete Notification</title>
</head>
<body>
    <h1>Your Assgin Task has been Completed !</h1>

    <br>
    <table >
        <tr>
            <th>Task</th>
            <td> {{$data->title}}</td>
        </tr>
        <tr>
            <th>Description</th>
            <td> {{$data->description}}</td>
        </tr>
        <tr>
            <th>Due Date</th>
            <td> {{$data->due_date}}</td>
        </tr>
    </table>
</body>
</html>

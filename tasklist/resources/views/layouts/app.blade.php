<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Task List</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
            line-height: 1.6;
        }

        main {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
            border-bottom: 2px solid orange;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        h3 {
            color: #555;
            margin-bottom: 15px;
        }

        ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        li {
            margin-bottom: 15px;
            padding: 15px 20px;
            background: #fafafa;
            border-radius: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
        }

        .task-info {
            flex: 1;
        }

        .task-info h3 {
            margin: 0 0 8px 0;
            color: #333;
            font-size: 1.1em;
        }

        .task-info p {
            margin: 0 0 8px 0;
            color: #555;
            font-size: 0.95em;
        }

        .task-info small {
            color: #888;
            font-size: 0.85em;
        }

        .btn-task,
        .btn-back {
            display: inline-block;
            color: white;
            background-color: orange;
            border-radius: 5px;
            padding: 10px 25px;
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 500;
            text-align: center;
            white-space: nowrap;
        }

        .btn-task:hover,
        .btn-back:hover {
            opacity: 0.8;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(255, 165, 0, 0.3);
        }

        .btn-back {
            background-color: red;
        }
        .btn-back:hover {
            box-shadow: 0 4px 8px rgba(255, 0, 0, 0.3);
        }
    </style>
</head>

<body>
    <main></main>
    <h1>@yield('title')</h1>
    <div>@yield('content')</div>
    </main>
</body>

</html>

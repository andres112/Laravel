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

        .title-container {
            display: flex;
            align-items: center;
            gap: 15px;
            justify-content: space-between;
            border-bottom: 2px solid orange;
            padding-bottom: 10px;
            margin-bottom: 20px;
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

        .btn-primary,
        .btn-secondary,
        .btn-terciary {
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
            cursor: pointer;
        }

        .btn-primary:hover,
        .btn-secondary:hover,
        .btn-terciary:hover {
            opacity: 0.8;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(255, 165, 0, 0.3);
        }

        .btn-primary.completed {
            background-color: green;
        }

        .btn-secondary {
            background-color: blue;
        }
        .btn-secondary:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 255, 0.3);
        }

        .btn-terciary {
            background-color: red;
        }
        .btn-terciary:hover {
            box-shadow: 0 4px 8px rgba(255, 0, 0, 0.3);
        }
    </style>
</head>

<body>
    <main>
        <div class="title-container">@yield('title')</div>
        <div>@yield('content')</div>
    </main>
</body>

</html>

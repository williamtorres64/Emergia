<?php include("head.php") ?>
       <title>Admin Panel</title>
    <link rel="stylesheet" href="css/main.css">
    <style>
        .admin-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-top: 50px;
        }

        .reset-button {
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <h1>Admin</h1>
        <a class="btn-cancelar reset-button" href="/api/reset.php">Reset Banco de Dados</a>
    </div>
</body>
</html>


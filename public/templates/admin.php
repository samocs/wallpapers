<?php
declare(strict_types=1);
session_start();

/* Require login */
if (empty($_SESSION['admin']['id'])) {
    header('Location: login.php');
    exit;
}

/* DB connection (fill these in) */
$host = '127.0.0.1';
$db   = 'wallpapers_schema';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
]);

/* Load messages */
$stmt = $pdo->query(
        "SELECT id, name, email, subject, message, consent, created_at
     FROM contact_messages
     ORDER BY created_at DESC
     LIMIT 50"
);
$messages = $stmt->fetchAll();

function e(string $s): string {
    return htmlspecialchars($s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

$username = (string)($_SESSION['admin']['username'] ?? 'admin');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Admin Dashboard</title>
    <style>
        :root{
            --bg:#0f172a;
            --panel:#111827;
            --panel-2:#1f2937;
            --text:#e5e7eb;
            --muted:#9ca3af;
            --primary:#38bdf8;
            --danger:#ef4444;
            --success:#22c55e;
        }
        *{box-sizing:border-box}
        body{
            margin:0;
            font-family:system-ui,-apple-system,Segoe UI,Roboto,Ubuntu,Cantarell,"Helvetica Neue",Arial;
            background:var(--bg);
            color:var(--text);
        }
        .layout{
            display:grid;
            grid-template-columns:260px 1fr;
            min-height:100vh;
        }
        aside{
            background:var(--panel);
            padding:24px;
            border-right:1px solid #1f2937;
        }
        .brand{
            font-weight:700;
            font-size:20px;
            margin-bottom:24px;
        }
        .nav a{
            display:block;
            color:var(--text);
            text-decoration:none;
            padding:10px 12px;
            border-radius:8px;
            margin-bottom:6px;
        }
        .nav a.active,.nav a:hover{background:var(--panel-2)}
        main{padding:24px}
        .topbar{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:20px;
            gap:12px;
        }
        .tag{
            display:inline-block;
            padding:4px 8px;
            border-radius:999px;
            font-size:12px;
            background:#1e293b;
            color:var(--muted);
            margin-left:8px;
        }
        .actions{display:flex;gap:10px;align-items:center}
        .btn{
            border:0;
            padding:10px 14px;
            border-radius:8px;
            cursor:pointer;
            background:var(--primary);
            color:#0b1220;
            font-weight:600;
            text-decoration:none;
            display:inline-block;
        }
        .btn.secondary{background:#334155;color:var(--text)}
        .btn.danger{background:var(--danger);color:white}
        .card{
            background:var(--panel);
            padding:16px;
            border-radius:12px;
            border:1px solid #1f2937;
            margin-bottom:16px;
        }
        .card h3{margin:0 0 6px 0;font-size:14px;color:var(--muted)}
        .table-wrap{
            background:var(--panel);
            border:1px solid #1f2937;
            border-radius:12px;
            overflow:hidden;
        }
        table{width:100%;border-collapse:collapse}
        th,td{
            padding:12px 14px;
            border-bottom:1px solid #1f2937;
            text-align:left;
            font-size:14px;
            vertical-align:top;
        }
        th{color:var(--muted);font-weight:600}
        tr:hover{background:#0b1220}
        .small{color:var(--muted);font-size:12px;margin:6px 0 0}
        @media (max-width:900px){
            .layout{grid-template-columns:1fr}
            aside{display:none}
        }
    </style>
</head>
<body>
<div class="layout">
    <aside>
        <div class="brand">Admin Console</div>
        <nav class="nav">
            <a class="active" href="admin.php">Dashboard</a>
            <a href="#">Images (later)</a>
        </nav>
    </aside>

    <main>
        <div class="topbar">
            <div>
                <h2 style="margin:0 0 6px">Admin Dashboard <span class="tag"><?= e($username) ?></span></h2>
                <div class="tag">Contact messages</div>
            </div>
            <div class="actions">
                <a class="btn secondary" href="../../../skriptovacie%20jazyky/semestralna%20praca/public/index.php">View site</a>
                <a class="btn danger" href="logout.php">Logout</a>
            </div>
        </div>

        <div class="card">
            <h3>Contact submissions</h3>
            <p class="small">Showing latest 50 from <code>contact_messages</code></p>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Consent</th>
                    <th>Created</th>
                </tr>
                </thead>
                <tbody>
                <?php if (!$messages): ?>
                    <tr><td colspan="7">No messages found.</td></tr>
                <?php else: ?>
                    <?php foreach ($messages as $m): ?>
                        <tr>
                            <td><?= (int)$m['id'] ?></td>
                            <td><?= e((string)$m['name']) ?></td>
                            <td><?= e((string)$m['email']) ?></td>
                            <td><?= e((string)$m['subject']) ?></td>
                            <td><?= nl2br(e((string)$m['message'])) ?></td>
                            <td><?= ((int)$m['consent'] === 1) ? 'yes' : 'no' ?></td>
                            <td><?= e((string)$m['created_at']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="card" style="margin-top:16px">
            <h3>Image management</h3>
            <p class="small">Blank for now. Later connect to your <code>wallpapers</code> table.</p>
        </div>
    </main>
</div>
</body>
</html>
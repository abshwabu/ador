<?php
/**
 * Adorn Trading PLC - Shared Hosting Installer & Diagnostics Helper
 * 
 * SECURITY:
 * You must provide the secret key in the URL: ?key=adorn2026
 * (You can change $secretKey below to any custom password)
 * Delete this file immediately once deployment is complete!
 */

$secretKey = 'adorn2026';

// 1. Authentication check
$providedKey = $_GET['key'] ?? $_POST['key'] ?? '';
if ($providedKey !== $secretKey) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Adorn Shared Hosting Setup - Access Restricted</title>
        <style>
            body { font-family: system-ui, sans-serif; background: #0A1128; color: #fff; display: flex; align-items: center; justify-content: center; height: 100vh; margin: 0; }
            .card { background: #131d3d; padding: 2.5rem; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.5); width: 100%; max-width: 420px; text-align: center; }
            input { width: 100%; padding: 12px; border-radius: 6px; border: 1px solid #2e3e6b; background: #0b132b; color: #fff; box-sizing: border-box; margin: 15px 0; }
            button { width: 100%; padding: 12px; background: #c5a059; color: #0A1128; font-weight: bold; border: none; border-radius: 6px; cursor: pointer; }
            button:hover { background: #d8b26e; }
        </style>
    </head>
    <body>
        <div class="card">
            <h2>Adorn Hosting Helper</h2>
            <p style="color: #94a3b8; font-size: 14px;">Enter the setup secret key to manage this shared hosting environment.</p>
            <form method="GET">
                <input type="password" name="key" placeholder="Enter Secret Key (Default: adorn2026)" required autofocus>
                <button type="submit">Access Setup Panel</button>
            </form>
        </div>
    </body>
    </html>
    <?php
    exit;
}

// 2. Locate Laravel Root Directory
$baseDir = dirname(__DIR__);
if (!file_exists($baseDir . '/artisan') && file_exists(dirname($baseDir) . '/adorn/artisan')) {
    $baseDir = dirname($baseDir) . '/adorn';
} elseif (!file_exists($baseDir . '/artisan') && file_exists(dirname($baseDir) . '/artisan')) {
    $baseDir = dirname($baseDir);
}

$actionOutput = '';
$actionSuccess = null;

// 3. Handle Actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'delete_installer') {
        @unlink(__FILE__);
        echo "<script>alert('Setup helper script deleted successfully!'); window.location.href = '/';</script>";
        exit;
    }

    if (file_exists($baseDir . '/vendor/autoload.php')) {
        require $baseDir . '/vendor/autoload.php';
        $app = require_once $baseDir . '/bootstrap/app.php';
        $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
        $kernel->bootstrap();

        try {
            if ($action === 'migrate_seed') {
                \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
                $output1 = \Illuminate\Support\Facades\Artisan::output();
                \Illuminate\Support\Facades\Artisan::call('db:seed', ['--force' => true]);
                $output2 = \Illuminate\Support\Facades\Artisan::output();
                $actionOutput = $output1 . "\n" . $output2;
                $actionSuccess = true;
            } elseif ($action === 'storage_link') {
                $target = $baseDir . '/storage/app/public';
                $link = __DIR__ . '/storage';
                if (!file_exists($link)) {
                    if (function_exists('symlink') && @symlink($target, $link)) {
                        $actionOutput = "Symlink created successfully: $link -> $target";
                        $actionSuccess = true;
                    } else {
                        \Illuminate\Support\Facades\Artisan::call('storage:link');
                        $actionOutput = \Illuminate\Support\Facades\Artisan::output();
                        $actionSuccess = true;
                    }
                } else {
                    $actionOutput = "Storage link already exists at: $link";
                    $actionSuccess = true;
                }
            } elseif ($action === 'optimize') {
                \Illuminate\Support\Facades\Artisan::call('optimize:clear');
                $out1 = \Illuminate\Support\Facades\Artisan::output();
                \Illuminate\Support\Facades\Artisan::call('optimize');
                $out2 = \Illuminate\Support\Facades\Artisan::output();
                $actionOutput = $out1 . "\n" . $out2;
                $actionSuccess = true;
            } elseif ($action === 'clear_cache') {
                \Illuminate\Support\Facades\Artisan::call('optimize:clear');
                $actionOutput = \Illuminate\Support\Facades\Artisan::output();
                $actionSuccess = true;
            }
        } catch (\Throwable $e) {
            $actionOutput = 'Error: ' . $e->getMessage() . "\n" . $e->getTraceAsString();
            $actionSuccess = false;
        }
    } else {
        $actionOutput = "Error: vendor/autoload.php not found. Please upload vendor/ or run composer install.";
        $actionSuccess = false;
    }
}

// 4. Perform Health & Environment Checks
$phpVersion = PHP_VERSION;
$phpOk = version_compare($phpVersion, '8.2.0', '>=');

$requiredExtensions = ['pdo', 'mbstring', 'fileinfo', 'openssl', 'tokenizer', 'xml', 'ctype', 'json'];
$extResults = [];
foreach ($requiredExtensions as $ext) {
    $extResults[$ext] = extension_loaded($ext);
}

$storageWritable = is_writable($baseDir . '/storage');
$cacheWritable = is_writable($baseDir . '/bootstrap/cache');
$envExists = file_exists($baseDir . '/.env');
$symlinkExists = file_exists(__DIR__ . '/storage');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Adorn Trading PLC - Shared Hosting Setup Panel</title>
    <style>
        :root { --navy: #0A1128; --card: #131d3d; --gold: #c5a059; --text: #e2e8f0; --green: #10b981; --red: #ef4444; }
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; background: var(--navy); color: var(--text); padding: 2rem; margin: 0; line-height: 1.6; }
        .container { max-width: 900px; margin: 0 auto; }
        .header { display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid #23315a; padding-bottom: 1rem; margin-bottom: 2rem; }
        .badge { background: var(--gold); color: #000; font-weight: bold; padding: 4px 10px; border-radius: 4px; font-size: 12px; }
        .card { background: var(--card); border: 1px solid #23315a; border-radius: 8px; padding: 1.5rem; margin-bottom: 1.5rem; }
        h3 { margin-top: 0; color: #fff; border-bottom: 1px solid #23315a; padding-bottom: 0.5rem; }
        .grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1rem; }
        .check-item { display: flex; align-items: center; justify-content: space-between; background: #0c142c; padding: 10px 14px; border-radius: 6px; font-size: 14px; }
        .status-ok { color: var(--green); font-weight: bold; }
        .status-err { color: var(--red); font-weight: bold; }
        .btn { background: var(--gold); color: #0A1128; border: none; padding: 10px 18px; border-radius: 6px; font-weight: 600; cursor: pointer; text-decoration: none; display: inline-block; }
        .btn:hover { background: #d8b26e; }
        .btn-danger { background: var(--red); color: #fff; }
        .btn-danger:hover { background: #dc2626; }
        .btn-secondary { background: #23315a; color: #fff; }
        .btn-secondary:hover { background: #2f4073; }
        pre { background: #070c1e; padding: 1rem; border-radius: 6px; overflow-x: auto; font-family: monospace; font-size: 13px; color: #cbd5e1; }
        .actions-group { display: flex; flex-wrap: wrap; gap: 10px; margin-top: 1rem; }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <div>
            <h1 style="margin: 0; font-size: 24px; color: #fff;">Adorn Shared Hosting Setup Assistant</h1>
            <p style="margin: 4px 0 0 0; color: #94a3b8; font-size: 14px;">Environment diagnostics and one-click database/storage initialization</p>
        </div>
        <span class="badge">PHP <?= PHP_VERSION ?></span>
    </div>

    <?php if ($actionOutput): ?>
        <div class="card" style="border-left: 4px solid <?= $actionSuccess ? 'var(--green)' : 'var(--red)' ?>;">
            <h3>Action Output</h3>
            <pre><?= htmlspecialchars($actionOutput) ?></pre>
        </div>
    <?php endif; ?>

    <div class="card">
        <h3>Server & Environment Diagnostics</h3>
        <div class="grid">
            <div class="check-item">
                <span>PHP Version (&ge; 8.2)</span>
                <span class="<?= $phpOk ? 'status-ok' : 'status-err' ?>"><?= PHP_VERSION ?> <?= $phpOk ? '✓' : '✗' ?></span>
            </div>
            <div class="check-item">
                <span>.env File Detected</span>
                <span class="<?= $envExists ? 'status-ok' : 'status-err' ?>"><?= $envExists ? 'Found ✓' : 'Missing ✗' ?></span>
            </div>
            <div class="check-item">
                <span>storage/ Writable</span>
                <span class="<?= $storageWritable ? 'status-ok' : 'status-err' ?>"><?= $storageWritable ? 'Writable ✓' : 'Not Writable ✗' ?></span>
            </div>
            <div class="check-item">
                <span>bootstrap/cache/ Writable</span>
                <span class="<?= $cacheWritable ? 'status-ok' : 'status-err' ?>"><?= $cacheWritable ? 'Writable ✓' : 'Not Writable ✗' ?></span>
            </div>
            <div class="check-item">
                <span>public/storage Symlink</span>
                <span class="<?= $symlinkExists ? 'status-ok' : 'status-err' ?>"><?= $symlinkExists ? 'Linked ✓' : 'Unlinked ✗' ?></span>
            </div>
            <?php foreach ($extResults as $ext => $loaded): ?>
                <div class="check-item">
                    <span>ext-<?= $ext ?></span>
                    <span class="<?= $loaded ? 'status-ok' : 'status-err' ?>"><?= $loaded ? 'Loaded ✓' : 'Missing ✗' ?></span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="card">
        <h3>One-Click Execution Actions</h3>
        <p style="color: #94a3b8; font-size: 14px;">Click the buttons below to perform setup routines directly from your browser without needing SSH access:</p>
        
        <div class="actions-group">
            <form method="POST">
                <input type="hidden" name="key" value="<?= htmlspecialchars($secretKey) ?>">
                <input type="hidden" name="action" value="migrate_seed">
                <button type="submit" class="btn" onclick="return confirm('Run database migrations and seed default content?');">🌱 Run Migrations &amp; Seed Database</button>
            </form>

            <form method="POST">
                <input type="hidden" name="key" value="<?= htmlspecialchars($secretKey) ?>">
                <input type="hidden" name="action" value="storage_link">
                <button type="submit" class="btn btn-secondary">🔗 Link Public Storage</button>
            </form>

            <form method="POST">
                <input type="hidden" name="key" value="<?= htmlspecialchars($secretKey) ?>">
                <input type="hidden" name="action" value="optimize">
                <button type="submit" class="btn btn-secondary">⚡ Optimize &amp; Cache CPanel</button>
            </form>

            <form method="POST">
                <input type="hidden" name="key" value="<?= htmlspecialchars($secretKey) ?>">
                <input type="hidden" name="action" value="clear_cache">
                <button type="submit" class="btn btn-secondary">🧹 Clear Caches</button>
            </form>
        </div>
    </div>

    <div class="card" style="border: 1px solid #7f1d1d;">
        <h3 style="color: #f87171;">Security Self-Destruct</h3>
        <p style="color: #94a3b8; font-size: 14px;">Once your database is migrated and the site is working, delete this file so it cannot be run by unauthorized visitors.</p>
        <form method="POST">
            <input type="hidden" name="key" value="<?= htmlspecialchars($secretKey) ?>">
            <input type="hidden" name="action" value="delete_installer">
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to permanently delete this setup helper file?');">🗑️ Delete This Setup File (Self-Destruct)</button>
            <a href="/" target="_blank" class="btn" style="margin-left: 10px;">Go to Website ↗</a>
            <a href="/admin" target="_blank" class="btn btn-secondary" style="margin-left: 10px;">Go to Admin Panel ↗</a>
        </form>
    </div>
</div>
</body>
</html>

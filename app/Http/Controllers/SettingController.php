<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
{
    $files = Storage::disk('local')->files('laravel-backup');

    $backups = collect($files)->filter(function ($file) {
        return str_ends_with($file, ['.zip', '.sql', '.gz']);
    })->map(function ($file) {
        return [
            'path' => $file,
            'name' => basename($file),
            'size' => Storage::disk('local')->size($file),
            'last_modified' => Storage::disk('local')->lastModified($file),
        ];
    })->sortByDesc('last_modified');

    return view('admin.setting', compact('backups'));
}

public function download($filename)
{
    $path = 'laravel-backup/' . $filename;

    if (!Storage::disk('local')->exists($path)) {
        abort(404, 'File not found');
    }

    return Storage::disk('local')->download($path);
}

    public function runBackup()
    {
        Artisan::call('backup:run --only-db');

        return back()->with('success', 'Database berhasil di-backup.');
    }

    public function restore(Request $request)
    {
        $request->validate([
            'backup_file' => 'required|file|mimes:sql,txt',
        ]);

        $path = $request->file('backup_file')->storeAs('restore-temp', 'restore.sql');

        $db = env('DB_DATABASE');
        $user = env('DB_USERNAME');
        $pass = env('DB_PASSWORD');
        $host = env('DB_HOST');

        $command = "mysql -u {$user} -p{$pass} -h {$host} {$db} < " . storage_path('app/' . $path);

        exec($command, $output, $status);

        return back()->with(
            $status === 0 ? 'success' : 'error',
            $status === 0 ? 'Database berhasil di-restore.' : 'Restore gagal.'
        );
    }
}

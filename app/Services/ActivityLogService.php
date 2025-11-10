<?php

namespace App\Services;

use App\Models\ActivityLog;
use App\Constants\ActivityActions;
use Illuminate\Support\Facades\Auth;

class ActivityLogService
{
    /**
     * Create a new activity log
     *
     * @param string $action  One of ActivityActions constants
     * @param array $params   Optional parameters for description replacement, e.g. ['student' => 'John Doe']
     * @param string|null $userName Optional user name if no logged-in user (for public forms)
     * @param string|null $role Optional role override
     * @return ActivityLog
     */
    public static function log(string $action, array $params = [], ?string $userName = null, ?string $role = null)
    {
        // Determine user
        $user = Auth::user();

        $logUserId = $user ? $user->id : null;
        $logUserName = $user ? $user->name : $userName ?? 'Guest';
        $logRole = $role ?? ($user ? $user->role : 'student_form');

        // Build description from dictionary
        $descriptionTemplate = ActivityActions::$descriptions[$action] ?? $action;
        $description = $descriptionTemplate;

        foreach ($params as $key => $value) {
            $description = str_replace(":$key", $value, $description);
        }

        return ActivityLog::create([
            'user_id' => $logUserId,
            'user_name' => $logUserName,
            'role' => $logRole,
            'action' => $action,
            'description' => $description,
            'ip_address' => request()->ip(),
        ]);
    }
}

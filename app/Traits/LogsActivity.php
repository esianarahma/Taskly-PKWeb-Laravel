<?php

namespace App\Traits;

use App\Models\ActivityLog;

trait LogsActivity
{
    protected function logActivity(string $action, $model, ?string $description = null): void
    {
        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => $action,
            'model_type' => get_class($model),
            'model_id' => $model->id,
            'description' => $description ?? "{$action} pada " . class_basename($model) . " #{$model->id}",
            'ip_address' => request()->ip(),
        ]);
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        $totalTasks = Task::where('user_id', $userId)->count();
        $doneTasks = Task::where('user_id', $userId)->where('status', 'done')->count();
        $inProgressTasks = Task::where('user_id', $userId)->where('status', 'in_progress')->count();
        $overdueTasks = Task::where('user_id', $userId)
            ->where('status', '!=', 'done')
            ->where('due_date', '<', now())
            ->whereNotNull('due_date')
            ->count();

        $recentTasks = Task::where('user_id', $userId)
            ->with(['project', 'category'])
            ->latest()
            ->take(5)
            ->get();

        $totalProjects = Project::where('user_id', $userId)->count();
        $totalCategories = Category::where('user_id', $userId)->count();

        return view('dashboard', compact(
            'totalTasks',
            'doneTasks',
            'inProgressTasks',
            'overdueTasks',
            'recentTasks',
            'totalProjects',
            'totalCategories'
        ));
    }
}
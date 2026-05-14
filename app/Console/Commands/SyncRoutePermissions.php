<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;

class SyncRoutePermissions extends Command
{
    /**
     * Command signature
     */
    protected $signature = 'permissions:sync-routes 
                            {--cleanup : Remove permissions that no longer exist as routes}
                            {--dry-run : Preview changes without writing to database}';

    /**
     * Command description
     */
    protected $description = 'Enterprise route-to-permission synchronization';

    /**
     * Excluded route prefixes
     */
    protected array $excludedPrefixes = [
        'ignition.',
        'livewire.',
        'debugbar.',
        'sanctum.',
        'telescope.',
        'horizon.',
        'pulse.',
    ];

    /**
     * Excluded exact route names
     */
    protected array $excludedRoutes = [
        'login',
        'logout',
        'register',
        'password.request',
        'password.email',
        'password.reset',
        'password.update',
        'verification.send',
        'verification.verify',
        'verification.notice',
    ];

    /**
     * Allowed middleware
     */
    protected array $requiredMiddleware = [
        'auth',
    ];

    /**
     * Execute command
     */
    public function handle(): int
    {
        $this->info('Starting permission synchronization...');
        $this->newLine();

        $routes = Route::getRoutes();

        $processed = 0;
        $created = 0;
        $existing = 0;
        $skipped = 0;

        $validPermissions = [];

        foreach ($routes as $route) {

            $routeName = $route->getName();

            /**
             * Skip unnamed routes
             */
            if (blank($routeName)) {
                $skipped++;
                continue;
            }

            /**
             * Skip excluded exact route names
             */
            if (in_array($routeName, $this->excludedRoutes)) {
                $skipped++;
                continue;
            }

            /**
             * Skip excluded prefixes
             */
            foreach ($this->excludedPrefixes as $prefix) {
                if (Str::startsWith($routeName, $prefix)) {
                    $skipped++;
                    continue 2;
                }
            }

            /**
             * Middleware filtering
             */
            $middlewares = $route->gatherMiddleware();

            $hasRequiredMiddleware = collect($middlewares)
                ->contains(function ($middleware) {

                    foreach ($this->requiredMiddleware as $required) {
                        if (Str::contains($middleware, $required)) {
                            return true;
                        }
                    }

                    return false;
                });

            if (!$hasRequiredMiddleware) {
                $skipped++;
                continue;
            }

            /**
             * Normalize permission name
             */
            $permissionName = Str::lower(trim($routeName));

            $validPermissions[] = $permissionName;

            /**
             * Dry run mode
             */
            if ($this->option('dry-run')) {

                $exists = Permission::where('name', $permissionName)->exists();

                if ($exists) {
                    $this->line("EXISTS  : {$permissionName}");
                } else {
                    $this->line("CREATE  : {$permissionName}");
                }

                continue;
            }

            /**
             * Create permission if not exists
             */
            $permission = Permission::firstOrCreate([
                'name' => $permissionName,
                'guard_name' => 'web',
            ]);

            if ($permission->wasRecentlyCreated) {
                $created++;
                $this->info("CREATED : {$permissionName}");
            } else {
                $existing++;
            }

            $processed++;
        }

        /**
         * Cleanup old permissions
         */
        if ($this->option('cleanup') && !$this->option('dry-run')) {

            $deleted = Permission::query()
                ->whereNotIn('name', $validPermissions)
                ->where('guard_name', 'web')
                ->delete();

            $this->newLine();
            $this->warn("REMOVED : {$deleted} obsolete permissions");
        }

        $this->newLine();

        $this->table(
            ['Metric', 'Count'],
            [
                ['Processed', $processed],
                ['Created', $created],
                ['Existing', $existing],
                ['Skipped', $skipped],
            ]
        );

        $this->newLine();
        $this->info('Permission synchronization completed successfully.');

        return Command::SUCCESS;
    }
}
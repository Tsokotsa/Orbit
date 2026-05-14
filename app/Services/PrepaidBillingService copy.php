<?php

namespace App\Services;

use App\Models\Service;
use App\Models\PPBillingService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class PrepaidBillingService
{
    public function generateForPeriod(string $period): void
    {
        Log::info('[PrepaidBilling] Generating billing rows', [
            'period' => $period
        ]);

        $services = Service::where('is_prepaid', 'y')
            ->where('active', 'y')
            ->get();

        foreach ($services as $service) {

            $table = "client_service_{$service->table_identifier}";

            if (!Schema::hasTable($table)) {
                Log::warning('[PrepaidBilling] Table does not exist', [
                    'table' => $table,
                    'service_id' => $service->id,
                ]);
                continue;
            }

            $rows = DB::table($table)
                ->where('status', 'active')
                ->get();

            foreach ($rows as $row) {

                PPBillingService::firstOrCreate(
                    [
                        'service_table' => $table,
                        'service_row_id' => $row->id,
                        'billing_period' => $period,
                    ],
                    [
                        'client_id' => $row->client_id,
                        'service_id' => $service->id,
                        'amount' => $service->price,
                        'currency' => 'MZN',
                        'payment_status' => 'pending',
                        'amount_locked' => $service->amount_locked,
                    ]
                );
            }
        }

        Log::info('[PrepaidBilling] Generation completed', [
            'period' => $period
        ]);

        // Automatically export after generation
        $this->exportForPeriod($period, 'prepaid');
    }

    /**
     * Export billing data to structured storage path
     */
    // public function exportForPeriod(string $period, string $category = 'prepaid'): string
    // {
    //     Log::info('[PrepaidBilling] Export started', [
    //         'period' => $period,
    //         'category' => $category
    //     ]);

    //     // ✅ Safe date parsing
    //     $date = Carbon::createFromFormat('Y-m', $period);
    //     $year = $date->format('Y');
    //     $month = $date->format('m');

    //     // Directory structure
    //     $directory = "{$category}/{$year}/{$month}";
    //     $filename = "{$category}_billing_{$period}.csv";
    //     $relativePath = "{$directory}/{$filename}";
    //     $absolutePath = storage_path("app/{$relativePath}");

    //     // Ensure directory exists (Laravel way)
    //     Storage::disk('local')->makeDirectory($directory);

    //     // Open file
    //     $handle = fopen($absolutePath, 'w');

    //     // CSV Header
    //     fputcsv($handle, [
    //         'Billing ID',
    //         'Period',
    //         'Client ID',
    //         'Service ID',
    //         'Amount',
    //         'Amount Locked',
    //         'Currency',
    //         'Payment Status',
    //         'Partner Name',
    //         'Partner Email',
    //         'Partner Phone',
    //         'City',
    //         'Country'
    //     ]);

    //     DB::table('pp_billing_services as b')
    //         ->leftJoin('odoo_partners as p', 'b.client_id', '=', 'p.odoo_id')
    //         ->select(
    //             'b.id',
    //             'b.billing_period',
    //             'b.client_id',
    //             'b.service_id',
    //             'b.amount',
    //             'b.amount_locked',
    //             'b.currency',
    //             'b.payment_status',
    //             'p.name',
    //             'p.email',
    //             'p.phone',
    //             'p.city',
    //             'p.country'
    //         )
    //         ->where('b.billing_period', $period)
    //         ->orderBy('b.id')
    //         ->cursor() // memory safe
    //         ->each(function ($row) use ($handle) {

    //             fputcsv($handle, [
    //                 $row->id,
    //                 $row->billing_period,
    //                 $row->client_id,
    //                 $row->service_id,
    //                 $row->amount,
    //                 $row->amount_locked,
    //                 $row->currency,
    //                 $row->payment_status,
    //                 $row->name,
    //                 $row->email,
    //                 $row->phone,
    //                 $row->city,
    //                 $row->country,
    //             ]);
    //         });

    //     fclose($handle);

    //     Log::info('[PrepaidBilling] Export completed', [
    //         'file' => $absolutePath
    //     ]);

    //     return $absolutePath; // useful later for FTP job
    // }

    public function exportForPeriod(string $period, string $category = 'prepaid'): string
    {
        $start = microtime(true);

        Log::info('[PrepaidBilling] Export started', [
            'period' => $period,
            'category' => $category,
        ]);

        try {

            // ✅ Validate period format (YYYY-MM)
            if (!preg_match('/^\d{4}-\d{2}$/', $period)) {
                throw new \InvalidArgumentException("Invalid period format. Expected YYYY-MM.");
            }

            $date = Carbon::createFromFormat('Y-m', $period);
            $year = $date->format('Y');
            $month = $date->format('m');

            // Directory & file paths
            $directory = "{$category}/{$year}/{$month}";
            $filename = "{$category}_billing_{$period}.csv";
            $relativePath = "{$directory}/{$filename}";
            $absolutePath = storage_path("app/{$relativePath}");

            // ✅ Ensure directory exists
            if (!Storage::disk('local')->exists($directory)) {
                Storage::disk('local')->makeDirectory($directory);
                Log::info('[PrepaidBilling] Directory created', [
                    'directory' => $directory
                ]);
            }

            // ✅ Open file safely
            $handle = fopen($absolutePath, 'w');

            if (!$handle) {
                throw new \Exception("Unable to open file for writing: {$absolutePath}");
            }

            // CSV Header
            fputcsv($handle, [
                'Billing ID',
                'Period',
                'Client ID',
                'Service ID',
                'Amount',
                'Amount Locked',
                'Currency',
                'Payment Status',
                'Partner Name',
                'Partner Email',
                'Partner Phone',
                'City',
                'Country'
            ]);

            // ✅ Query Data
            $rows = DB::table('pp_billing_services as b')
                ->leftJoin('odoo_partners as p', 'b.client_id', '=', 'p.odoo_id')
                ->select(
                    'b.id',
                    'b.billing_period',
                    'b.client_id',
                    'b.service_id',
                    'b.amount',
                    'b.amount_locked',
                    'b.currency',
                    'b.payment_status',
                    'p.name',
                    'p.email',
                    'p.phone',
                    'p.city',
                    'p.country'
                )
                ->where('b.billing_period', $period)
                ->orderBy('b.id')
                ->get();

            $rowCount = 0;

            foreach ($rows as $row) {

                fputcsv($handle, [
                    $row->id,
                    $row->billing_period,
                    $row->client_id,
                    $row->service_id,
                    $row->amount,
                    $row->amount_locked,
                    $row->currency,
                    $row->payment_status,
                    $row->name,
                    $row->email,
                    $row->phone,
                    $row->city,
                    $row->country,
                ]);

                $rowCount++;
            }

            fclose($handle);

            $duration = round((microtime(true) - $start) * 1000, 2);

            Log::info('[PrepaidBilling] Export completed', [
                'file' => $absolutePath,
                'rows_exported' => $rowCount,
                'duration_ms' => $duration,
            ]);

            return $absolutePath;

        } catch (\Throwable $e) {

            Log::critical('[PrepaidBilling] Export failed', [
                'period' => $period,
                'error' => $e->getMessage(),
            ]);

            throw $e; // allow job retry
        }
    }

}

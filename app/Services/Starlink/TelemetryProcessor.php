<?php

namespace App\Services\Starlink;

use App\Models\StarlinkRouterUsage;
use App\Services\StarlinkService;
use Illuminate\Support\Facades\Log;

class TelemetryProcessor
{
    public function __construct(protected StarlinkService $starlinkService)
    {
    }

    public function pollAndProcess(?int $accountId = null): int
    {
        $count = 0;

        Log::info("Polling telemetry for account $accountId");

        $payload = [
            "includeRouters" => true,
            "includeUserTerminals" => true,
        ];

        $response = $this->starlinkService->request(
            'post',
            '/telemetry/query',
            $payload,
            $accountId,
            silent: true
        );

        $terminals = data_get($response, 'content.userTerminals', []);
        $routers = data_get($response, 'content.routers', []);

        if (empty($terminals)) {
            Log::info("No terminals for account $accountId");
            return 0;
        }

        foreach ($terminals as $terminalId => $terminal) {
            $router = collect($routers)->firstWhere('userTerminalId', $terminalId);

            StarlinkRouterUsage::updateOrCreate(
                ['user_terminal_id' => $terminalId],
                [
                    'router_id' => $router['routerId'] ?? null,
                    'recorded_at' => $terminal['timestamp'] ?? now(),
                    'last_seen' => now(),
                    'downlink_mbps' => $terminal['downlinkThroughputMbps'] ?? null,
                    'uplink_mbps' => $terminal['uplinkThroughputMbps'] ?? null,
                    'signal_quality' => $terminal['signalQuality'] ?? null,
                    'terminal_uptime' => $terminal['uptimeSeconds'] ?? null,
                    'terminal_sw' => $terminal['softwareVersion'] ?? null,
                    'obstruction_percent_time' => $terminal['obstructionPercentTime'] ?? null,
                    'internet_latency' => $router['internetPingLatencyMs'] ?? null,
                    'internet_drop' => $router['internetPingDropRate'] ?? null,
                    'pop_latency' => $router['popPingLatencyMs'] ?? null,
                    'pop_drop' => $router['popPingDropRate'] ?? null,
                    'dish_latency' => $router['dishPingLatencyMs'] ?? null,
                    'dish_drop' => $router['dishPingDropRate'] ?? null,
                    'router_uptime' => $router['uptimeSeconds'] ?? null,
                    'router_sw' => $router['softwareVersion'] ?? null,
                    'router_hw_version' => $router['hardwareVersion'] ?? null,
                    'clients' => $router['clients'] ?? null,
                    'clients_2ghz' => $router['clients2Ghz'] ?? null,
                    'clients_5ghz' => $router['clients5Ghz'] ?? null,
                    'clientsEthernet' => $router['clientsEthernet'] ?? null,
                    'clients_2ghz_rx_rate_avg' => $router['clients2GhzRxRateMbpsAvg'] ?? null,
                    'clients_2ghz_tx_rate_avg' => $router['clients2GhzTxRateMbpsAvg'] ?? null,
                    'clients_5ghz_rx_rate_avg' => $router['clients5GhzRxRateMbpsAvg'] ?? null,
                    'clients_5ghz_tx_rate_avg' => $router['clients5GhzTxRateMbpsAvg'] ?? null,
                    'wan_rx_bytes' => $router['wanRxBytes'] ?? null,
                    'wan_tx_bytes' => $router['wanTxBytes'] ?? null,
                ]
            );

            $count++;
        }

        Log::info("Updated $count terminals for account $accountId");

        return $count;
    }
}
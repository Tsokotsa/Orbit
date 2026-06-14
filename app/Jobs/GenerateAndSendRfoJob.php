<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GenerateAndSendRfoJob implements ShouldQueue
{
    use Dispatchable, Queueable, SerializesModels;

    public function __construct(
        public Rfo $rfo
    ) {
    }

    public function handle(): void
    {
        $rfo = Rfo::with([
            'preparer',
            'approver',
            'timelines'
        ])->find($this->rfo->id);

        $pdf = Pdf::loadView(
            'pdf.rfo',
            compact('rfo')
        );

        $path = 'rfos/' . $rfo->rfo_number . '.pdf';

        Storage::disk('public')->put(
            $path,
            $pdf->output()
        );

        Mail::to($rfo->preparer->email)
            ->send(
                new ApprovedRfoMail(
                    $rfo,
                    storage_path('app/public/' . $path)
                )
            );

        $rfo->update([
            'pdf_path' => $path,
            'pdf_sent_at' => now()
        ]);
    }
}

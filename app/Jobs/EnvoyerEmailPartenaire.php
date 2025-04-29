<?php

namespace App\Jobs;

use App\Models\Partenaire;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\Partenaires\PartenaireEmail;
use App\Models\EmailLog;

class EnvoyerEmailPartenaire implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;

    public function __construct(
        public Partenaire $partenaire,
        public string $message,
        public string $objet
    ) {}

    public function handle(): void
    {
        try {
            Mail::to($this->partenaire->email)->send(
                new PartenaireEmail($this->message, $this->objet)
            );

            EmailLog::create([
                'email' => $this->partenaire->email,
                'objet' => $this->objet,
                'message' => $this->message,
                'status' => 'sent',
            ]);
        } catch (\Throwable $e) {
            EmailLog::create([
                'email' => $this->partenaire->email,
                'objet' => $this->objet,
                'message' => $this->message,
                'status' => 'failed',
                'error' => $e->getMessage(),
            ]);
        }
    }
}

<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Redis;
use Illuminate\Broadcasting\InteractsWithSockets;

class UserStatusChanged implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $status;

    // Constructeur pour envoyer les données
    public function __construct($user, $status)
    {
        $this->user = $user;
        $this->status = $status;
    }

    // Diffuser l'événement sur un canal privé
    public function broadcastOn()
    {
        return new PrivateChannel('user.' . $this->user->id);
    }

    // Diffuser les données de statut
    public function broadcastWith()
    {
        return [
            'status' => $this->status,
        ];
    }

    // Méthode pour enregistrer le statut dans Redis
    public function updateStatusInRedis()
    {
        // Ajouter ou supprimer l'utilisateur de Redis en fonction de son statut
        if ($this->status == 'online') {
            Redis::set('user_status:' . $this->user->id, 'online');
        } else {
            Redis::del('user_status:' . $this->user->id); // Retirer l'utilisateur de Redis
        }
    }
}

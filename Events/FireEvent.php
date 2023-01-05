<?php

namespace Modules\Notifications\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FireEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(
        public ?string $title,
        public ?string $message,
        public ?string $icon,
        public ?string $image,
        public ?string $url,
        public ?string $type,
        public ?string $privacy,
        public ?string $provider,
        public ?string $model,
        public ?string $model_id
        public ?string $data
    ){}

    public function broadcastAs(): string
    {
        return 'notification';
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel
     */
    public function broadcastOn() :Channel
    {
        return new Channel('private.' . $this->model_id);
    }
}

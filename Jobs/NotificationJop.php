<?php

namespace Modules\Notifications\Jobs;

use App\Services\SapService;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\File;
use Modules\Notifications\Entities\NotificationsLogs;
use Modules\Notifications\Notifications\NotificationService;

class NotificationJop implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public ?string $title;
    public ?string $message;
    public ?string $icon;
    public ?string $url;
    public ?string $image;
    public ?string $type;
    public ?string $privacy;
    public ?string $model;
    public ?string $model_id;
    public ?string $provider;
    public ?object $user;
    public ?string $data;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($arrgs)
    {
        $this->title = $arrgs['title'];
        $this->message  = $arrgs['message'];
        $this->icon  = $arrgs['icon'];
        $this->url  = $arrgs['url'];
        $this->image  = $arrgs['image'];
        $this->type  = $arrgs['type'];
        $this->privacy  = $arrgs['privacy'];
        $this->model  = $arrgs['model'];
        $this->model_id  = $arrgs['model_id'];
        $this->provider  = $arrgs['provider'];
        $this->data  = $arrgs['data'];
        $user = $this->model::find($this->model_id);
        $this->user = $user;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->provider === 'fcm-api' || $this->provider === 'fcm-web') {
            $this->user->fcm = $this->provider;
            $this->user->fcmId = $this->user->id;
        } else {
            $this->user->fcm = "fcm-api";
            $this->user->fcmId = $this->user->id;
        }

        $this->user->notify(new NotificationService(
            $this->title,
            $this->message,
            $this->icon,
            (string)$this->image,
            $this->url,
            $this->type,
            $this->privacy,
            $this->provider,
            $this->model,
            (string)$this->model_id,
            null,null,$this->data
        ));

        $log = new NotificationsLogs();
        $log->title = $this->title;
        $log->description = $this->message;
        $log->model_type = $this->model;
        $log->model_id = $this->model_id;
        $log->provider = $this->provider;
        $log->type = $this->type;
        $log->save();
    }
}

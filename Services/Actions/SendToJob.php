<?php

namespace Modules\Notifications\Services\Actions;

use Modules\Notifications\Jobs\NotificationJop;

trait SendToJob
{
    /**
     * @return void
     * Use To send the notification to the job
     */
    public function sendToJob():void
    {
        foreach ($this->providers as $provider) {
            if(is_array($provider)){
                $provider = $provider['id'];
            }
            $arrgs = [
                "title" => $this->title,
                "message" => $this->message,
                "icon" => $this->icon,
                "image" => $this->image,
                "url" => $this->url,
                "type" => $this->type,
                "privacy" => $this->privacy,
                "provider" => $provider,
                "model" => $this->model,
                "model_id" => $this->user->id,
                "data" => $this->data
            ];

            if (!empty($this->template)) {
                $collectRoles = [];
                foreach ($this->templateModel->roles as $role) {
                    $collectRoles[] = $role->id;
                }
                if (count($collectRoles)) {
                    if ($this->user->hasRole($collectRoles)) {
                        if($provider === 'socket'){
                            \Modules\Notifications\Events\FireEvent::dispatch(
                                $this->title,
                                $this->message,
                                $this->icon,
                                $this->image,
                                $this->url,
                                $this->type,
                                $this->privacy,
                                $provider,
                                $this->model,
                                $this->user->id,
                                $this->data
                            );
                        }
                        else {
                            NotificationJop::dispatch($arrgs);
                        }

                    }
                } else {
                    if($provider === 'socket'){
                        \Modules\Notifications\Events\FireEvent::dispatch(
                            $this->title,
                            $this->message,
                            $this->icon,
                            $this->image,
                            $this->url,
                            $this->type,
                            $this->privacy,
                            $provider,
                            $this->model,
                            $this->user->id,
                            $this->data
                        );
                    }
                    else {
                        NotificationJop::dispatch($arrgs);
                    }
                }
            } else {
                if($provider === 'socket'){
                    \Modules\Notifications\Events\FireEvent::dispatch(
                        $this->title,
                        $this->message,
                        $this->icon,
                        $this->image,
                        $this->url,
                        $this->type,
                        $this->privacy,
                        $provider,
                        $this->model,
                        $this->user->id,
                        $this->data

                    );
                }
                else {
                    NotificationJop::dispatch($arrgs);
                }
            }
        }
    }
}

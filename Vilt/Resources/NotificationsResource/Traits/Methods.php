<?php

namespace Modules\Notifications\Vilt\Resources\NotificationsResource\Traits;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Base\Services\Components\Base\Alert;
use Modules\Notifications\Entities\NotifiactionsTemplates;
use Modules\Notifications\Services\SendNotification;

trait Methods
{
    public function afterIndex(LengthAwarePaginator $data,Request $request): void
    {
        $data->map(function ($item){
            if ($item->model_id && $item->model_type) {
                $item->model_id = $item->model_type->id::find($item->model_id->id);
            } else {
                $item->model_id = [
                    "name" => __('Public'),
                    "id" => "public"
                ];
            }
        });
    }

    public function beforeStore(Request $request): Request
    {
        $template = NotifiactionsTemplates::find($request->get('template_id'));

        $providers = [];
        foreach($template->providers as $provider) {
            $providers[] = $provider['id'];
        }


        $request->request->add(["title"=> $template->title]);
        $request->request->add(["body"=> $template->body]);
        $request->request->add(["privacy"=> $request->get('privacy')]);
        $request->request->add(["model_id"=> $request->get('model_id')]);
        $request->request->add(["icon"=> $template->icon]);
        $request->request->add(["url"=> $template->url]);

        SendNotification::make($providers)
            ->title($template->title)
            ->template($template->key)
            ->database(false)
            ->privacy($request->get('privacy'))
            ->model($request->get('model_type'))
            ->id($request->get('model_id'))
            ->fire();


        return $request;
    }
}

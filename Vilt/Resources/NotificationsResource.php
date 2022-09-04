<?php

namespace Modules\Notifications\Vilt\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Base\Services\Resource\Resource;
use Modules\Base\Services\Rows\Date;
use Modules\Base\Services\Rows\HasOne;
use Modules\Base\Services\Rows\Option;
use Modules\Base\Services\Rows\Select;
use Modules\Base\Services\Rows\Text;
use Modules\Notifications\Entities\NotifiactionsTemplates;
use Modules\Notifications\Entities\UserNotification;
use Modules\Notifications\Helpers\SendNotification;

class NotificationsResource extends Resource
{
    public ?string $model = UserNotification::class;
    public string $icon = "bx bxs-bell";
    public string $group = "Notifications";
    public ?bool $import = false;

    public function rows(): array
    {
        $this->canEdit = false;

        return [
            Text::make('id')->label(__('ID'))->create(false)->edit(false),
            Select::make('template_id')->label(__('Template'))->validation("required|array")->options(NotifiactionsTemplates::where('action', 'manual')->get()->toArray())->trackByName('name'),
            Select::make('privacy')->label(__('Privacy'))->validation("required|array")->options([
                Option::make(__('Public'))->id('public'),
                Option::make(__('Private'))->id('private'),
            ]),
            Select::make('model_type')->label(__('Type'))->validation("required|array")->view(false)->list(false)->options([
                Option::make(__('User'))->id(User::class)
            ]),
            HasOne::make('model_id')->label(__('User'))->validation("nullable|array")->reactive("private")->reactiveRow('privacy')->model(User::class)->relation('model'),
            Date::make('created_at')->label(__('Date'))->create(false)->edit(false)->type('datetime')->options([])
        ];
    }

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

        SendNotification::make($template->title)
            ->template($template->key)
            ->database(false)
            ->privacy($request->get('privacy'))
            ->model($request->get('model_type'))
            ->model_id($request->get('model_id'))
            ->provider($providers)
            ->send();


        return $request;
    }
}

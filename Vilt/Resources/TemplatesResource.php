<?php

namespace Modules\Notifications\Vilt\Resources;

use Illuminate\Http\Request;
use Modules\Base\Services\Resource\Resource;
use Modules\Base\Services\Rows\Icon;
use Modules\Base\Services\Rows\Media;
use Modules\Base\Services\Rows\Relation;
use Modules\Base\Services\Rows\Schema;
use Modules\Base\Services\Rows\Select;
use Modules\Base\Services\Rows\Text;
use Modules\Notifications\Entities\NotifiactionsTemplates;
use Modules\Notifications\Vilt\Resources\TemplatesResource\Traits\Components;
use Modules\Notifications\Vilt\Resources\TemplatesResource\Traits\Methods;
use Modules\Notifications\Vilt\Resources\TemplatesResource\Traits\Translations;
use Spatie\Permission\Models\Role;

class TemplatesResource extends Resource
{
    use Methods;
    use Components;
    use Translations;

    public ?string $model = NotifiactionsTemplates::class;
    public string $icon = "bx bxs-notification";
    public string $group = "Notifications";
    public ?bool $menu = false;

    public function rows(): array
    {
        $getLocals = config('translations.locals');
        $loadLocals = [];
        foreach ($getLocals as $key => $value) {
            $loadLocals[] = Text::make($key)->label($value);
        }

        return [
            Text::make('id')->label(__('Id'))->create(false)->edit(false),
            Media::make('image')->label(__('Image')),
            Text::make('name')->label(__('Name'))->validation([
                "create" => "required|string|max:255",
                "update" => "required|string|max:255"
            ]),
            Text::make('key')
                ->label(__('Key'))
                ->badge()
                ->color('primary')
                ->validation([
                    "create" => "required|string",
                    "update" => "required|string"
                ])
                ->unique(true)
                ->hint(__('Key must be unique because you can use it on your system')),
            Schema::make('title')->label(__('Title'))->options($loadLocals)->validation([
                "create" => "required|array",
                "update" => "required|array"
            ])->list(false),
            Schema::make('body')->label(__('Body'))->options($loadLocals)->validation([
                "create" => "required|array",
                "update" => "required|array"
            ])->list(false),
            Text::make('url')
                ->url()
                ->label(__('Url'))
                ->validation([
                    "create" => "nullable|string",
                    "update" => "nullable|string",
                ]),
            Icon::make('icon')->label(__('Icon'))->validation([
                "create" => "nullable|string",
                "update" => "nullable|string",
            ])->list(false),
            Select::make('type')->label(__('Type'))->validation([
                "create" => "required|array",
                "update" => "required|array",
            ])->list(false)->options(config('notifications.types'))->trackByName('name')->trackById('id'),
            Select::make('action')->label(__('Action By'))->validation([
                "create" => "required|array",
                "update" => "required|array",
            ])->list(false)->options([
                [
                    "name" => __('System'),
                    "id" => "system"
                ],
                [
                    "name" => __('Manual'),
                    "id" => "manual"
                ]
            ])->trackByName('name')->trackById('id'),
            Select::make('providers')->label(__('Providers'))->validation([
                "create" => "required|array",
                "update" => "required|array",
            ])->list(false)->multi(true)->options(config('notifications.providers'))->trackByName('name')->trackById('id'),
            Relation::make('roles')->label(__('Roles'))->validation([
                "create" => "nullable|array",
                "update" => "nullable|array"
            ])->list(false)->type('relation')->multi(true)->model(Role::class)->relation('roles'),
        ];
    }


}

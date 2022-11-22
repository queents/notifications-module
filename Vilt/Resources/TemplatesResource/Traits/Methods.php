<?php

namespace Modules\Notifications\Vilt\Resources\TemplatesResource\Traits;

use App\Models\User;
use Illuminate\Http\Request;
use Modules\Base\Services\Components\Base\Alert;
use Modules\Notifications\Entities\NotifiactionsTemplates;
use Modules\Notifications\Services\SendNotification;

trait Methods
{
    public function afterStore(Request $request, $record): void
    {
        if ($request->has('roles')) {
            foreach ($request->get('roles') as $role) {
                $record->roles()->attach($role['id']);
            }
        }
    }

    public function afterUpdate(Request $request, $record): void
    {
        $roles = [];

        if ($request->has('roles')) {
            foreach ($request->get('roles') as $role) {
                $roles[] = $role['id'];
            }
        }

        $record->roles()->sync($roles);
    }

    public function send(Request $request){
        $request->validate([
            "id" => "required"
        ]);

        $template = NotifiactionsTemplates::find($request->id);
        if($template){
            $matchesTitle = array();
            preg_match('/{.*?}/', $template->title, $matchesTitle);
            $titleFill = [];
            foreach($matchesTitle as $titleItem){
                $titleFill[] = "test-title";
            }
            $matchesBody = array();
            preg_match('/{.*?}/', $template->body, $matchesBody);
            $titleBody = [];
            foreach($matchesBody as $bodyItem){
                $titleBody[] = "test-body";
            }

            SendNotification::make($template->providers)
                ->template($template->key)
                ->findTitle($matchesTitle)
                ->replaceTitle($titleFill)
                ->findBody($matchesBody)
                ->replaceBody($titleBody)
                ->model(User::class)
                ->id(User::first()->id)
                ->privacy('private')
                ->fire();

            return Alert::make(__('Your Template Has Been Send success'))->fire();

        }
        else {
            return Alert::make(__('Sorry Template Not Found!'))->type('error')->fire();
        }
    }
}

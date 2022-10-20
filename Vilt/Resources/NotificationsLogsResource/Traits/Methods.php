<?php

namespace Modules\Notifications\Vilt\Resources\NotificationsLogsResource\Traits;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

trait Methods
{
    public function afterIndex(LengthAwarePaginator $data,Request $request): void
    {
        $data->map(function ($item){
            if ($item->model_id && $item->model_type) {
                $item->model_id = $item->model_type::find($item->model_id);
            } else {
                $item->model_id = [
                    "name" => __('Public'),
                    "id" => "public"
                ];
            }

            return $item;
        });
    }
}

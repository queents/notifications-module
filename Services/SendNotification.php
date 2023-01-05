<?php

namespace Modules\Notifications\Services;

use Modules\Notifications\Entities\NotifiactionsTemplates;
use Modules\Notifications\Entities\UserNotification;
use Modules\Notifications\Jobs\NotificationJop;
use Modules\Notifications\Services\Actions\FireEvent;
use Modules\Notifications\Services\Actions\LoadTemplate;
use Modules\Notifications\Services\Actions\SendToDatabase;
use Modules\Notifications\Services\Actions\SendToJob;
use Modules\Notifications\Services\Concerns\HasCreatedBy;
use Modules\Notifications\Services\Concerns\HasData;
use Modules\Notifications\Services\Concerns\HasFindBody;
use Modules\Notifications\Services\Concerns\HasFindTitle;
use Modules\Notifications\Services\Concerns\HasIcon;
use Modules\Notifications\Services\Concerns\HasId;
use Modules\Notifications\Services\Concerns\HasImage;
use Modules\Notifications\Services\Concerns\HasLang;
use Modules\Notifications\Services\Concerns\HasMessage;
use Modules\Notifications\Services\Concerns\HasModel;
use Modules\Notifications\Services\Concerns\HasPrivacy;
use Modules\Notifications\Services\Concerns\HasProviders;
use Modules\Notifications\Services\Concerns\HasReplaceBody;
use Modules\Notifications\Services\Concerns\HasReplaceTitle;
use Modules\Notifications\Services\Concerns\HasTemplate;
use Modules\Notifications\Services\Concerns\HasTemplateModel;
use Modules\Notifications\Services\Concerns\HasTitle;
use Modules\Notifications\Services\Concerns\HasType;
use Modules\Notifications\Services\Concerns\HasUrl;
use Modules\Notifications\Services\Concerns\HasUser;
use Modules\Notifications\Services\Concerns\IsDatabase;

class SendNotification
{
    use HasTitle;
    use HasMessage;
    use HasType;
    use HasProviders;
    use HasPrivacy;
    use HasUrl;
    use HasImage;
    use HasIcon;
    use HasModel;
    use HasTemplate;
    use HasFindTitle;
    use HasFindBody;
    use HasReplaceTitle;
    use HasReplaceBody;
    use HasId;
    use HasCreatedBy;
    use HasUser;
    use HasLang;
    use HasTemplateModel;
    use IsDatabase;
    use HasData;

    /*
     * Actions
     */
    use FireEvent;
    use LoadTemplate;
    use SendToDatabase;
    use SendToJob;

    /**
     * @param ?array $providers
     * @return static
     */
    public static function make(?array $providers): static
    {
        return (new static)->providers($providers);
    }
}

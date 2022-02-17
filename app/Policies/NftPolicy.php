<?php

namespace App\Policies;

use App\Models\Nft;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class NftPolicy
{
    use HandlesAuthorization;

    public function uploadFile()
    {
        
    }

    public function publish(User $user, Nft $nft)
    {
        return $user->id === $nft->user_id
            && $nft->hasFileUploaded()
            && $nft->hasMetadataUploaded();
    }
}

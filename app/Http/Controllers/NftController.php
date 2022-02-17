<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNftRequest;
use App\Http\Resources\NftCollection;
use App\Http\Resources\NftResource;
use App\Models\Nft;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class NftController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();

        return new NftCollection($user->nfts);
    }

    public function store(StoreNftRequest $request)
    {
        $requestData = $request->validated();

        $nft = Nft::query()
            ->create([
                'user_id' => Auth::id(),
                'status' => Nft::STATUS_CREATED,
            ]);

        if ($nft->attachFile($requestData['file'])) {
            $nft->update([
                'status' => Nft::STATUS_IMAGE_UPLOADED,
                'file_url' => $nft->file->url,
            ]);
        }

        return new NftResource($nft->load('file'));
    }

    public function show(Nft $nft)
    {
        return new NftResource($nft->load('file', 'metadata'));
    }

    public function publish(Nft $nft)
    {
        $this->authorize('publish',  $nft);

        return new NftResource($nft->load('metadata'));
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class Nft extends Model
{
    use HasFactory;

    const STATUS_CREATED = 1;
    const STATUS_IMAGE_UPLOADED = 2;
    const STATUS_METADATA_UPLOADED = 3;
    const STATUS_PUBLISHED = 4;

    protected $table = 'nfts';

    protected $fillable = [
        'user_id',
        'status',
        'metadata_url',
        'file_url',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * @return HasOne
     */
    public function metadata(): HasOne
    {
        return $this->hasOne(Metadata::class, 'nft_id', 'id');
    }

    /**
     * @return HasOne
     */
    public function file(): HasOne
    {
        return $this->hasOne(File::class, 'nft_id', 'id');
    }

    /**
     * @return bool
     */
    public function hasFileUploaded(): bool
    {
        return $this->file_url !== null && !!$this->file;
    }

    /**
     * @return bool
     */
    public function hasMetadataUploaded(): bool
    {
        return $this->metadata_url !== null && !!$this->metadata;
    }

    /**
     * @param UploadedFile $file
     * @return bool
     */
    public function attachFile(UploadedFile $file):  bool
    {
        $path = Storage::disk('public')->putFile(File::STORAGE_FOLDER, $file);

        if (!$path) {
            return false;
        }

        $this->file()->create([
            'name' => $file->getClientOriginalName(),
            'size' => $file->getSize(),
            'mime_type' => $file->getMimeType(),
            'path' => $path,
        ]);

        return true;
    }
}

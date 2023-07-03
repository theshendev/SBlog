<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->title,
            'content' => $this->content,
            'comments' => $this->comments->map(function ($comment) {
                return [
                    'username' => $comment->user->username,
                    'text' => $comment->text,
                ];
            }),
            'username' => $this->user->username,
        ];
    }
}

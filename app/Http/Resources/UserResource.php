<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\User */
class UserResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'mobile' => $this->mobile,
            'email' => $this->email,
            'password' => $this->password,
            'last_login' => $this->last_login,
            'intro' => $this->intro,
            'profile' => $this->profile,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

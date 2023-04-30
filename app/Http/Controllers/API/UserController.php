<?php

namespace App\Http\Controllers\API;

use App\Models\User;

class UserController {
    public function user_detail($id) {
        $user = User::find($id);
        return json_encode([
            'user' => $user
        ]);
    }
}
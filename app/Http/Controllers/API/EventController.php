<?php

namespace App\Http\Controllers\API;

use App\Models\Category;
use App\Models\CategoryEvent;
use App\Models\Event;
use App\Models\Poster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController {
    public function event_detail($id) {
        $event = Event::find($id);
        $posters = $event->posters()->get();
        $categories = $event->categories()->get();
        return json_encode([
            'event' => $event,
            'posters' => $posters,
            'categories' => $categories
        ]);
    }
}
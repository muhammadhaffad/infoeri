<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryEvent;
use App\Models\Event;
use App\Models\Poster;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminEventController extends Controller
{
    public function update_event(Request $request)
    {
        $event = Event::find($request->event_id);

        $event->title = $request->event_title;
        $event->descriptioin = $request->event_description;
        $event->eventstart = $request->event_start_date . ' ' . $request->event_start_time;
        $event->eventend = $request->event_end_date . ' ' . $request->event_end_time;
        $event->link = $request->link;
        $event->contact = $request->contact;
        $event->address = $request->address;
        $event->save();
        $event_id = $event->id;

        $categories = $request->event_categories;
        $categories_event = new CategoryEvent;
        $categories_event = $categories_event->where('event_id', $event_id)->get();
        $length = max([count($categories), count($categories_event)]);
        for ($i = 0; $i < $length; $i++) {
            if (isset($categories_event[$i])) {
                if (isset($categories[$i])) {
                    $categories_event[$i]->category_id = $categories[$i];
                    $categories_event[$i]->save();
                } else {
                    $categories_event[$i]->delete();
                }
            } else {
                $category_event = new CategoryEvent;
                $category_event->event_id = $event_id;
                $category_event->category_id = $categories[$i];
                $category_event->save();
            }
        }

        $posters = $event->posters()->get();
        if (@$request->poster != null) {
            $image = $request->poster;
            $imageName = time() . '.' . $image->extension();
            $image->storeAs('public', $imageName);
            $posters[0]->poster = $imageName;
            $posters[0]->event_id = $event_id;
            $posters[0]->save();
        }
        for ($i = 0; $i < 5; $i++) {
            if (@$request->image[$i] != null && isset($posters[$i + 1])) {
                $image = $request->file('image')[$i];
                $imageName = time() . '.' . $image->extension();
                $image->storeAs('public', $imageName);
                $posters[$i + 1]->poster = $imageName;
                $posters[$i + 1]->event_id = $event_id;
                $posters[$i + 1]->save();
            }
        }
        return back();
    }

    public function view_event(Request $request) {
        $events = new Event;
        return view('admin.event')->with('events', $events);
    }

    public function delete_event(Request $request) {
        $event = Event::find($request->event_id);
        $event->delete();
        return back();
    }

    public function update_category(Request $request) {
        $request->validate([
            'category_id' => 'required',
            'category_name' => 'required|max:20'
        ]);
        $category = Category::find($request->category_id);
        $category->name = $request->category_name;
        $category->save();
        return back();
    }

    public function create_category(Request $request) {
        $request->validate([
            'category_name' => 'required|max:20'
        ]);
        $category = new Category;
        $category->name = $request->category_name;
        $category->save();
        return back();
    }

    public function delete_category(Request $request) {
        $request->validate([
            'category_id' => 'required',
        ]);
        $category = Category::find($request->category_id);
        $category->delete();
        return back();
    }

    public function test(Request $request)
    {
        if ($request->isMethod('post')) {
            $event = Event::find(1);

            $event->title = $request->event_title;
            $event->descriptioin = $request->event_description;
            $event->eventstart = $request->event_start_date . ' ' . $request->event_start_time;
            $event->eventend = $request->event_end_date . ' ' . $request->event_end_time;
            $event->link = $request->link;
            $event->contact = $request->contact;
            $event->address = $request->address;
            $event->save();
            $event_id = $event->id;

            $categories = $request->event_categories;
            $categories_event = new CategoryEvent;
            $categories_event = $categories_event->where('event_id', $event_id)->get();
            $length = max([count($categories), count($categories_event)]);
            for ($i = 0; $i < $length; $i++) {
                if (isset($categories_event[$i])) {
                    if (isset($categories[$i])) {
                        $categories_event[$i]->category_id = $categories[$i];
                        $categories_event[$i]->save();
                    } else {
                        $categories_event[$i]->delete();
                    }
                } else {
                    $category_event = new CategoryEvent;
                    $category_event->event_id = $event_id;
                    $category_event->category_id = $categories[$i];
                    $category_event->save();
                }
            }

            $posters = $event->posters()->get();
            if (@$request->poster != null) {
                $image = $request->poster;
                $imageName = time() . '.' . $image->extension();
                $image->storeAs('public', $imageName);
                $posters[0]->poster = $imageName;
                $posters[0]->event_id = $event_id;
                $posters[0]->save();
            }
            for ($i = 0; $i < 5; $i++) {
                if (@$request->image[$i] != null && isset($posters[$i + 1])) {
                    $image = $request->file('image')[$i];
                    $imageName = time() . '.' . $image->extension();
                    $image->storeAs('public', $imageName);
                    $posters[$i + 1]->poster = $imageName;
                    $posters[$i + 1]->event_id = $event_id;
                    $posters[$i + 1]->save();
                }
            }
            return back();
        } else {
            return view('admin.event');
        }
    }
}

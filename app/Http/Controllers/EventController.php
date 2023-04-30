<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryEvent;
use App\Models\Event;
use App\Models\Poster;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function create_event(Request $request)
    {
        if ($request->isMethod('post')) {

            $request->validate(
                [
                    'event_title' => 'required',
                    'event_description' => 'required',
                    'event_type' => 'required|integer|between:1,2',
                    'event_categories' => 'required',
                    'event_start_date' => 'required|date_format:Y-m-d',
                    'event_start_time' => 'required|date_format:H:i',
                    'event_end_date' => 'required|date_format:Y-m-d',
                    'event_end_time' => 'required|date_format:H:i',
                    'link' => 'required',
                    'contact' => 'required',
                    'address' => 'required',
                    'images' => 'required',
                    'images.*' => 'mimes:jpeg,jpg,png|max:2048',
                ]
            );

            $event = new Event;
            $event->user_id = Auth::user()->id;
            $event->type_id = $request->event_type;
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
            foreach ($categories as $key => $category) {
                $category_event = new CategoryEvent;
                $category_event->event_id = $event_id;
                $category_event->category_id = $category;
                $category_event->save();
            }

            $images = $request->images;
            foreach ($images as $key => $image) {
                $poster = new Poster;
                $imageName = time() . '.' . $image->extension();
                $image->storeAs('public', $imageName);
                $poster->poster = $imageName;
                $poster->event_id = $event_id;
                $poster->save();
            }

            /* Store $imageName name in DATABASE from HERE */
            return back()->with('success', 'Event berhasil dibuat!');
        }
        return view('add-post');
    }

    public function view_event($id)
    {
        $events = new Event;
        $event = $events->find($id);
        return view('detail-event')->with('event', $event);
    }

    public function view_categories_event(Request $request)
    {
        $category_event = new Event;
        if (isset($request->category)) {
            $category = Category::whereIn('name', $request->category);
            $category_event = $category_event->categories_event($category->pluck('id')->toArray());
        }
        if ($request->search != null) {
            $category_event = $category_event->where('title', 'like', '%' . $request->search . '%');
        }
        $category_event = $category_event->paginate(10);
        return view('list-event')->with('events', $category_event)->with('category', @$category);
    }

    public function update_event(Request $request, $id)
    {
        $user = User::find(Auth::user()->id);
        $event = $user->events()->find($id);
        $list_categories = new Category;
        $list_categories = $list_categories->get();
        if ($request->isMethod('post')) {
            $request->validate(
                [
                    'event_title' => 'required',
                    'event_description' => 'required',
                    'event_start_date' => 'required|date_format:Y-m-d',
                    'event_start_time' => 'required|date_format:H:i',
                    'event_end_date' => 'required|date_format:Y-m-d',
                    'event_end_time' => 'required|date_format:H:i',
                    'event_categories' => 'required',
                    'link' => 'required',
                    'contact' => 'required',
                    'address' => 'required',
                    'poster_event' => 'mimes:jpeg,jpg,png|max:2048',
                    'addition_image_0' => 'mimes:jpeg,jpg,png|max:2048',
                    'addition_image_1' => 'mimes:jpeg,jpg,png|max:2048',
                    'addition_image_2' => 'mimes:jpeg,jpg,png|max:2048',
                    'addition_image_3' => 'mimes:jpeg,jpg,png|max:2048',
                    'addition_image_4' => 'mimes:jpeg,jpg,png|max:2048',
                ]
            );


            $event = new Event;
            $event = $event->find($id);
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

            $posters = new Poster;
            $posters = $posters->where('event_id', $event_id)->get();
            if ($request->file('poster_event') != null) {
                $image = $request->file('poster_event');
                $imageName = time() . '.' . $image->extension();
                $image->storeAs('public', $imageName);
                $posters[0]->poster = $imageName;
                $posters[0]->event_id = $event_id;
                $posters[0]->save();
            }

            for ($i = 0; $i < 5; $i++) {
                $image = $request->file('addition_image_' . ($i));
                if ($request->post('additional_poster_' . ($i)) == '' && $image != null && $request->post('remove_poster_' . ($i)) !== 'remove') {
                    $poster = new Poster;
                    $imageName = time() . '.' . $image->extension();
                    $image->storeAs('public', $imageName);
                    $poster->poster = $imageName;
                    $poster->event_id = $event_id;
                    $poster->save();
                } elseif ($request->post('additional_poster_' . ($i)) == @$posters[$i + 1]->poster && $image != null && $request->post('remove_poster_' . ($i)) !== 'remove') {
                    $imageName = time() . '.' . $image->extension();
                    $image->storeAs('public', $imageName);
                    $posters[$i + 1]->poster = $imageName;
                    $posters[$i + 1]->event_id = $event_id;
                    $posters[$i + 1]->save();
                } elseif ($request->post('remove_poster_' . ($i)) === 'remove' && isset($posters[$i + 1]->poster)) {
                    $posters[$i + 1]->delete();
                }
            }
            return back()->with('success', 'Update Sukses!');
        }
        return view('update-event')->with('event', $event)->with('cats', $list_categories);
    }
}

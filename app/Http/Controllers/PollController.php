<?php

namespace App\Http\Controllers;

use App\Http\Requests\PollRequest;
use App\Http\Requests\storepolls;
use App\Http\Requests\UpdatePollRequest;
use App\Models\multiplechoice;
use App\Models\poll;
use App\Models\ranking;
use App\Models\vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PollController extends Controller
{

    public function index()
    {

        return Inertia::render('poll/home');
    }
    //poll creation pages
    public function create_Poll()
    {
        return Inertia::render('poll/create_poll');
    }

    public function create_Image_Poll()
    {
        return Inertia::render('poll/image_poll');
    }
    public function create_Ranking_Poll()
    {
        return Inertia::render('poll/ranking_poll');
    }
    // polls render function
    public function vote_Page()
    {
        if (ranking::where('user_id', auth::id())->exists()) {
            $user = Auth::user()->name;
            $votes = vote::select('title', 'selectedOption', 'votes')->get();
            $ranking_polls = ranking::where('user_id', auth::id())->get();
            // dd($ranking_polls);
            return Inertia::render('poll/vote_page', [
                'rpolls' => $ranking_polls,
                'votes' => $votes,
                'user' => $user,
            ]);
        } else {
            return Inertia::render('not_found');
        }
    }

    public function images_Vote_Page()
    {
        // dd(auth::id());
        if (poll::where('user_id', auth::id())->exists()) {

            // Fetch votes from the database
            $votes = vote::select('title', 'selectedOption', 'votes')->get();
            // Calculate total votes
            $user = Auth::user()->name;
            $polls = poll::where('user_id', auth::id())->get();
            return Inertia::render('poll/images_vote_page', [
                'polls' => $polls,
                'votes' => $votes,
                'user' => $user,
            ]);
        } else {
            return Inertia::render('not_found');
        }
    }

    public function multiple_Vote_Page()
    {
        if (multiplechoice::where('user_id', auth::id())->exists()) {

            $votes = vote::select('title', 'selectedOption', 'votes')->get();
            // Calculate total votes
            $user = Auth::user()->name;

            $multiple = multiplechoice::where('user_id', auth::id())->get();
            // dd($multiple);
            return Inertia::render('poll/multiple_vote_page', [
                'multiple' => $multiple,
                'votes' => $votes,
                'user' => $user,
            ]);
        } else {
            return Inertia::render('not_found');
        }
    }
    //image poll store function
    public function poll_Submit(PollRequest $request)
    {
        // dd($request->all());
        // Handle validated data
        $image = $request->file('image');
        $imageName = time() . '-' . $image->getClientOriginalName();
        $image->move(public_path('photos'), $imageName);

        $pollinfo = [
            'title' => $request->title,
            'method' => $request->method,
            'description' => $request->description,
            'image' => $imageName,
            'options' => json_encode($request->input('options')),
            'others' => $request->others,
            'vote_per_ip' => $request->vote_per_ip,
            'require_names' => $request->require_names,
            'other_option_vote' => $request->other_option_vote,
            'other_option_results' => $request->other_option_results,
            'user_id' => auth::id(),
        ];
        // dd($pollinfo);
        poll::create($pollinfo);

        return redirect("/images_vote_page");

    }

    public function multiple_Submit(PollRequest $request)
    {

        $imageNames = [];
        $img_list = [];

        // Determine the layout type
        $layout = $request->input('layout');

        // Check for grid layout
        if ($layout === 'grid') {
            foreach ($request->input('images') as $index => $file) {
                if ($request->hasFile("images.$index.file")) {
                    $image = $request->file("images.$index.file");
                    $imageName = time() . '-' . $image->getClientOriginalName();
                    $image->move(public_path('photos'), $imageName);
                    $imageNames[] = $imageName;
                }
            }
        }

        // Check for list layout
        elseif ($layout === 'list') {
            foreach ($request->input('images') as $index => $imageData) {
                // Assuming 'title' and 'description' are part of the image data
                $title = $imageData['title'] ?? '';
                $description = $imageData['description'] ?? '';
                if ($request->hasFile("images.$index.file")) {
                    $image = $request->file("images.$index.file");
                    $imageName = time() . '-' . $image->getClientOriginalName();
                    $image->move(public_path('photos'), $imageName);

                    // Store image details in img_list
                    $img_list[] = [
                        'image' => $imageName,
                        'title' => $title,
                        'description' => $description,
                    ];
                }
            }
        }

        // Prepare poll info for saving to the database
        $pollinfo = [
            'title' => $request->title,
            'method' => $request->method,
            'description' => $request->description,
            'vote_per_ip' => $request->vote_per_ip,
            'require_names' => $request->require_names,
            'other_option_vote' => $request->other_option_vote,
            'other_option_results' => $request->other_option_results,
            'layout' => $layout,
            'images' => json_encode($imageNames),  // for grid layout
            'images_list' => json_encode($img_list), // for list layout
            'user_id' => auth::id(),
        ];

        multiplechoice::create($pollinfo);
        return redirect("/multiple_vote_page");
    }


    public function ranking_Submit(PollRequest $request)
    {

        $pollinfo = [
            'title' => $request->title,
            'method' => $request->method,
            'description' => $request->description,
            'options' => json_encode($request->input('options')),
            'vote_per_ip' => $request->vote_per_ip,
            'require_names' => $request->require_names,
            'other_option_vote' => $request->other_option_vote,
            'other_option_results' => $request->other_option_results,
            'user_id' => auth::id(),
        ];

        ranking::create($pollinfo);
        return redirect('/vote_page');
    }
    //poll delete
    public function delete_Poll($pollType, $id)
    {
        switch ($pollType) {
            case 'imagepoll':
                // Logic to delete a poll from 'vote_page'
                //deleting polls votes
                if (poll::where('id', $id)->exists()) {
                    $votes = poll::where('id', $id)->first();
                    vote::where('poll_name', operator: $pollType)->where('title', $votes->title)->delete();
                }
                poll::where('id', $id)->delete();
                break;

            case 'ranking':
                // Logic to delete a poll from 'images_vote_page'
                //deleting polls votes
                if (ranking::where('id', $id)->exists()) {
                    $votes = ranking::where('id', $id)->first();
                    vote::where('poll_name', operator: $pollType)->where('title', $votes->title)->delete();
                }
                ranking::where('id', $id)->delete();
                break;

            case 'multiplepoll':
                //deleting polls votes
                if (multiplechoice::where('id', $id)->exists()) {
                    $votes = multiplechoice::where('id', $id)->first();
                    vote::where('poll_name', operator: $pollType)->where('title', $votes->title)->delete();
                }
                // Logic to delete a poll from 'multiple_vote_page'
                multiplechoice::where('id', $id)->delete();
                break;

            default:
                return response()->json(['error' => 'Invalid poll type'], 400);
        }
    }


    public function edit_Poll($pollType, $id)
    {
        // $userId = auth::id();
        // if (
        //     multiplechoice::where('user_id', $userId)->exists() ||
        //     poll::where('user_id', $userId)->exists() ||
        //     ranking::where('user_id', $userId)->exists()
        // ) {

            switch ($pollType) {
                case 'imagepoll':
                    $imagepoll = poll::where('id', $id)
                        ->where('user_id', auth::id())->get();
                    return Inertia::render('editpolls/edit_poll', [
                        'imagepoll' => $imagepoll,
                    ]);

                case 'multiplepoll':
                    $multiplepoll = multiplechoice::where('id', $id)
                        ->where('user_id', auth::id())->get();
                    return Inertia::render('editpolls/edit_image_poll', [
                        'multiplepoll' => $multiplepoll,
                    ]);

                case 'ranking':
                    $rankingpoll = ranking::where('id', $id)
                        ->where('user_id', auth::id())->get();

                    return Inertia::render('editpolls/edit_ranking_poll', [
                        'rankingpoll' => $rankingpoll,
                    ]);

                default:
                    abort(404, 'Poll type not found');
            }
        }
        // else
        //     return Inertia::render('not_found');



    public function update_Poll($pollType, $id, Request $request)
    {
        // Determine the method type from the request
        $poll = $request->method;
        // Handle the update based on the poll type
        match ($poll) {
            'imagepoll' => $this->updateImagePoll($id, $request),
            'multiplepoll' => $this->updateMultiplePoll($id, $request),
            'rankingpoll' => $this->updateRankingPoll($id, $request),
            default => response()->json(['error' => 'Invalid poll type'], 400),
        };
    }

    public function updateImagePoll($id, Request $request)
    {
        // Find the poll by ID
        $poll = poll::findOrFail($id);
        // Check if a new image is uploaded

        if ($request->hasFile('image')) {
            if ($poll->image && file_exists(public_path('photos/' . $poll->image))) {
                unlink(public_path('photos/' . $poll->image));
            }
            $image = $request->file('image');
            $imageName = time() . '-' . $image->getClientOriginalName();
            $image->move(public_path('photos'), $imageName);
        } else {
            $imageName = $request->image;
        }

        // Update other fields
        $poll->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imageName,
            'options' => json_encode($request->input('options')),
            'others' => $request->others,
            'vote_per_ip' => $request->vote_per_ip,
            'require_names' => $request->require_names,
            'other_option_vote' => $request->other_option_vote,
            'other_option_results' => $request->other_option_results,
        ]);
        return redirect("/images_vote_page")->with('success', 'Poll updated successfully!');
    }

    public function updateMultiplePoll($id, Request $request)
    {
        dd($request->all());
        // Find the poll by ID
        $poll = multiplechoice::findOrFail($id);

        $imageNames = [];
        $img_list = [];

        // Determine the layout type
        $layout = $request->input('layout');

        // Check for grid layout
        if ($layout === 'grid') {
            foreach ($request->input('images') as $index => $file) {
                if ($request->hasFile("images.$index.file")) {
                    $image = $request->file("images.$index.file");
                    $imageName = time() . '-' . $image->getClientOriginalName();
                    $image->move(public_path('photos'), $imageName);
                    $imageNames[] = $imageName;
                }
            }
        } elseif ($layout === 'list') {
            foreach ($request->input('images') as $index => $imageData) {
                $title = $imageData['title'] ?? '';
                $description = $imageData['description'] ?? '';
                if ($request->hasFile("images.$index.file")) {
                    $image = $request->file("images.$index.file");
                    $imageName = time() . '-' . $image->getClientOriginalName();
                    $image->move(public_path('photos'), $imageName);

                    // Store image details in img_list
                    $img_list[] = [
                        'image' => $imageName,
                        'title' => $title,
                        'description' => $description,
                    ];
                }
            }
        }

        // Update poll info
        $poll->update([
            'title' => $request->title,
            'method' => $request->method,
            'description' => $request->description,
            'vote_per_ip' => $request->vote_per_ip,
            'require_names' => $request->require_names,
            'other_option_vote' => $request->other_option_vote,
            'other_option_results' => $request->other_option_results,
            'layout' => $layout,
            'images' => json_encode($imageNames),  // for grid layout
            'images_list' => json_encode($img_list), // for list layout
        ]);

        return redirect("/multiple_vote_page")->with('success', 'Multiple poll updated successfully!');
    }

    public function updateRankingPoll($id, Request $request)
    {
        // Find the poll by ID
        $poll = ranking::findOrFail($id);

        // Update poll info
        $poll->update([
            'title' => $request->title,
            'method' => $request->method,
            'description' => $request->description,
            'options' => json_encode($request->input('options')),
            'vote_per_ip' => $request->vote_per_ip,
            'require_names' => $request->require_names,
            'other_option_vote' => $request->other_option_vote,
            'other_option_results' => $request->other_option_results,
        ]);
        return redirect('/vote_page')->with('success', 'Poll deleted successfully.');
        // You can also return a response here if needed
        //    return redirect()->back();

    }


}

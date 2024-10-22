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
        $votes = vote::select('title', 'selectedOption', 'votes')->get();
        // Calculate total votes
        $totalvotes = $votes->sum('votes');

        $ranking_polls = ranking::all();
        // dd($ranking_polls);
        return Inertia::render('poll/vote_page', [
            'rpolls' => $ranking_polls,
            'votes' => $votes,
            'totalvotes' => $totalvotes,
        ]);
    }

    public function images_Vote_Page()
    {
        // Fetch votes from the database
        $votes = vote::select('title', 'selectedOption', 'votes')->get();
        // Calculate total votes
        $totalvotes = $votes->sum('votes');
        $polls = poll::all();
        return Inertia::render('poll/images_vote_page', [
            'polls' => $polls,
            'votes' => $votes,
            'totalvotes' => $totalvotes,
        ]);
    }

    public function multiple_Vote_Page()
    {
        $votes = vote::select('title', 'selectedOption', 'votes')->get();
        // Calculate total votes
        $totalvotes = $votes->sum('votes');

        $multiple = multiplechoice::all();
        // dd($multiple);
        return Inertia::render('poll/multiple_vote_page', [
            'multiple' => $multiple,
            'votes' => $votes,
            'totalvotes' => $totalvotes,
        ]);
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
                poll::where('id', $id)->delete();
                break;

            case 'ranking':
                // Logic to delete a poll from 'images_vote_page'
                ranking::where('id', $id)->delete();
                break;

            case 'multiplepoll':
                // Logic to delete a poll from 'multiple_vote_page'
                multiplechoice::where('id', $id)->delete();
                break;

            default:
                return response()->json(['error' => 'Invalid poll type'], 400);
        }

        // session()->flash('success', 'Poll Deleted successfully!');

        // You can also return a response here if needed
        return response(session()->flash('success', 'Poll Deleted successfully!'));
    }


    public function edit_Poll($pollType, $id){
    switch ($pollType) {
        case 'imagepoll':
            $imagepoll=poll::where('id',$id)->get();
            return Inertia::render('editpolls/edit_poll', [
                'imagepoll' => $imagepoll,
            ]);

            case 'multiplepoll':
                $multiplepoll=multiplechoice::where('id',$id)->get();
            return Inertia::render('editpolls/edit_image_poll', [
                'multiplepoll' => $multiplepoll,
            ]);

        case 'ranking':
            $rankingpoll=ranking::where('id',$id)->get();

            return Inertia::render('editpolls/edit_ranking_poll', [
                'rankingpoll' => $rankingpoll,
            ]);

        default:
            abort(404, 'Poll type not found');
    }

    }
    public function update_Poll($pollType,$id, Request $request)
    {
        dd(vars: $request->file('image'));
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
        dd($request->all());
        // Find the poll by ID
        $poll = poll::findOrFail($id);
        // Check if a new image is uploaded

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '-' . $image->getClientOriginalName();
            $image->move(public_path('photos'), $imageName);
        }else{
            $imageName=$request->image;
        }

        // Update other fields
        $poll->update([
            'title' => $request->title,
            'description' => $request->description,
            'image'=>$imageName,
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

        // You can also return a response here if needed
        return response(session()->flash('success', 'Poll updated successfully!'));

    }


}

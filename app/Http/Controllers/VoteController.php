<?php

namespace App\Http\Controllers;

use App\Models\vote;
use Error;
use Illuminate\Http\Request;

use function Laravel\Prompts\alert;

class VoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storePoll(Request $request)
    {
        // dd($request->all());
        // Validate the request
        $request->validate([
            'poll_name' => 'required|string|max:255',  // Ensure poll_name is required
            'title' => 'required|string|max:255',
            'selectedOption' => 'required|string',
        ]);

        $poll = [
            'poll_name' => $request->poll_name,
            'name'=>$request->name,
            'title' => $request->title,
            'selectedOption' => $request->selectedOption,
        ];

        // Get the user's IP address
        $userIp = $request->ip();
        //if user checked the one vote per ip
        if ($request->settings['vote_per_ip'] == 'on') {

            // Check if the same IP has already voted for this poll
            $ipVoted = vote::where('ip_address', $userIp)
                ->where('title', $poll['title'])
                ->exists();

            if ($ipVoted) {
                // If the IP has already voted, return a message
                return response()->json(['error'=>'An error occured'],422);
            }
        }
        // Check if the selected option already exists
        if (
            Vote::where('poll_name', $request->poll_name)
                ->where('selectedOption', $poll['selectedOption'])->exists()
        ) {
            $existingVote = Vote::where('poll_name', $request->poll_name)
                ->where('selectedOption', $poll['selectedOption'])->first();
            $existingVote->votes += 1;  // Increment the vote count
            $existingVote->save();
        } else {
            $poll['votes'] = 1;  // Initialize vote count
            $poll['ip_address'] = $userIp;  // Save the voter's IP address
            // dd($poll);
            Vote::create($poll);  // Create new vote record
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(vote $vote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(vote $vote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, vote $vote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(vote $vote)
    {
        //
    }
}

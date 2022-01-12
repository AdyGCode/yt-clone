<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreChannelRequest;
use App\Http\Requests\UpdateChannelRequest;
use App\Models\Channel;
use App\Models\User;
use Str;

class ChannelController extends Controller
{


    public function __construct()
    {
        $this->authorizeResource(Channel::class);

        // Post::class is the model to lookup the policy
        // post - parameter name, explained w/ can middleware
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $channels = Channel::all();

        return view('channels.index', compact(['channels']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all(['id', 'name']);
        return view('channels.add', compact(['users']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreChannelRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreChannelRequest $request)
    {
        $slug = $request->slug ?? $request->name;

        Channel::create([
                            'name' => $request->name,
                            'user_id' => $request->user_id,
                            'slug' => Str::slug($slug),
                            'uid' => uniqid(true, true),
                            'description' => $request->description,
                            'private' => $request->private ? true : false,
                            'image' => $request->image ?? 'video.png',
                        ]);

        return redirect()->route('channels.index')->banner('Channel added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Channel  $channel
     * @return \Illuminate\Http\Response
     */
    public function show(Channel $channel)
    {
        return view('channels.show', compact(['channel']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Channel  $channel
     * @return \Illuminate\Http\Response
     */
    public function edit(Channel $channel)
    {
        $users = User::all(['id', 'name']);
        return view('channels.edit', compact(['channel', 'users']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateChannelRequest  $request
     * @param  \App\Models\Channel  $channel
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateChannelRequest $request, Channel $channel)
    {
        $slug = $request->slug ?? $request->name;

        $channel->update([
                             'name' => $request->name,
                             'user_id' => $request->user_id,
                             'slug' => Str::slug($slug),
                             'description' => $request->description,
                             'image' => $request->image,
                         ]);

        return redirect()->route('channels.index')->banner('Channel updated successfully.');
    }

    /**
     * Verify the removal of the specified resource from storage.
     *
     * @param  \App\Models\Channel  $channel
     * @return \Illuminate\Http\Response
     */
    public function delete(Channel $channel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Channel  $channel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Channel $channel)
    {
        //
    }
}

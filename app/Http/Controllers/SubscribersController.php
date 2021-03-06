<?php

namespace App\Http\Controllers;

use App\Subscriber;
use App\City;
use Illuminate\Http\Request;
use Input;
use Mail;
use Redirect;

class SubscribersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->middleware('auth', ['only' => ['index']]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(City $city)
    {
        return view('subscribers.create', compact('city'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(City $city, Request $request)
    {
        $this->validate($request, [
            'name'  => 'required|max:70',
            'email' => 'required|email|unique:subscribers',
        ]);
        $subscriber = new Subscriber(Input::all());
        $subscriber->city_id = $city->id;
        $subscriber->save();
        $subscriber->createNewToken();
        Mail::send('emails.subscribers.hello', ['subscriber' => $subscriber], function ($m) use ($subscriber) {
            $m->from('messages@madebyfieldwork.com', 'See+Do')
                ->to($subscriber->email, $subscriber->name)
                ->subject('Thanks for subscribing to See+Do')
                ->getHeaders()
                ->addTextHeader('X-MC-Subaccount', 'see-do');
        });

        return Redirect::to($city->iata . '/subscribers/hello');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $token
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Subscriber $subscriber)
    {
        return view('subscribers.edit', compact('subscriber'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param string                   $token
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subscriber $subscriber)
    {
        $this->validate($request, [
            'name'  => 'required|max:70',
            'email' => 'required|email|unique:subscribers,email,'.$subscriber->id,
        ]);

        $subscriber->fill(Input::all());
        $subscriber->createNewToken();
        Mail::send('emails.subscribers.update', ['subscriber' => $subscriber], function ($m) use ($subscriber) {
            $m->from('messages@madebyfieldwork.com', 'See&Do')
                ->to($subscriber->email, $subscriber->name)
                ->subject('Your settings have been updated for See&Do')
                ->getHeaders()
                ->addTextHeader('X-MC-Subaccount', 'see-do');
        });

        return Redirect::to('/subscribers/updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $token
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscriber $subscriber)
    {
        $subscriber->delete();

        return Redirect::to('/subscribers/unsubscribed');
    }
}

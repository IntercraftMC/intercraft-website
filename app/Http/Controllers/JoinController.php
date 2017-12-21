<?php

namespace App\Http\Controllers;

use App\Support\Mojang\Mojang;
use App\Http\Requests\StoreApplicationRequest;
use App\Models\Application;
use App\Mail\ApplicationReceived;
use Illuminate\Support\Facades\Mail;

class JoinController extends Controller
{
    public function index()
    {
    	return view("join", [
    		"title" => "Join Us",
            "questions" => config("questionnaire")
    	]);
    }

    public function store(StoreApplicationRequest $request)
    {
        // Lookup the Mojang account
        $account = Mojang::lookup(trim($request->username));

        // Submit the application
        $this->submitApplication($account, $request->input());

        // Send an email notification
        Mail::to($request->email)
            ->cc(config('mail.from.address'))
            ->queue(new ApplicationReceived($account['username']));

        // Finished
        return redirect()->route("join")->with("signup", True);
    }

    protected function submitApplication(array $account, array $input)
    {
        $application = new Application();
        $application->email = trim($input['email']);
        $application->username = trim($account['username']);
        $application->uuid = trim($account['uuid']);
        for ($i = 0; $i < count(config('questionnaire')); $i++)
            $questions[config('questionnaire')[$i][0]] = $input["question-$i"];
        $application->questionnaire = json_encode($questions);
        $application->save();
    }
}

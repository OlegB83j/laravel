<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OnboardingController extends Controller
{
    /**
     * Mark onboarding as dismissed (X button) or completed with answers.
     */
    public function complete(Request $request)
    {
        $user = $request->user();

        $user->onboarding_completed_at = now();
        $answers = $request->input('answers');
        if ($answers !== null && $answers !== '') {
            $user->onboarding_answers = is_string($answers) ? (json_decode($answers, true) ?: []) : (is_array($answers) ? $answers : []);
        }
        $user->save();

        return response()->json(['ok' => true]);
    }
}

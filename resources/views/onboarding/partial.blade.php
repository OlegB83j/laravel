@php
$steps = [
    1 => [
        'question' => 'How often do you plan to use this app?',
        'key' => 'usage_frequency',
        'options' => ['Daily', 'A few times a week', 'Occasionally', 'Rarely'],
    ],
    2 => [
        'question' => "What's your main goal?",
        'key' => 'main_goal',
        'options' => ['Explore features', 'Get work done', 'Learn the product', 'Just trying it out'],
    ],
    3 => [
        'question' => 'How would you describe your experience level?',
        'key' => 'experience_level',
        'options' => ['Beginner', 'Intermediate', 'Advanced', 'Expert'],
    ],
    4 => [
        'question' => 'Which feature interests you most?',
        'key' => 'feature_interest',
        'options' => ['Dashboard', 'Reports', 'Settings', 'Not sure yet'],
    ],
    5 => [
        'question' => 'How did you hear about us?',
        'key' => 'how_heard',
        'options' => ['Search', 'Referral', 'Social media', 'Other'],
    ],
    6 => [
        'question' => 'Anything else we should know?',
        'key' => 'notes',
        'options' => ["I'm ready to start", 'I have questions', 'Just browsing', 'No'],
    ],
];
@endphp
<div id="onboarding-overlay" class="onboarding-overlay" role="dialog" aria-label="Onboarding">
    <div class="onboarding-modal">
        <button type="button" class="onboarding-close" id="onboarding-close" aria-label="Close onboarding">&times;</button>
        <div class="onboarding-steps">
            @foreach($steps as $num => $step)
            <div class="onboarding-step" data-step="{{ $num }}" style="{{ $num !== 1 ? 'display: none;' : '' }}">
                <p class="onboarding-question">{{ $step['question'] }}</p>
                <div class="onboarding-options" role="radiogroup" aria-label="{{ $step['question'] }}">
                    @foreach($step['options'] as $opt)
                    <label class="onboarding-option">
                        <input type="radio" name="onboarding_{{ $step['key'] }}" value="{{ $opt }}" data-key="{{ $step['key'] }}">
                        <span>{{ $opt }}</span>
                    </label>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
        <div class="onboarding-footer">
            <span class="onboarding-dots">
                @foreach($steps as $num => $step)
                <span class="onboarding-dot {{ $num === 1 ? 'active' : '' }}" data-step="{{ $num }}" aria-hidden="true"></span>
                @endforeach
            </span>
            <div class="onboarding-actions">
                <button type="button" class="btn btn-secondary" id="onboarding-prev" style="display: none;">Previous</button>
                <button type="button" class="btn btn-primary" id="onboarding-next">Next</button>
                <button type="button" class="btn btn-primary" id="onboarding-finish" style="display: none;">Finish</button>
            </div>
        </div>
    </div>
</div>
<form id="onboarding-form" method="POST" action="{{ route('onboarding.complete') }}" style="display: none;">
    @csrf
    <input type="hidden" name="answers" id="onboarding-answers-input" value="">
</form>

<style>
.onboarding-overlay { position: fixed; inset: 0; background: rgba(15, 23, 42, 0.6); z-index: 9999; display: flex; align-items: center; justify-content: center; padding: 1rem; }
.onboarding-modal { background: #fff; border-radius: 0.5rem; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25); max-width: 28rem; width: 100%; padding: 1.5rem; position: relative; }
.onboarding-close { position: absolute; top: 0.75rem; right: 0.75rem; width: 2rem; height: 2rem; border: none; background: transparent; font-size: 1.5rem; line-height: 1; color: #64748b; cursor: pointer; border-radius: 0.25rem; display: flex; align-items: center; justify-content: center; }
.onboarding-close:hover { color: #1e293b; background: #f1f5f9; }
.onboarding-question { font-size: 1.125rem; font-weight: 600; margin: 0 0 1rem; color: #1e293b; }
.onboarding-options { display: flex; flex-direction: column; gap: 0.5rem; }
.onboarding-option { display: flex; align-items: center; gap: 0.75rem; padding: 0.75rem; border: 1px solid #e2e8f0; border-radius: 0.375rem; cursor: pointer; }
.onboarding-option:hover { background: #f8fafc; }
.onboarding-option input[type="radio"] { width: 1rem; height: 1rem; margin: 0; accent-color: #2563eb; }
.onboarding-option input:checked + span { font-weight: 600; }
.onboarding-option:has(input:checked) { border-color: #2563eb; background: #eff6ff; }
.onboarding-footer { margin-top: 1.5rem; padding-top: 1rem; border-top: 1px solid #e2e8f0; display: flex; flex-direction: column; gap: 1rem; }
.onboarding-dots { display: flex; justify-content: center; gap: 0.5rem; }
.onboarding-dot { width: 0.5rem; height: 0.5rem; border-radius: 9999px; background: #cbd5e1; }
.onboarding-dot.active { background: #2563eb; }
.onboarding-actions { display: flex; justify-content: flex-end; gap: 0.5rem; }
</style>

<script>
(function() {
    var overlay = document.getElementById('onboarding-overlay');
    var steps = overlay.querySelectorAll('.onboarding-step');
    var dots = overlay.querySelectorAll('.onboarding-dot');
    var current = 1;
    var total = steps.length;

    function showStep(n) {
        current = n;
        steps.forEach(function(s) { s.style.display = s.dataset.step == n ? 'block' : 'none'; });
        dots.forEach(function(d) { d.classList.toggle('active', parseInt(d.dataset.step) === n); });
        document.getElementById('onboarding-prev').style.display = n === 1 ? 'none' : 'inline-block';
        document.getElementById('onboarding-next').style.display = n === total ? 'none' : 'inline-block';
        document.getElementById('onboarding-finish').style.display = n === total ? 'inline-block' : 'none';
    }

    function getAnswers() {
        var obj = {};
        overlay.querySelectorAll('input[type="radio"]:checked').forEach(function(r) {
            obj[r.dataset.key] = r.value;
        });
        return obj;
    }

    function complete(dismissOnly) {
        var form = document.getElementById('onboarding-form');
        var input = document.getElementById('onboarding-answers-input');
        input.value = dismissOnly ? '' : JSON.stringify(getAnswers());
        form.submit();
    }

    document.getElementById('onboarding-close').addEventListener('click', function() {
        if (confirm('Are you sure you want to exit the onboarding? Your answers will not be saved.')) {
            complete(true);
        }
    });

    document.getElementById('onboarding-next').addEventListener('click', function() {
        if (current < total) showStep(current + 1);
    });

    document.getElementById('onboarding-prev').addEventListener('click', function() {
        if (current > 1) showStep(current - 1);
    });

    document.getElementById('onboarding-finish').addEventListener('click', function() {
        complete(false);
    });
})();
</script>

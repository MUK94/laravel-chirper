<?php

use App\Models\Chirp;
use Livewire\Volt\Component;


new class extends Component {
    public string $message = '';
    public int $user_id = 0; // Added userId property

    // Define validation rules as a property
    protected $rules = [
        'message' => 'required|string|max:255',
        'user_id' => 'required|exists:users,id',
    ];

    public function mount()
    {
        $this->user_id = auth()->id(); // Initialize userId on component mount
    }

    public function store(): void
    {
        // Validate the input
        $validated = $this->validate();
        // Add user_id to the validated data
        $validated['user_id'] = auth()->id();
        // dd(auth()->id());
        // Store the chirp
        Chirp::create($validated);

        // Clear the message
        $this->message = '';

        $this->dispatch('chirp-created');

    }
};

?>

<div>
    <form wire:submit="store">
        <textarea wire:model="message" placeholder="{{ __('What\'s on your mind?') }}"
            class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"></textarea>

            <x-input-error :messages="$errors->get('message')" class="mt-2" />
        <x-primary-button class="mt-4">{{ __('Chirp') }}</x-primary-button>
    </form>
</div>

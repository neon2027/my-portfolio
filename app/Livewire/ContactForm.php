<?php

namespace App\Livewire;

use App\Mail\ContactInquiry;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class ContactForm extends Component
{
    public string $name = '';

    public string $email = '';

    public string $subject = '';

    public string $body = '';

    public bool $submitted = false;

    protected function rules(): array
    {
        return [
            'name'    => ['required', 'string', 'min:2', 'max:100'],
            'email'   => ['required', 'email:rfc,dns', 'max:255'],
            'subject' => ['required', 'string', 'min:3', 'max:150'],
            'body'    => ['required', 'string', 'min:10', 'max:2000'],
        ];
    }

    protected function messages(): array
    {
        return [
            'name.required'    => 'Your name is required.',
            'name.min'         => 'Name must be at least 2 characters.',
            'name.max'         => 'Name must not exceed 100 characters.',
            'email.required'   => 'Your email address is required.',
            'email.email'      => 'Please enter a valid email address.',
            'email.max'        => 'Email must not exceed 255 characters.',
            'subject.required' => 'A subject is required.',
            'subject.min'      => 'Subject must be at least 3 characters.',
            'subject.max'      => 'Subject must not exceed 150 characters.',
            'body.required'    => 'A message is required.',
            'body.min'         => 'Message must be at least 10 characters.',
            'body.max'         => 'Message must not exceed 2,000 characters.',
        ];
    }

    public function updated(string $field): void
    {
        $this->validateOnly($field);
    }

    public function submit(): void
    {
        $validated = $this->validate();

        Log::info('Portfolio contact form submission', [
            'name'    => $validated['name'],
            'email'   => $validated['email'],
            'subject' => $validated['subject'],
        ]);

        Mail::to('lustanexequiel@gmail.com')->send(
            new ContactInquiry(
                senderName:  $validated['name'],
                senderEmail: $validated['email'],
                subject:     $validated['subject'],
                body:        $validated['body'],
            )
        );

        $this->reset(['name', 'email', 'subject', 'body']);
        $this->submitted = true;
    }

    public function resetForm(): void
    {
        $this->submitted = false;
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}

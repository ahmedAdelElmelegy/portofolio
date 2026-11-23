<?php

namespace Database\Seeders;

use App\Models\ContactMessage;
use Illuminate\Database\Seeder;

class ContactMessageSeeder extends Seeder
{
    public function run(): void
    {
        $messages = [
            [
                'name' => 'John Doe',
                'email' => 'john.doe@example.com',
                'subject' => 'Project Collaboration Offer',
                'message' => 'Hello, I loved your portfolio! We have a freelance project and would love to collaborate with you. Let me know your availability for a quick call next week.',
                'is_read' => false,
            ],
            [
                'name' => 'Sarah Smith',
                'email' => 'sarah.s@example.com',
                'subject' => 'Inquiry about Mobile Dev',
                'message' => 'Hi, do you build cross-platform mobile apps using Flutter? I saw it on your skills list and have an app idea.',
                'is_read' => true,
            ],
        ];

        foreach ($messages as $message) {
            ContactMessage::create($message);
        }
    }
}

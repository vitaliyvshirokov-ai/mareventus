<?php

namespace Tests\Feature;

use App\Mail\ContactAutoReply;
use App\Mail\ContactNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ContactRequestTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_request_is_stored_and_english_emails_are_sent(): void
    {
        Mail::fake();
        $response = $this->postJson('/contact', ['name'=>'Taylor Morgan','email'=>'taylor@example.com','phone'=>'+971 50 000 0000','company'=>'Example Trading','message'=>'Please share chartering availability for our next shipment.','website'=>'']);
        $response->assertCreated()->assertJsonFragment(['message'=>'Thank you for contacting Mare Ventus Logistics. Our team will get back to you shortly.']);
        $this->assertDatabaseHas('contact_requests',['email'=>'taylor@example.com','is_processed'=>false]);
        Mail::assertSent(ContactNotification::class);
        Mail::assertSent(ContactAutoReply::class);
    }

    public function test_honeypot_blocks_bot_submission(): void
    {
        $this->postJson('/contact',['name'=>'Bot','email'=>'bot@example.com','message'=>'Automated website message.','website'=>'filled'])->assertUnprocessable();
    }
}

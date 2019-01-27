<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use \App\User;
use \App\Contact;

class ContactTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class, 1)->create()->first();
        $this->contact = factory(Contact::class, 5)->create([
            'user_id' => $this->user->id
        ])->first();
    }

    /**
     * @test
     */
    public function a_user_has_many_contacts()
    {
        $this->assertEquals(5, $this->user->contacts->count());
    }

    /**
     * @test
     */
    public function a_contact_belongs_to_a_user()
    {
    	 $this->assertEquals($this->user->id, $this->contact->user->id);
    }
}

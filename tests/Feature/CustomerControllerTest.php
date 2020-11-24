<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\Entry;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class CustomerControllerTest extends TestCase
{
    /**
     * Tests deleting a customer the happy path.
     *
     * @return void
     */
    public function testDeleteCustomerTheHappyPath()
    {
        $admin = User::where(User::ATTR_EMAIL, 'admin@foo.bar')
            ->firstOrFail();

        $customer = new Customer();

        $customer->name = Str::random();
        $customer->save();

        $response = $this
            ->actingAs($admin)
            ->get(
                route(
                    'customers.delete',
                    [
                        'customer' => $customer->id,
                    ]
                )
            );

        $response->assertStatus(302);
        $response->assertLocation(route('customers'));

        $this->expectException(ModelNotFoundException::class);

        $customer = Customer::findOrFail($customer->id);
    }

    /**
     * Tests deleting a not deletable project.
     *
     * @return void
     */
    public function testDeleteNotDeletableCustomer()
    {
        $admin = User::where(User::ATTR_EMAIL, 'admin@foo.bar')
            ->firstOrFail();

        $customer = new Customer();

        $customer->name = Str::random();
        $customer->save();

        $entry = Entry::factory()
            ->make(
                [
                    Entry::ATTR_CUSTOMER_ID => $customer->id,
                ]
            );
        $entry->save();

        $customer->refresh();

        $this->assertEquals(false, $customer->isDeletable());

        $response = $this
            ->actingAs($admin)
            ->get(
                route(
                    'customers.delete',
                    [
                        'customer' => $customer->id,
                    ]
                )
            );

        $response->assertStatus(302);

        $customer = Customer::findOrFail($customer->id);

        $this->assertInstanceOf(Customer::class, $customer);
    }
}

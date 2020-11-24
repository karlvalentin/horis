<?php

namespace Tests\Unit;

use App\Exceptions\NotDeletableException;
use App\Models\Activity;
use App\Models\Customer;
use App\Models\Entry;
use Illuminate\Support\Str;
use Tests\TestCase;

/**
 * Test customer model.
 *
 * @author Karl Valentin <karl.valentin@kvis.de>
 */
class CustomerTest extends TestCase
{
    /**
     * Tests that customer is only deletable when not having related entries.
     */
    public function testDeletableTest()
    {
        $customer = new Customer();

        $customer->name = Str::random();
        $customer->save();

        $this->assertEquals(true, $customer->isDeletable());

        $entry = Entry::factory()
            ->make(
                [
                    Entry::ATTR_CUSTOMER_ID => $customer->id,
                ]
            );
        $entry->save();

        $customer->refresh();

        $this->assertEquals(false, $customer->isDeletable());
    }

    /**
     * Tests that deleting a not deletable customer throws ans exception.
     *
     * @throws \Exception
     */
    public function testDeletingNotDeletableThrowsException()
    {
        $customer = new Customer();

        $customer->name = Str::random();
        $customer->save();

        $this->assertEquals(true, $customer->isDeletable());

        $entry = Entry::factory()
            ->make(
                [
                    Entry::ATTR_CUSTOMER_ID => $customer->id,
                ]
            );
        $entry->save();

        $customer->refresh();

        $this->expectException(NotDeletableException::class);
        $this->expectExceptionMessage('Customer is not deletable.');

        $customer->delete();
    }
}

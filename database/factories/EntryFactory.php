<?php

namespace Database\Factories;

use App\Models\Activity;
use App\Models\Customer;
use App\Models\Entry;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Entry factory.
 *
 * @author Karl Valentin <karl.valentin@kvis.de>
 */
class EntryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Entry::class;

    /**
     * Available activity IDs.
     *
     * @var array|int[]
     */
    protected array $activityIds = [];

    /**
     * Available customer IDs.
     *
     * @var array|int[]
     */
    protected array $customerIds = [];

    /**
     * Available project IDs.
     *
     * @var array|int[]
     */
    protected array $projectIds = [];

    /**
     * Available user IDs.
     *
     * @var array|int[]
     */
    protected array $userIds = [];

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $start = $this->faker->dateTimeThisMonth;
        $end = (clone $start)->add(new \DateInterval('PT2H'));

        return [
            Entry::ATTR_START => $start,
            Entry::ATTR_END => $end,
            Entry::ATTR_DESCRIPTION => $this->faker->words(3, true),
            Entry::ATTR_CUSTOMER_ID => $this->getRandomCustomerId(),
            Entry::ATTR_PROJECT_ID => $this->getRandomProjectId(),
            Entry::ATTR_USER_ID => $this->getRandomUserId(),
            Entry::ATTR_ACTIVITY_ID => $this->getRandomActivityId(),
        ];
    }

    /**
     * Get random customer id.
     *
     * @return int|null
     */
    private function getRandomCustomerId(): ?int
    {
        if (empty($this->customerIds)) {
            $this->customerIds = Customer::all()
                ->pluck('id')
                ->values()
                ->toArray();
        }

        return $this
            ->faker
            ->randomElement(
                $this->customerIds
            );
    }

    /**
     * Get random project id.
     *
     * @return int|null
     */
    private function getRandomProjectId(): ?int
    {
        if (empty($this->projectIds)) {
            $this->projectIds = Project::all()
                ->pluck('id')
                ->values()
                ->toArray();
        }

        return $this
            ->faker
            ->randomElement(
                $this->projectIds
            );
    }

    /**
     * Get random user id.
     *
     * @return int|null
     */
    private function getRandomUserId(): ?int
    {
        if (empty($this->userIds)) {
            $this->userIds = User::all()
                ->pluck('id')
                ->values()
                ->toArray();
        }

        return $this
            ->faker
            ->randomElement(
                $this->userIds
            );
    }

    /**
     * Get random activity id.
     *
     * @return int|null
     */
    private function getRandomActivityId(): ?int
    {
        if (empty($this->activityIds)) {
            $this->activityIds = Activity::all()
                ->pluck('id')
                ->values()
                ->toArray();
        }

        return $this
            ->faker
            ->randomElement(
                $this->activityIds
            );
    }
}

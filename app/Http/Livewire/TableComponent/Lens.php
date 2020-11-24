<?php

namespace App\Http\Livewire\TableComponent;

/**
 * Lense.
 *
 * @author Karl Valentin <karl.valentin@kvis.de>
 */
class Lens
{
    public string $label;

    public string $identifier;

    public \Closure $query;

    /**
     * Lense constructor.
     * @param string $label
     * @param string $identifier
     * @param \Closure $query
     */
    public function __construct(
        string $identifier,
        ?string $label = null,
        ?\Closure $query = null
    ) {
        $this->identifier = $identifier;

        if ($label) {
            $this->label = $label;
        } else {
            $this->label = $identifier;
        }

        if ($query) {
            $this->query = $query;
        } else {
            $this->query = function ($query) {

            };
        }
    }


    /**
     * Set label.
     *
     * @param string $label
     *
     * @return $this
     */
    public function label(string $label): Lens
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Set identifier.
     *
     * @param string $identifier
     *
     * @return $this
     */
    public function identifier(string $identifier): Lens
    {
        $this->identifier = $identifier;

        return $this;
    }

    /**
     * Set query.
     *
     * @param \Closure $query
     *
     * @return Lens
     * @noinspection PhpFullyQualifiedNameUsageInspection
     */
    public function query(\Closure $query): Lens
    {
        $this->query = $query;

        return $this;
    }
}

<?php

namespace Neon\TxCalender\Domain\Model\Dto;

class EventFilter {

    protected ?string $startDate = null;
    protected ?string $endDate = null;
    /**
     * @var array<int>
     */
    protected array $categories = [];

    public function getStartDate(): ?string
    {
        return $this->startDate;
    }

    public function setStartDate(?string $startDate): void
    {
        $this->startDate = $startDate;
    }

    public function getEndDate(): ?string
    {
        return $this->endDate;
    }

    public function setEndDate(?string $endDate): void
    {
        $this->endDate = $endDate;
    }

    public function getCategories(): array
    {
        return $this->categories;
    }

    public function setCategories(array $categories): void
    {
        $this->categories = $categories;
    }

    public function isEmpty(): bool
    {
        return empty($this->startDate) && empty($this->endDate) && empty($this->categories);
    }
}
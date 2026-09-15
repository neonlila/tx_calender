<?php

namespace Neon\TxCalender\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

class Event extends AbstractEntity {
    
    protected string $title = '';
    protected string $teaser = '';
    protected string $description = '';
    protected string $location = '';
    protected ?\DateTime $startDate = null;
    protected ?\DateTime $endDate = null;

    public function getTitle(): string {
        return $this->title;
    }

    public function setTitle(string $title): void {
        $this->title = $title;
    }

    public function getStartDate(): ?\DateTime {
        return $this->startDate;
    }

    public function setStartDate(?\DateTime $startDate): void {
        $this->startDate = $startDate;
    }

    public function getEndDate(): ?\DateTime {
        return $this->endDate;
    }

    public function setEndDate(?\DateTime $endDate): void {
        $this->endDate = $endDate;
    }

    public function getTeaser(): string {
        return $this->teaser;
    }

    public function setTeaser(string $teaser): void {
        $this->teaser = $teaser;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function setDescription(string $description): void {
        $this->description = $description;
    }

    public function getLocation(): string {
        return $this->location;
    }

    public function setLocation(string $location): void {
        $this->location = $location;
    }
}
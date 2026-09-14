<?php

namespace Neon\TxCalender\Domain\Modal;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\CMS\Extbase\Domain\Model\Category;

class EventCategory extends AbstractEntity {

    protected string $title = '';
    protected ?\DateTime $startDate = null;

    /**
     * @var ObjectStorage<Category>
     */
    protected ObjectStorage $categories;

    public function __construct() {
        $this->categories = new ObjectStorage();
    }

    public function getTitle(): string {
        return $this->title;
    }

    /**
     * @return ObjectStorage<Category>
     */
    public function getCategories(): ObjectStorage {
        return $this->categories;
    }

    public function addCategory(Category $category): void {
        $this->categories->attach($category);
    }

    public function removeCategory(Category $category): void {
        $this->categories->detach($category);
    }
}
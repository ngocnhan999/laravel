<?php

namespace App\Core\Support;

class PageTitle
{
    /**
     * @var string
     */
    protected $title;

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @param bool $full
     * @return string
     */
    public function getTitle($full = true)
    {
        if (empty($this->title)) {
            return setting('admin_title', config('general.base_name'));
        }

        if (!$full) {
            return $this->title;
        }

        return $this->title . ' | ' . setting('admin_title', config('general.base_name'));
    }
}

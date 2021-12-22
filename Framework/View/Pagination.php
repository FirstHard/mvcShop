<?php

namespace Framework\View;

class Pagination
{
    private $max = 5;
    private $index = 'page';
    public $current_page;
    private $query_data;
    public $total;
    public $limit;
    public $amount;

    public function __construct($total, $currentPage, $limit, $index, $query_data = false)
    {
        $this->total = $total;
        $this->query_data = $query_data;
        $this->limit = $limit;
        $this->index = $index;
        $this->amount = $this->amount();
        $this->setCurrentPage($currentPage);
    }

    public function get(): string
    {
        $links = null;
        $limits = $this->limits();
        $html = '<ul class="pagination justify-content-center">';
        for ($page = $limits[0]; $page <= $limits[1]; $page++) {
            if ($page == $this->current_page) {
                $links .= '<li class="page-item active"><a class="page-link">' . $page . '</a></li>';
            } else {
                $links .= $this->generateHtml($page);
            }
        }
        if (!is_null($links)) {
            if ($this->current_page > 1) {
                $links = $this->generateHtml(1, '<i class="bi bi-chevron-bar-left" aria-hidden="true"></i>') . $links;
            }
            if ($this->current_page < $this->amount) {
                $links .= $this->generateHtml($this->amount, '<i aria-hidden="true" class="bi bi-chevron-bar-right"></i>');
            }
        }
        $html .= $links . '</ul>';
        return $html;
    }

    private function generateHtml($page, $text = null): string
    {
        if (!$text) {
            $text = $page;
        }
        $currentURI = preg_replace('~\?page=[0-9]+~', '', $this->query_data);
        return '<li class="page-item"><a class="page-link" href="?' . $currentURI . $this->index . '=' . $page . '">' . $text . '</a></li>';
    }

    private function limits()
    {
        $left = $this->current_page - round($this->max / 2);
        $start = $left > 0 ? $left : 1;
        if ($start + $this->max <= $this->amount) {
            $end = $start > 1 ? $start + $this->max : $this->max;
        } else {
            $end = $this->amount;
            $start = $this->amount - $this->max > 0 ? $this->amount - $this->max : 1;
        }
        return array($start, $end);
    }

    private function setCurrentPage($currentPage): void
    {
        $this->current_page = $currentPage;
        if ($this->current_page > 0) {
            if ($this->current_page > $this->amount) {
                $this->current_page = $this->amount;
            }
        } else {
            $this->current_page = 1;
        }
    }

    private function amount(): float|false
    {
        return ceil($this->total / $this->limit);
    }
}

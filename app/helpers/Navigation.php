<?php
/**
 * Chibuzo Ebubechi Miracle
 * All right reserved.
 * Copyright (c) 2020.
 */

namespace app\helpers;


use core\middlewares\Session;

class Navigation
{
    private string $link;
    private int $current;
    /**
     * @var false|int
     */
    private $position;


    public function __construct()
    {
        /*$this->handleSession();*/
        $this->link = Session::get(NAVIGATION);
    }

    public function process()
    {
        if(isset($_GET['page']) && $_GET['page'] != ""){
            $this->current = filter_var($_GET['page'], FILTER_SANITIZE_SPECIAL_CHARS);
            $this->position = strpos($this->link, 'page='.$this->current);

            return
            sprintf('
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <li class="page-item">
                            <a class="page-link" href="%s" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        </li>
                        <li class="page-item active"><span class="page-link">%s<span class="sr-only">(current)</span></span>
                        </li>
                        <li class="page-item"><a class="page-link" href="%s">%s</a></li>
                        <li class="page-item"><a class="page-link" href="%s">%s</a></li>
                        <li class="page-item">
                            <a class="page-link" href="%s" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            ',
                substr_replace($this->link, 'page='.($this->current - 1), $this->position, strlen('page='.$this->current)),
                $this->current,
                substr_replace($this->link, 'page='.($this->current + 1), $this->position, strlen('page='.$this->current)),
                $this->current +1,
                substr_replace($this->link, 'page='.($this->current + 2), $this->position, strlen('page='.$this->current)),
                $this->current +2,
                substr_replace($this->link, 'page='.($this->current + 3), $this->position, strlen('page='.$this->current)),
            );
        }


        return
            sprintf('
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <li class="page-item active"><span class="page-link">%s<span class="sr-only">(current)</span></span>
                        </li>
                        <li class="page-item"><a class="page-link" href="%s">%s</a></li>
                        <li class="page-item"><a class="page-link" href="%s">%s</a></li>
                        <li class="page-item">
                            <a class="page-link" href="%s" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            ',
                1,
                $this->setPageNumber(2),
                2,
                $this->setPageNumber(3),
                3,
                $this->setPageNumber(4),
            );
    }

    private function setPageNumber(int $i)
    {
        return strpos($this->link, '?')? $this->link.'&page='.$i: $this->link.'?page='.$i;
    }

    /*private function handleSession()
    {
        $i = 0;
        foreach ($_GET as $key => $value) {
            if ($i == 0) {
                $v = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                Session::set(NAVIGATION, '?'.$key.'='.$v);
            }else{
                $v = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                $get = Session::get(NAVIGATION).'&'.$key.'='.$v;
                Session::set(NAVIGATION, $get);
            }
            $i++;
        }
    }*/
}
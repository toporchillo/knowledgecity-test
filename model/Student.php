<?php
namespace MODEL;

class Student
{
    private $DB;
    private $per_page;

    public function __construct() {
        $this->DB = new \DB(DB_DRIVER, DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);
        $this->per_page = ROWS_PER_PAGE;
    }

    public function getList($page) {
        $from = ($page - 1) * $this->per_page;
        $res = $this->DB->query("SELECT SQL_CALC_FOUND_ROWS * FROM students ORDER BY name LIMIT $from,".$this->per_page);
        $count_res = $this->DB->query("SELECT FOUND_ROWS() AS num");
        $pages = ceil($count_res->row['num'] / ROWS_PER_PAGE);
        return array('list'=>$res->rows, 'pages'=>$pages);
    }

}
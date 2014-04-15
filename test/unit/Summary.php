<?php

require_once "_include/Summary.php";

class Summary_test extends PHPUnit_Framework_TestCase
{
    public function testSummary()
    {
        $totals = new Summary();
        $this->assertTrue($totals->add("test"));
        $this->assertEquals($totals->file_count, 0);
        $this->assertEquals($totals->directory_count, 1);
        $this->assertTrue($totals->add("test/data"));
        $this->assertEquals($totals->file_count, 0);
        $this->assertEquals($totals->directory_count, 2);

        $this->assertFalse($totals->add("nonexistent"));
        $this->assertEquals($totals->file_count, 0);
        $this->assertEquals($totals->directory_count, 2);

        $this->assertTrue($totals->add("test/data/reference/download/data/haha.txt"));
        $this->assertEquals($totals->file_count, 1);
        $this->assertEquals($totals->file_space, 13);
        $this->assertEquals($totals->directory_count, 2);

        $this->assertTrue($totals->add("test/data/reference/download/data/huhu.txt"));
        $this->assertEquals($totals->file_count, 2);
        $this->assertEquals($totals->file_space, 23);
        $this->assertEquals($totals->directory_count, 2);
    }
}

?>

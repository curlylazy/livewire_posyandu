<?php
namespace App\Lib;

class Pagination
{

    public static function genLinks($currentPage, $totalPage, $addvalue = "", $url = "")
    {

        if ($totalPage <= 1)
            return;

        //$paramspc = ($paramspc == "") ? "?" : $paramspc;

        $pages = self::genArrPagination($currentPage, $totalPage);
        $disabled = "disabled";
        $blank = "";
        echo "<nav >";
        echo "<ul class='pagination'>";

        echo "<li class='page-item " . (($currentPage == 1) ? $disabled : $blank) . "'>";
        echo "<a class='page-link' href='$url?page=" . (($currentPage == 1) ? $blank : ($currentPage - 1)) . "$addvalue' aria-label='Previous'>";
        echo "<span aria-hidden='true'>&laquo;</span>";
        echo "</a>";
        echo "</li>";

        foreach ($pages as $page)
        {
            if ($page == "...")
                echo "<li class='page-item disabled'> <a class='page-link' href='$url?page=$page$addvalue'>$page</a> </li>";
            else if ($page == $currentPage)
                echo "<li class='page-item active'> <a class='page-link' href='$url?page=$page$addvalue'>$page</a> </li>";
            else
                echo "<li class='page-item'><a class='page-link' href='$url?page=$page$addvalue'>$page</a></li>";
        }

        echo "<li class='page-item " . (($currentPage == $totalPage) ? $disabled : $blank) . "'>";

        echo "<a class='page-link' href='$url?page=" . (($currentPage == $totalPage) ? $blank : ($currentPage + 1)) . "$addvalue' aria-label='Next'>";
        echo "<span aria-hidden='true'>&raquo;</span>";
        echo "</a>";
        echo "</li>";
        echo "</ul>";
        echo "</nav>";

    }


    private static function genArrPagination($currentPage, $totalPage)
    {

        $pageNumbers = [];
        $diff = 2;

        if ($totalPage < 9)
        {
            for ($i = 1; $i <= $totalPage; $i++)
            {
                $pageNumbers[] = $i;
            }
            return $pageNumbers;
        }

        $firstChunk = [1, 2, 3];
        $lastChunk = [$totalPage - 2, $totalPage - 1, $totalPage];

        if ($currentPage <= $totalPage) {
            $loopStartAt = $currentPage - $diff;
            if ($loopStartAt < 1) {
                $loopStartAt = 1;
            }

            $loopEndAt = $loopStartAt + ($diff * 2);
            if ($loopEndAt > $totalPage) {
                $loopEndAt = $totalPage;
                $loopStartAt = $loopEndAt - ($diff * 2);
            }

            if (!in_array($loopStartAt, $firstChunk)) {
                foreach ($firstChunk as $i) {
                    $pageNumbers[] = $i;
                }

                $pageNumbers[] = '...';
            }

            for ($i = $loopStartAt; $i <= $loopEndAt; $i++) {
                $pageNumbers[] = $i;
            }

            if (!in_array($loopEndAt, $lastChunk)) {
                $pageNumbers[] = '...';

                foreach ($lastChunk as $i) {
                    $pageNumbers[] = $i;
                }
            }
        }

        return $pageNumbers;
    }

    // public static function paginationNumber($page, $limit = 20)
	// {
	// 	if($page == 1)
	// 		$res = $page * 1;
	// 	else
	// 		$res = ($page * $limit) - 1;

	// 	return $res;
	// }

    public static function paginationNumber($index, $dataRow)
	{
        $page = $dataRow->currentPage();
        $limit = $dataRow->perPage();

		$res = ($dataRow->perPage() * ($page - 1)) + $index + 1;


		return $res;
	}



}

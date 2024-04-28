<?php

class Utils
{
    /**
     * @param string string
     * @return string
     */
    public static function uppercaseToCamelCase(string $string): string
    {
        return ucwords(strtolower($string));
    }

    /**
     * @param string address
     * @param string cityStateZip
     * @return string
     */
    public static function formatAddress(string $address, string $cityStateZip): string
    {
        $zipPattern = '/\d{5}/';

        $cityState = preg_replace_callback($zipPattern, function ($matches) use (&$zip) {
            $zip = $matches[0];
            return '';
        }, $cityStateZip, 1);

        return "$address </br> $cityState </br> $zip";
    }

    /**
     * @param string email
     * @return string
     */
    public static function maskEmail($email): string
    {
        $pattern = '/(^(\w)*)@/';

        $email = preg_replace_callback($pattern, function ($matches) use (&$mask) {
            $mask = str_repeat("*", strlen($matches[0]) - 1);
            return '';
        }, $email, 1);

        return "{$mask}@{$email}";
    }

    /**
     * @param string datestring
     * @return string
     */
    public static function formatDate($datestring): string
    {
        $date = DateTime::createFromFormat("n/j/Y", $datestring);

        return $date ? $date->format("Y-m-d") : '';
    }
}


class Pagination
{
    protected array $items;
    protected int $itemsPerPage;
    protected int $pagesTotal;

    /**
     * @param User[] items
     * @param int itemsPerPage
     */
    public function __construct($items, $itemsPerPage)
    {
        $this->items = $items;
        $this->itemsPerPage = $itemsPerPage;
        $this->pagesTotal = count($items) / $itemsPerPage;
    }

    /**
     * @param int pageNum
     * @return array
     */
    public function getPage(int $pageNum): array
    {
        $nextPage = ($pageNum + 1 <= $this->pagesTotal) ? $pageNum + 1 : null;
        $prevPage = ($pageNum - 1 >= 1) ? $pageNum - 1 : null;

        $offset = $pageNum > 1 ? (($pageNum - 1) * $this->itemsPerPage) : 0;

        $items = array_slice($this->items, $offset, $this->itemsPerPage);

        if ($pageNum < 1 || $pageNum > $this->pagesTotal) {
            $_SESSION["errors"][] = "Items for page #{$pageNum} are not found.";
        }

        return [
            'items' => $items,
            'page' => $pageNum,
            'next' => $nextPage,
            'prev' => $prevPage,
            'pagesTotal' => $this->pagesTotal
        ];

    }


}
<?php
/**
 * Created by PhpStorm.
 * User: Bilal Halawaty
 * Date: 21-Jan-19
 * Time: 3:42 PM
 */

namespace App\Filters;

use Illuminate\Http\Request;

abstract class Filters
{
    protected $query, $request;
    protected $filters = [];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /* in method_exists() there is some explain about it's parameters  First $this refer to this class (Filters)
                   second must the another parameters refer to the name of the method
                   so  as we know $filter and $value is keep the array items that we passed to it by use foreach from the main array filter=['by',...]
                   so $filter will be = by and the method take this as the name of the method ; */

    public function apply($query)
    {
        $this->query = $query;
        foreach ($this->getFilters() as $filter => $value) {
            if (method_exists($this, $filter)) {
                $this->$filter($value);
            }
        }

        return $this->query;
    }

    public function getFilters()
    {
        return $this->request->only($this->filters);
    }
}
<?php 

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class QuestionFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];

    public function search($value)
    {
        if (preg_match('/^[%_]+$/', $value)) {
            return $this->whereKey(-1); 
        }

        return $this->when(function ($query) use ($value) {
            $this->where('content', 'LIKE', "%$value%");
        });
    }

    public function sortBy($value)
    {
        switch ($value) {
            case 'asc':
                return $this->orderBy('content', 'asc');               
            case 'desc':
                return $this->orderBy('content', 'desc');
            case 'newest':
                return $this->orderBy('created_at', 'desc');
            case 'oldest':
                return $this->orderBy('created_at', 'asc');
            default:
                return;
        }
    }
}

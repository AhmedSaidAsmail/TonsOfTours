<?php

namespace App\Src\Sync;


use Illuminate\Database\Eloquent\Relations\HasMany;

class Sync
{
    /**
     * @var HasMany $hasmany Hasmany Relationship Eloquent
     */
    public $hasmany;
    /**
     * @var array $data Sending data to do
     */
    public $data;
    /**
     * @var array $updated Updated rows
     */
    public $updated = [];
    /**
     * @var array $deleted Deleted Rows
     */
    public $deleted = [];
    /**
     * @var array $created Created rows
     */
    public $created = [];
    /**
     * @var array $current Current rows
     */
    public $current = [];

    /**
     * Sync constructor.
     * @param HasMany $hasMany
     * @param array $data
     * @param string $index
     */
    public function __construct(HasMany $hasMany, array $data, $index)
    {
        $this->hasmany = $hasMany;
        $this->data = array_key_exists($index, $data) ? $data[$index] : [];
    }

    /**
     * Setting the rows arrays
     *
     * @return Sync
     */
    private function setRows()
    {
        return (new SettingRows($this))->render();

    }

    /**
     * Executing the multi queries functions
     *
     * @return void
     */

    public function exec()
    {
        $this->setRows()
            ->execCreated()
            ->execUpdated()
            ->execDeleted();
    }

    /**
     * Executing the inserting rows
     *
     * @return $this
     */
    public function execCreated()
    {
        $this->hasmany->createMany($this->created);
        return $this;
    }

    /**
     * Executing the updated rows
     *
     * @return $this
     */
    public function execUpdated()
    {
        foreach ($this->updated as $row) {
            $this->hasmany->get()->find($row['id'])->update($row);
        }
        return $this;
    }

    /**
     * Executing the deleted rows
     *
     * @return $this
     */
    public function execDeleted()
    {
        foreach ($this->deleted as $id) {
            $this->hasmany->get()->find($id)->delete();
        }
        return $this;
    }

}
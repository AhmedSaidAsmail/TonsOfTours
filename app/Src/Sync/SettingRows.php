<?php

namespace App\Src\Sync;


class SettingRows
{
    /**
     * @var Sync $sync
     */
    private $sync;

    public function __construct(Sync $sync)
    {
        $this->sync = $sync;
    }

    /**
     * Setting the current rows array
     *
     * @return $this
     */

    private function setCurrent()
    {
        foreach ($this->sync->hasmany->get() as $row) {
            $this->sync->current[] = $row->id;
        }
        return $this;
    }

    /**
     * Setting the updated and created rows array
     *
     * @return $this
     */
    private function setUpdatedAndCreated()
    {
        array_walk($this->sync->data, function ($row) {
            if (array_key_exists('id', $row)) {
                $this->sync->updated[] = $row;
            } else {
                $this->sync->created[] = $row;
            }
        });
        return $this;
    }

    /**
     * Setting the deleted rows array
     *
     * @return $this
     */

    private function setDeleted()
    {
        $this->sync->deleted = array_diff($this->sync->current, array_map(function ($row) {
            return $row['id'];
        }, $this->sync->updated));
        return $this;
    }

    /**
     * Executing the setting functions
     *
     * @return Sync
     */
    public function render()
    {
        return $this->setCurrent()->setUpdatedAndCreated()->setDeleted()->sync;
    }
}
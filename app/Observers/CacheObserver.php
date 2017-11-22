<?php

namespace App\Observers;

class CacheObserver
{
    /**
     * Очистка кэша
     */
    public function clear()
    {
        cache()->clear();
    }

    /**
     * Очистить кэш после создания экземпляра модели
     */
    public function created()
    {
        $this->clear();
    }

    /**
     * Очистить кэш после обновления экземпляра модели
     */
    public function updated()
    {
        $this->clear();
    }

    /**
     * Очистить кэш после удаления экземпляра модели
     */
    public function deleted()
    {
        $this->clear();
    }
}
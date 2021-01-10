<?php

namespace App\Core;

abstract class Module
{
    public function __construct()
    {
        $this->handle();
    }

    protected function handle()
    {
        foreach ($this->providers() as $provider) {
            new $provider();
        }
    }

    /**
     * @return array
     * */
    abstract function providers();
}
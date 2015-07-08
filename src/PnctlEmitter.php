<?php

namespace Gos\Component\PnctlEventLoopEmitter;

use Evenement\EventEmitter;
use React\EventLoop\LoopInterface;

class PnctlEmitter extends EventEmitter
{
    /**
     * @param LoopInterface $loop
     * @param float         $interval
     */
    public function __construct(LoopInterface $loop, $interval = 0.1)
    {
        $loop->addPeriodicTimer($interval, $this);
    }

    /**
     * @param int      $signo
     * @param callable $listener
     */
    public function on($signo, callable $listener)
    {
        pcntl_signal($signo, array($this, 'emit'));
        parent::on($signo, $listener);
    }


    public function __invoke()
    {
        pcntl_signal_dispatch();
    }
}

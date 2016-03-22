<?php

if (!function_exists('pcntl_sigtimedwait')) {
    function pcntl_sigtimedwait($signals, $siginfo, $sec, $nano)
    {
        pcntl_signal_dispatch();

        if (time_nanosleep($sec, $nano) === true) {
            
            return false;
        }

        pcntl_signal_dispatch();

        return true;
    }
}

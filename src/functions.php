<?php

if (!function_exists('pcntl_sigtimedwait')) {
    function pcntl_sigtimedwait(array $signals, array &$siginfo = array(), $sec = 0, $nano = 0)
    {
        pcntl_signal_dispatch();

        if (time_nanosleep($sec, $nano) === true) {
            
            return false;
        }

        pcntl_signal_dispatch();

        return true;
    }
}

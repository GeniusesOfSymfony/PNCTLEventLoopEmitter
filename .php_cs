<?php

return Symfony\CS\Config\Config::create()
    ->level(Symfony\CS\FixerInterface::SYMFONY_LEVEL)
    ->fixers(array(
        'ordered_use',
        'multiline_spaces_before_semicolon',
        'concat_with_spaces'
    ))
    ->finder(
        Symfony\CS\Finder\DefaultFinder::create()
            ->exclude(['vendor'])
            ->in(__DIR__)
    )
;
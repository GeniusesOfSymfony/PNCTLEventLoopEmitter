PNCTL Event Loop Emitter
========================

[![Latest Stable Version](https://poser.pugx.org/gos/pnctl-event-loop-emitter/v/stable)](https://packagist.org/packages/gos/pnctl-event-loop-emitter) [![Total Downloads](https://poser.pugx.org/gos/pnctl-event-loop-emitter/downloads)](https://packagist.org/packages/gos/pnctl-event-loop-emitter) [![License](https://poser.pugx.org/gos/pnctl-event-loop-emitter/license)](https://packagist.org/packages/gos/pnctl-event-loop-emitter)

Brings PNCTL event to event loop.

Install
-------

```cmd
composer require gos/pnctl-event-loop-emitter
```

Usage
-----

```php
use React\EventLoop\Factory;
use Gos\Component\PnctlEventLoopEmitter\PnctlEmitter;

$loop = Factory::create();

$pnctlEmitter = new PnctlEmitter($loop);

$pnctlEmitter->on(SIGTERM, function () use ($loop) {
	//do something
	
	$loop->stop();
});

$pnctlEmitter->on(SIGINT, function () use ($loop) {
	//do something
	
	$loop->stop();
});

$loop->run();
```

Example
-------

Handle double CTRL+C

```php
use React\EventLoop\Factory;
use Gos\Component\PnctlEventLoopEmitter\PnctlEmitter;

$loop = Factory::create();
$pnctlEmitter = new PnctlEmitter($loop);

$pnctlEmitter->on(SIGINT, function () use ($loop) {
	$this->logger->notice('Press CTLR+C again to stop the server');

    if (SIGINT === pcntl_sigtimedwait([SIGINT], $siginfo, 5)) {
        $this->logger->notice('Stopping server ...');

        //Do your stuff to stop the server

        $loop->stop();

        $this->logger->notice('Server stopped !');
    } else {
    	$this->logger->notice('CTLR+C not pressed, continue to run normally');
    }
});

$loop->run();
```


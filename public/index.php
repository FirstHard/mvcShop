<?php

// Including global settings
include(__DIR__ . '/../App/config.php');
include(__DIR__ . '/../App/Core/ExceptionsHandler.php');

(new ExceptionsHandler())->register();

try {
    // Including the file with errors for tests
    include('errors.php');
} catch (ExceptionsHandler $handler) {
    throw new ExceptionsHandler($handler->getMessage(), $handler->getCode());
} finally {
    echo '<div>That`s all Folks!</div>';
}

<?php

require __DIR__.'/vendor/autoload.php';

$client = new \Twirp\Example\Haberdasher\HaberdasherClient($argv[1]);

while (true) {
    $size = new \Twirp\Example\Haberdasher\Size();
    $size->setInches(10);

    try {
        $hat = $client->MakeHat([], $size);

        printf("I received a %s %s\n", $hat->getColor(), $hat->getName());
    } catch (\Twirp\Error $e) {
        if ($cause = $e->getMeta('cause') !== null) {
            printf("%s: %s (%s)\n", strtoupper($e->getErrorCode()), $e->getMessage(), $cause);
        } else {
            printf("%s: %s\n", strtoupper($e->getErrorCode()), $e->getMessage());
        }
    }

    sleep(1);
}

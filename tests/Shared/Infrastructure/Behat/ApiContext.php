<?php

declare(strict_types=1);

namespace App\Tests\Shared\Infrastructure\Behat;

use Behat\Gherkin\Node\PyStringNode;
use Behat\Mink\Session;
use Behat\MinkExtension\Context\MinkContext;
use RuntimeException;
use App\Tests\Shared\Infrastructure\Mink\MinkHelper;

final class ApiContext extends MinkContext
{
    private MinkHelper               $sessionHelper;

    public function __construct(private Session $minkSession)
    {
        $this->sessionHelper = new MinkHelper($this->minkSession);
    }

    /**
     * @Then the response content should be:
     */
    public function theResponseContentShouldBe(PyStringNode $expectedResponse): void
    {
        $expected = $this->sanitizeOutput($expectedResponse->getRaw());
        $actual   = $this->sanitizeOutput($this->sessionHelper->getResponse());

        if ($expected !== $actual) {
            throw new RuntimeException(
                sprintf("The outputs does not match!\n\n-- Expected:\n%s\n\n-- Actual:\n%s", $expected, $actual)
            );
        }
    }

    private function sanitizeOutput(string $output): false|string
    {
        return json_encode(json_decode(trim($output), true));
    }


}

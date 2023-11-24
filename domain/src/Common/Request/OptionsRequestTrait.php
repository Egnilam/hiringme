<?php

declare(strict_types=1);

namespace Domain\Common\Request;

trait OptionsRequestTrait
{
    /**
     * @var array<string, mixed>
     */
    private array $options = [];

    private function addOption(string $option, mixed $value): self
    {
        $this->checkOptionExist($option);
        $this->options[$option] = $value;

        return $this;
    }

    public function hasOption(string $option): bool
    {
        return isset($this->options[$option]);
    }

    public function getOptionValue(string $option): mixed
    {
        $this->checkOptionExist($option);

        return $this->options[$option];
    }
}

<?php

declare(strict_types=1);

namespace BookShop\Adapters\Doctrine\DBAL\Types;

use BookShop\Domain\Common\Timestamp;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\DateTimeImmutableType;
use LogicException;

class TimestampType extends DateTimeImmutableType
{
    public function convertToDatabaseValue(mixed $value, AbstractPlatform $platform): mixed
    {
        if (! $value instanceof Timestamp) {
            throw new LogicException();
        }

        return parent::convertToDatabaseValue($value->toDateTimeImmutable(), $platform);
    }

    public function convertToPHPValue(mixed $value, AbstractPlatform $platform): Timestamp
    {
        $value = parent::convertToPHPValue($value, $platform);

        return new Timestamp($value);
    }
}
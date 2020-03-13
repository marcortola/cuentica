<?php

namespace MarcOrtola\Cuentica\Model;

class Assert
{
    /**
     * @param mixed $value
     * @param mixed[] $values
     */
    public static function oneOf($value, array $values): void
    {
        if (!\in_array($value, $values, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Expected one of: %s. Got: %s',
                    \implode(', ', \array_map('strval', $values)),
                    (string) $value
                )
            );
        }
    }

    public static function dateString(string $dateString): void
    {
        $date = \DateTime::createFromFormat('Y-m-d', $dateString);

        if (false === $date || $date->format('Y-m-d') !== $dateString) {
            throw new \InvalidArgumentException('Date format should be Y-m-d');
        }
    }

    public static function countryCode(string $countryCode): void
    {
        self::length($countryCode, 2);
    }

    public static function length(string $value, int $length): void
    {
        if ($length !== \strlen($value)) {
            throw new \InvalidArgumentException(
                sprintf('Expected a string to contain %s characters. Got: %s', $length, $value)
            );
        }
    }

    public static function stringNotEmpty(string $value): void
    {
        if ('' === trim($value)) {
            throw new \InvalidArgumentException('Expected a string not to be empty');
        }
    }

    /**
     * @param mixed $value
     */
    public static function positive($value): void
    {
        if (!\is_numeric($value) || 0 > (float) $value) {
            throw new \InvalidArgumentException(
                sprintf('Expected a positive number. Got: %s', (string) $value)
            );
        }
    }

    public static function region(string $countryCode, string $region): void
    {
        $countryCode = strtoupper($countryCode);

        if ('ES' !== $countryCode) {
            return;
        }

        $normalizedRegion = str_replace(
            ['á', 'à', 'é', 'è', 'í', 'ì', 'ó', 'ò', 'ú', 'ù'],
            ['a', 'a', 'e', 'e', 'i', 'i', 'o', 'o', 'u', 'u'],
            strtolower($region)
        );

        self::oneOf($normalizedRegion, [
            'alava',
            'albacete',
            'alicante',
            'almeria',
            'asturias',
            'avila',
            'badajoz',
            'barcelona',
            'burgos',
            'caceres',
            'cadiz',
            'cantabria',
            'castellon',
            'ceuta',
            'ciudad real',
            'cordoba',
            'cuenca',
            'gerona',
            'granada',
            'guadalajara',
            'guipuzcoa',
            'huelva',
            'huesca',
            'islas baleares',
            'jaen',
            'la coruna',
            'la rioja',
            'las palmas',
            'leon',
            'lerida',
            'lugo',
            'madrid',
            'malaga',
            'melilla',
            'murcia',
            'navarra',
            'orense',
            'palencia',
            'pontevedra',
            'salamanca',
            'segovia',
            'sevilla',
            'soria',
            'tarragona',
            'santa cruz de tenerife',
            'teruel',
            'toledo',
            'valencia',
            'valladolid',
            'vizcaya',
            'zamora',
            'zaragoza',
        ]);
    }
}

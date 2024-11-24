<?php
namespace App\Domain\Entities;

/**
 * Abstract base class for all types of accommodations
 * 
 * @package App\Domain\Entities
 */
abstract class Accommodation
{
    /**
     * @var int
     */
    protected int $id;

    /**
     * @var string
     */
    protected string $code;

    /**
     * @var string
     */
    protected string $name;

    /**
     * @var string
     */
    protected string $city;

    /**
     * @var string
     */
    protected string $province;

    /**
     * @var array
     */
    protected static array $translations;

    /**
     * @var string
     */
    protected static string $language = 'es';

    /**
     * @var array
     */
    protected static ?array $availableLanguages = null;

    /**
     * Constructor
     *
     * @param int $id Accommodation ID
     * @param string $code Unique code
     * @param string $name Name in specified language
     * @param string $city City name
     * @param string $province Province name
     */
    public function __construct(
        int $id,
        string $code,
        string $name,
        string $city,
        string $province
    ) {
        $this->id = $id;
        $this->code = $code;
        $this->name = $name;
        $this->city = $city;
        $this->province = $province;
        if (!isset(self::$translations)) {
            self::$translations = require __DIR__ . '../../../../config/translations.php';
            self::$availableLanguages = array_keys(self::$translations);
        }
    }

    /**
     * Get accommodation ID
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get accommodation code
     *
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * Get accommodation name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get city name
     *
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * Get province name
     *
     * @return string
     */
    public function getProvince(): string
    {
        return $this->province;
    }

    /**
     * Convert accommodation to string representation
     *
     * @return string
     */
    abstract public function toString(): string;

    public static function setLanguage(string $language): void
    {
        // Convertir a minúsculas para hacer la comparación insensible a mayúsculas
        $language = strtolower($language);
        
        // Validar si el lenguaje está disponible
        if (self::isValidLanguage($language)) {
            self::$language = $language;
        }
    }

    public static function isValidLanguage(string $language): bool
    {
        if (self::$availableLanguages === null) {
            self::$translations = require __DIR__ . '../../../../config/translations.php';
            self::$availableLanguages = array_keys(self::$translations);
        }
        return in_array($language, self::$availableLanguages);
    }

    public static function getAvailableLanguages(): array
    {
        return self::$availableLanguages;
    }

    public static function getCurrentLanguage(): string
    {
        return self::$language;
    }

    protected function getTranslation(string $key): string
    {
        // Intenta obtener la traducción en el idioma actual
        if (isset(self::$translations[self::$language][$key])) {
            return self::$translations[self::$language][$key];
        }

        if (isset(self::$translations['es'][$key])) {
            return self::$translations['es'][$key];
        }

        return "Translation missing for key: {$key}";
    }
}
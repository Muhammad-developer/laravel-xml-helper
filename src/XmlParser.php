<?php

namespace Larataj\XmlHelpers;

use SimpleXMLElement;

/**
 * XML Parser class
 *
 * Provides functionality to parse XML strings or files to arrays
 *
 * @package Larataj\XmlHelpers
 */
class XmlParser
{
    /**
     * The loaded XML element
     *
     * @var SimpleXMLElement|null
     */
    protected ?SimpleXMLElement $xml = null;

    /**
     * Constructor
     *
     * @param string|null $xmlData XML string or file path
     * @param bool $isFile Whether the data is a file path
     */
    public function __construct(?string $xmlData = null, bool $isFile = false)
    {
        if ($xmlData) {
            $this->load($xmlData, $isFile);
        }
    }

    /**
     * Load XML from string or file
     *
     * @param string $xmlData XML string or file path
     * @param bool $isFile Whether the data is a file path
     * @return $this
     */
    public function load(string $xmlData, bool $isFile = false): self
    {
        try {
            if ($isFile && file_exists($xmlData)) {
                $this->xml = simplexml_load_file($xmlData);
            } else {
                $this->xml = simplexml_load_string($xmlData);
            }

            if ($this->xml === false) {
                throw new \RuntimeException('Failed to parse XML');
            }
        } catch (\Exception $e) {
            throw new \RuntimeException('XML parsing error: ' . $e->getMessage());
        }

        return $this;
    }

    /**
     * Load XML from file
     *
     * @param string $filePath File path
     * @return $this
     */
    public function loadFile(string $filePath): self
    {
        return $this->load($filePath, true);
    }

    /**
     * Convert XML to array
     *
     * @return array
     */
    public function toArray(): array
    {
        if (!$this->xml) {
            return [];
        }

        return $this->xmlToArray($this->xml);
    }

    /**
     * Get element by path (XPath)
     *
     * @param string $path XPath expression
     * @return SimpleXMLElement[]
     */
    public function query(string $path): array
    {
        if (!$this->xml) {
            return [];
        }

        return $this->xml->xpath($path) ?: [];
    }

    /**
     * Get first element by path
     *
     * @param string $path XPath expression
     * @return SimpleXMLElement|null
     */
    public function queryOne(string $path): ?SimpleXMLElement
    {
        $results = $this->query($path);
        return $results[0] ?? null;
    }

    /**
     * Get child elements by name
     *
     * @param string $name Element name
     * @return SimpleXMLElement[]
     */
    public function getChildren(string $name = ''): array
    {
        if (!$this->xml) {
            return [];
        }

        if (empty($name)) {
            return iterator_to_array($this->xml->children());
        }

        return iterator_to_array($this->xml->$name);
    }

    /**
     * Check if element exists
     *
     * @param string $path Element path
     * @return bool
     */
    public function has(string $path): bool
    {
        return count($this->query($path)) > 0;
    }

    /**
     * Get root element name
     *
     * @return string
     */
    public function getRootName(): string
    {
        return $this->xml ? $this->xml->getName() : '';
    }

    /**
     * Get the XML object
     *
     * @return SimpleXMLElement|null
     */
    public function getXml(): ?SimpleXMLElement
    {
        return $this->xml;
    }

    /**
     * Convert SimpleXML object to array recursively
     *
     * @param SimpleXMLElement $element XML element
     * @return array
     */
    protected function xmlToArray(SimpleXMLElement $element): array
    {
        $result = [];

        // Add attributes
        $attributes = $element->attributes();
        if ($attributes) {
            $result['@attributes'] = [];
            foreach ($attributes as $key => $value) {
                $result['@attributes'][$key] = (string)$value;
            }
        }

        // Add child elements
        $children = $element->children();
        if ($children->count() > 0) {
            $childArray = [];
            foreach ($children as $child) {
                $childName = $child->getName();
                $childData = $this->xmlToArray($child);

                if (isset($childArray[$childName])) {
                    if (!is_array($childArray[$childName]) || !isset($childArray[$childName][0])) {
                        $childArray[$childName] = [$childArray[$childName]];
                    }
                    $childArray[$childName][] = $childData;
                } else {
                    $childArray[$childName] = $childData;
                }
            }
            $result = array_merge($result, $childArray);
        } else {
            // Leaf node
            $text = (string)$element;
            if (empty($text)) {
                return $result ?: null;
            }

            if (empty($result)) {
                return $text;
            }

            $result['@value'] = $text;
        }

        return $result;
    }

    /**
     * Validate XML against schema
     *
     * @param string $schemaPath Path to XSD schema file
     * @return bool
     */
    public function validate(string $schemaPath): bool
    {
        if (!$this->xml || !file_exists($schemaPath)) {
            return false;
        }

        $dom = new \DOMDocument();
        $dom->load($schemaPath);

        return $dom->validate();
    }

    /**
     * Pretty print XML
     *
     * @return string
     */
    public function prettyPrint(): string
    {
        if (!$this->xml) {
            return '';
        }

        $dom = new \DOMDocument('1.0', 'UTF-8');
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;
        $dom->loadXML($this->xml->asXML());

        return $dom->saveXML();
    }
}
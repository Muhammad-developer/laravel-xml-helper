<?php

namespace Larataj\XmlHelpers;

use SimpleXMLElement;

/**
 * Advanced XML Builder class
 *
 * Provides powerful and flexible XML building capabilities
 *
 * @package Larataj\XmlHelpers
 */
class XmlBuilder
{
    /**
     * The root XML element
     *
     * @var SimpleXMLElement
     */
    protected SimpleXMLElement $xml;

    /**
     * Configuration options
     *
     * @var array
     */
    protected array $options = [
        'version' => '1.0',
        'encoding' => 'UTF-8',
        'standalone' => true,
    ];

    /**
     * Constructor
     *
     * @param string $rootElement Root element name
     * @param array $attributes Root element attributes
     * @param array $options Configuration options
     */
    public function __construct(string $rootElement = 'root', array $attributes = [], array $options = [])
    {
        $this->options = array_merge($this->options, $options);

        $declaration = sprintf(
            '<?xml version="%s" encoding="%s"%s?>',
            $this->options['version'],
            $this->options['encoding'],
            $this->options['standalone'] ? ' standalone="yes"' : ''
        );

        $this->xml = new SimpleXMLElement($declaration . '<' . $rootElement . '/>');

        foreach ($attributes as $key => $value) {
            $this->xml->addAttribute($key, $value);
        }
    }

    /**
     * Add a child element
     *
     * @param string $name Element name
     * @param mixed $value Element value (can be scalar or array)
     * @param array $attributes Element attributes
     * @return $this
     */
    public function addChild(string $name, $value = '', array $attributes = []): self
    {
        if (is_array($value)) {
            $element = $this->xml->addChild($name);
            $this->addArrayToElement($element, $value);
        } else {
            $element = $this->xml->addChild($name, $this->escapeValue($value));
        }

        foreach ($attributes as $key => $attrValue) {
            $element->addAttribute($key, $attrValue);
        }

        return $this;
    }

    /**
     * Add multiple children at once
     *
     * @param array $data Array of children to add
     * @return $this
     */
    public function addChildren(array $data): self
    {
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $this->addChild($key, $value);
            } else {
                $this->addChild($key, $value);
            }
        }

        return $this;
    }

    /**
     * Add CDATA section
     *
     * @param string $name Element name
     * @param string $value CDATA content
     * @param array $attributes Element attributes
     * @return $this
     */
    public function addCData(string $name, string $value, array $attributes = []): self
    {
        $element = $this->xml->addChild($name);

        // Add CDATA using DOM
        $dom = dom_import_simplexml($element);
        $owner = $dom->ownerDocument;
        $cdata = $owner->createCDATASection($value);
        $dom->appendChild($cdata);

        foreach ($attributes as $key => $attrValue) {
            $element->addAttribute($key, $attrValue);
        }

        return $this;
    }

    /**
     * Add comment to XML
     *
     * @param string $comment Comment text
     * @return $this
     */
    public function addComment(string $comment): self
    {
        $dom = dom_import_simplexml($this->xml);
        $owner = $dom->ownerDocument;
        $commentNode = $owner->createComment($comment);
        $dom->appendChild($commentNode);

        return $this;
    }

    /**
     * Add attributes to root element
     *
     * @param array $attributes Attributes to add
     * @return $this
     */
    public function addAttributes(array $attributes): self
    {
        foreach ($attributes as $key => $value) {
            $this->xml->addAttribute($key, $value);
        }

        return $this;
    }

    /**
     * Convert to XML string
     *
     * @param bool $formatted Whether to format output
     * @return string
     */
    public function toString(bool $formatted = true): string
    {
        $xml = $this->xml->asXML();

        if ($formatted) {
            $xml = $this->formatXml($xml);
        }

        return $xml;
    }

    /**
     * Get the SimpleXMLElement
     *
     * @return SimpleXMLElement
     */
    public function getXml(): SimpleXMLElement
    {
        return $this->xml;
    }

    /**
     * Format XML with proper indentation
     *
     * @param string $xml XML string
     * @return string
     */
    protected function formatXml(string $xml): string
    {
        $dom = new \DOMDocument('1.0', 'UTF-8');
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;
        $dom->loadXML($xml);

        return $dom->saveXML();
    }

    /**
     * Add array data to element recursively
     *
     * @param SimpleXMLElement $element Parent element
     * @param array $data Data to add
     * @return void
     */
    protected function addArrayToElement(SimpleXMLElement $element, array $data): void
    {
        foreach ($data as $key => $value) {
            $key = is_numeric($key) ? 'item' : $key;

            if (is_array($value)) {
                $child = $element->addChild($key);
                $this->addArrayToElement($child, $value);
            } else {
                $element->addChild($key, $this->escapeValue($value));
            }
        }
    }

    /**
     * Escape XML value
     *
     * @param mixed $value Value to escape
     * @return string
     */
    protected function escapeValue($value): string
    {
        if (is_bool($value)) {
            return $value ? 'true' : 'false';
        }

        if (is_null($value)) {
            return '';
        }

        return htmlspecialchars((string)$value, ENT_XML1, 'UTF-8');
    }

    /**
     * Magic method to convert to string
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->toString();
    }
}
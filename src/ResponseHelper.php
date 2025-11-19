<?php

namespace Larataj\XmlHelpers;

use Illuminate\Http\Response;

/**
 * Response Helper class
 *
 * Provides convenient methods for XML and JSON responses
 *
 * @package Larataj\XmlHelpers
 */
class ResponseHelper
{
    /**
     * Convert array to XML string
     *
     * @param array $data Data to convert
     * @param string $rootElement Root element name
     * @param \SimpleXMLElement|null $xml Parent XML object (internal use)
     * @return string XML string
     */
    public static function arrayToXml(array $data, string $rootElement = 'response', \SimpleXMLElement $xml = null): string
    {
        if ($xml === null) {
            $builder = new XmlBuilder($rootElement);
            $builder->addChildren($data);
            return $builder->toString(false);
        }

        foreach ($data as $key => $value) {
            $key = is_numeric($key) ? 'item' : $key;

            if (is_array($value)) {
                $child = $xml->addChild($key);
                self::arrayToXml($value, $key, $child);
            } else {
                $xml->addChild($key, htmlspecialchars((string)$value, ENT_XML1, 'UTF-8'));
            }
        }

        return $xml->asXML();
    }

    /**
     * Return HTTP response in XML format
     *
     * @param array $data Data to convert
     * @param int $status HTTP status code
     * @param array $headers Custom headers
     * @param string $rootElement Root element name
     * @return Response
     */
    public static function xml(array $data, int $status = 200, array $headers = [], string $rootElement = 'response'): Response
    {
        $xmlContent = self::arrayToXml($data, $rootElement);

        $headers = array_merge($headers, [
            'Content-Type' => 'application/xml; charset=utf-8',
        ]);

        return response($xmlContent, $status, $headers);
    }

    /**
     * Create XML builder instance
     *
     * @param string $rootElement Root element name
     * @param array $attributes Root element attributes
     * @return XmlBuilder
     */
    public static function builder(string $rootElement = 'root', array $attributes = []): XmlBuilder
    {
        return new XmlBuilder($rootElement, $attributes);
    }

    /**
     * Parse XML string or file
     *
     * @param string $xmlData XML string or file path
     * @param bool $isFile Whether data is a file path
     * @return XmlParser
     */
    public static function parse(string $xmlData, bool $isFile = false): XmlParser
    {
        return new XmlParser($xmlData, $isFile);
    }

    /**
     * Parse XML file
     *
     * @param string $filePath File path
     * @return XmlParser
     */
    public static function parseFile(string $filePath): XmlParser
    {
        return new XmlParser($filePath, true);
    }
}

<?php

namespace Larataj\XmlHelpers;

use Illuminate\Http\Response;

class ResponseHelper
{
    /**
     * Преобразует массив в XML-формат.
     *
     * @param array $data Данные для преобразования.
     * @param string $rootElement Имя корневого элемента.
     * @param \SimpleXMLElement|null $xml Родительский XML-объект.
     * @return string XML-строка.
     */
    public static function arrayToXml(array $data, string $rootElement = '<response/>', \SimpleXMLElement $xml = null): string
    {
        if ($xml === null) {
            $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?>' . $rootElement);
        }

        foreach ($data as $key => $value) {
            $key = is_numeric($key) ? 'item' : $key;

            if (is_array($value)) {
                self::arrayToXml($value, $key, $xml->addChild($key));
            } else {
                $xml->addChild($key, htmlspecialchars($value));
            }
        }

        return $xml->asXML();
    }

    /**
     * Возвращает HTTP-ответ в формате XML.
     *
     * @param array $data Данные для преобразования.
     * @param int $status HTTP-статус.
     * @param array $headers Заголовки.
     * @param string $rootElement Имя корневого элемента.
     * @return Response
     */
    public static function xml(array $data, int $status = 200, array $headers = [], string $rootElement = '<response/>')
    {
        $xmlContent = self::arrayToXml($data, $rootElement);

        $headers = array_merge($headers, [
            'Content-Type' => 'application/xml; charset=utf-8',
        ]);

        return response($xmlContent, $status, $headers);
    }
}

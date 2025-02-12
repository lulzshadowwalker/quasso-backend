<?php

namespace App\Http\Response;

use App\Contracts\ResponseBuilder;
use Illuminate\Http\Response;

/**
 * For the lolz
 */
class XmlResponseBuilder implements ResponseBuilder
{
    protected $data = [];
    protected $errors = [];
    protected $statusCode = Response::HTTP_OK;

    public function __construct()
    {
        $this->data = [];
    }

    /**
     * Sets the response data.
     */
    public function data(array $data): self
    {
        $this->data['data'] = $data;
        return $this;
    }

    /**
     * Merges meta information into the response.
     */
    public function meta(array $meta): self
    {
        if (!isset($this->data['meta'])) {
            $this->data['meta'] = [];
        }
        $this->data['meta'] = array_merge($this->data['meta'], $meta);
        return $this;
    }

    /**
     * Sets a message into the meta portion of the response.
     */
    public function message(string $message): self
    {
        if (!isset($this->data['meta'])) {
            $this->data['meta'] = [];
        }
        $this->data['meta']['message'] = $message;
        return $this;
    }

    /**
     * Adds an error to the response.
     */
    public function error(
        string $title,
        string $detail,
        int $code = null,
        array $meta = [],
        string $pointer = null,
        string $indicator = null
    ): self {
        $error = [
            'status' => (string)$code,
            'code'   => isset(Response::$statusTexts[$code]) ? Response::$statusTexts[$code] : (string)$code,
            'title'  => $title,
            'detail' => $detail,
        ];

        if ($indicator) {
            $error['indicator'] = $indicator;
        }

        if (!empty($meta)) {
            $error['meta'] = $meta;
        }

        if ($pointer) {
            $error['source'] = ['pointer' => $pointer];
        }

        $this->errors = [$error];
        $this->statusCode = $code ?? $this->statusCode;
        return $this;
    }

    /**
     * Builds and returns an XML response.
     */
    public function build(int $code = Response::HTTP_OK): mixed
    {
        // Use the errors if set; otherwise, use the data.
        $responseData = $this->errors ? ['errors' => $this->errors] : $this->data;

        // Create the XML with a root element called <response>.
        $xml = new \SimpleXMLElement('<response/>');
        $this->arrayToXml($responseData, $xml);

        // Convert the XML object to a string.
        $content = $xml->asXML();

        // Return a Laravel response with the appropriate XML header.
        return response($content, $this->statusCode)
            ->header('Content-Type', 'application/xml');
    }

    /**
     * Recursively converts an array to XML.
     */
    protected function arrayToXml(array $data, \SimpleXMLElement $xml): void
    {
        foreach ($data as $key => $value) {
            // Ensure element names are valid. For numeric keys, we use a generic "item" element.
            if (is_numeric($key)) {
                $key = "item";
            }

            if (is_array($value)) {
                $subnode = $xml->addChild($key);
                $this->arrayToXml($value, $subnode);
            } else {
                $xml->addChild($key, htmlspecialchars((string)$value));
            }
        }
    }
}

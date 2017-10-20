<?php declare(strict_types=1);

namespace NoRouteDocumentation\Struct;

use JsonSerializable;

/**
 * Class RouteDetailStruct
 * @package NoRouteDocumentation\Struct
 */
class RouteDetailStruct implements JsonSerializable
{
    /**
     * @var null|string
     */
    private $controllerClassName;

    /**
     * @var null|string
     */
    private $controllerServiceId;

    /**
     * @var null|string
     */
    private $methodName;

    /**
     * @var null|string
     */
    private $path;

    /**
     * @var null|string
     */
    private $fullPath;

    /**
     * @var null|string
     */
    private $httpMethod;

    /**
     * @var null|bool
     */
    private $seo;

    /**
     * @return null|string
     */
    public function getControllerClassName()
    {
        return $this->controllerClassName;
    }

    /**
     * @param null|string $controllerClassName
     * @return RouteDetailStruct
     */
    public function setControllerClassName(?string $controllerClassName): RouteDetailStruct
    {
        $this->controllerClassName = $controllerClassName;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getControllerServiceId()
    {
        return $this->controllerServiceId;
    }

    /**
     * @param null|string $controllerServiceId
     * @return RouteDetailStruct
     */
    public function setControllerServiceId(?string $controllerServiceId): RouteDetailStruct
    {
        $this->controllerServiceId = $controllerServiceId;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getMethodName()
    {
        return $this->methodName;
    }

    /**
     * @param null|string $methodName
     * @return RouteDetailStruct
     */
    public function setMethodName(?string $methodName): RouteDetailStruct
    {
        $this->methodName = $methodName;
        return $this;
    }

    /**
     * @return ?string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param null|string $path
     * @return RouteDetailStruct
     */
    public function setPath(?string $path): RouteDetailStruct
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @return ?string
     */
    public function getFullPath()
    {
        return $this->fullPath;
    }

    /**
     * @param null|string $fullPath
     * @return RouteDetailStruct
     */
    public function setFullPath(?string $fullPath): RouteDetailStruct
    {
        $this->fullPath = $fullPath;
        return $this;
    }

    /**
     * @return ?string
     */
    public function getHttpMethod()
    {
        return $this->httpMethod;
    }

    /**
     * @param null|string $httpMethod
     * @return RouteDetailStruct
     */
    public function setHttpMethod(?string $httpMethod): RouteDetailStruct
    {
        $this->httpMethod = $httpMethod;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function isSeo(): ?bool
    {
        return $this->seo;
    }

    /**
     * @param bool|null $seo
     * @return RouteDetailStruct
     */
    public function setSeo(?bool $seo): RouteDetailStruct
    {
        $this->seo = $seo;
        return $this;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return [
            'controllerClassName' => $this->getControllerClassName(),
            'controllerServiceId' => $this->getControllerServiceId(),
            'methodName' => $this->getMethodName(),
            'path' => $this->getPath(),
            'fullPath' => $this->getFullPath(),
            'httpMethod' => $this->getHttpMethod(),
            'seo' => $this->isSeo(),
        ];
    }
}

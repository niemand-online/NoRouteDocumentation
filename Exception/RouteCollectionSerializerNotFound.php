<?php declare(strict_types=1);

namespace NoRouteDocumentation\Exception;

use Exception;
use Throwable;

/**
 * Class RouteCollectionSerializerNotFound
 * @package NoRouteDocumentation\Exception
 */
class RouteCollectionSerializerNotFound extends Exception
{
    /**
     * @var string
     */
    private $criteria;

    /**
     * RouteCollectionSerializerNotFound constructor.
     * @param string $criteria
     * @param Throwable|null $previous
     */
    public function __construct(string $criteria, Throwable $previous = null)
    {
        parent::__construct("RouteCollectionSerializer not found (searched for $criteria).", 0, $previous);
        $this->criteria = $criteria;
    }

    /**
     * @return string
     */
    public function getCriteria(): string
    {
        return $this->criteria;
    }
}

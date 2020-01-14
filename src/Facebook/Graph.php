<?php

namespace Quetface\Facebook;

use Quetface\Facebook\Graph\Edge;
use Quetface\Facebook\Graph\Node;

class Graph extends Base
{
    /**
     *
     * @var Quetface\Facebook\Graph\Node
     */
    protected $node;

    /**
     *
     * @var Quetface\Facebook\Graph\Edge
     */
    protected $edge;

    /**
     * Create node instance
     *
     * @param string $nodeName
     * @return Quetface\Facebook\Graph
     */
    public function node(string $nodeName)
    {
        $this->node = (new Node($this->endpointKey))->from($nodeName);
        return $this;
    }

    /**
     * Create edge instance
     *
     * @param string $nodeName
     * @return Quetface\Facebook\Graph
     */
    public function edge(string $edgeName)
    {
        $this->edge = (new Edge($this->endpointKey))->from($this->node, $edgeName);
        return $this;
    }

    /**
     * Get content from Graph Api
     *
     * @param array $fields
     * @return mixed
     */
    public function get(array $fields = [])
    {
        if (isset($this->edge)) {
            return $this->edge->get($fields);
        }

        return $this->node->get($fields);
    }
}

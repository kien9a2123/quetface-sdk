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
     * @param array $params http query
     * @return mixed
     */
    public function get(array $fields = [], array $params = [])
    {
        if (isset($this->edge)) {
            return $this->edge->get($fields, $params);
        }

        return $this->node->get($fields, $params);
    }

    /**
     * Clear old node or edge or all
     *
     * @param string $type
     * @return void
     */
    public function clear(string $type = '*')
    {
        if ($type === 'node' || $type === 'edge') {
            unset($this->$type);
        } elseif ($type === '*') {
            $this->clear('node');
            $this->clear('edge');
        }
    }
}

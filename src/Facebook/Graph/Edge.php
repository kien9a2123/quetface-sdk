<?php

namespace Quetface\Facebook\Graph;

use Quetface\Facebook\Base;
use Quetface\QuetfaceException;
use Quetface\Facebook\Graph\Node;

class Edge extends Base
{

    /**
     * Node name
     *
     * @var string
     */
    protected $node;

    /**
     * Edge name
     *
     * @var string
     */
    protected $edge;

    /**
     * Set node name and edge name for instance
     *
     * @param Node $node
     * @param string $edge
     * @throws Quetface\QuetfaceException
     * @return Quetface\Facebook\Graph\Edge
     */
    public function from(Node $node, string $edge)
    {
        if (! ($node instanceof Node)) {
            throw new QuetfaceException(sprintf('"%s" not a instance of Node', func_get_arg(0)));
        }

        if (! preg_match('/^[a-zA-Z0-9]+$/', $edge)) {
            throw new QuetfaceException("Edge name is invalid");
        }

        $this->node = (string) $node;
        $this->edge = $edge;

        return $this;
    }

    /**
     *  Get edge response from facebook graph API
     *
     * @param array $fields
     * @return mixed
     */
    public function get(array $fields = [])
    {
        $link   = $this->node . '/' . $this->edge;
        $fields = implode(',', $fields);
 
        return $this->request($link, ['fields' => $fields]);
    }

    /**
     * return edge name
     *
     * @return string
     */
    public function __toString()
    {
        return $this->edge;
    }
}

<?php

namespace Quetface\Facebook\Graph;

use Quetface\Facebook\Base;
use Quetface\QuetfaceException;

class Node extends Base
{
    /**
     * Node name
     *
     * @var string
     */
    public $node;

    /**
     * Set node name for instance
     *
     * @param string $node
     * @throws Quetface\QuetfaceException
     * @return Quetface\Facebook\Graph\Node
     */
    public function from(string $node)
    {
        if (! preg_match('/^[a-zA-Z0-9]+$/', $node)) {
            throw new QuetfaceException("Node name is invalid");
        }

        $this->node = $node;

        return $this;
    }

    /**
     * Get node response from facebook graph API
     *
     * @param array $fields
     * @return mixed
     */
    public function get(array $fields = [])
    {
        if (empty($this->node) && $this->node !== 0) {
            throw new QuetfaceException('Node name is empty');
        }

        $fields = implode(',', $fields);

        return $this->request($this->node, ['fields' => $fields]);
    }

    /**
     * return node name
     *
     * @return string
     */
    public function __toString()
    {
        return $this->node;
    }
}

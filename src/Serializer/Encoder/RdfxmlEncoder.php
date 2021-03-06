<?php

namespace LinkedSwissbibBundle\Serializer\Encoder;

use Symfony\Component\Serializer\Encoder\EncoderInterface;
use EasyRdf_Graph;

/**
 * RdfxmlEncoder
 *
 * @author   Melanie Stucki <melanie.stucki@students.fhnw.ch>, Markus Mächler <markus.maechler@students.fhnw.ch>
 * @license  http://opensource.org/licenses/gpl-2.0.php
 * @link     http://linked.swissbib.ch
 */
class RdfxmlEncoder implements EncoderInterface
{
    /**
     * Supported format
     */
    const FORMAT = 'rdf'; //TODO find out how to use rdfxml, because rdf is also mapped to application/rdf+xml

    /**
     * @var EasyRdf_Graph
     */
    protected $easyRdfGraph;

    /**
     * RdfxmlEncoder constructor.
     *
     * @param EasyRdf_Graph $easyRdfGraph
     */
    public function __construct(EasyRdf_Graph $easyRdfGraph)
    {
        $this->easyRdfGraph = $easyRdfGraph;
    }

    /**
     * {@inheritdoc}
     */
    public function encode($data, $format, array $context = array())
    {
        $this->easyRdfGraph->parse(json_encode($data), 'jsonld');

        return $this->easyRdfGraph->serialise('rdfxml');
    }

    /**
     * {@inheritdoc}
     */
    public function supportsEncoding($format)
    {
        return self::FORMAT === $format;
    }
}

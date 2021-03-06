<?php

namespace Jane\OpenApi2\Generator;

use InvalidArgumentException;
use Jane\JsonSchema\Generator\GeneratorInterface;
use Jane\OpenApi2\Generator\Parameter\BodyParameterGenerator;
use Jane\OpenApi2\Generator\Parameter\NonBodyParameterGenerator;
use Jane\OpenApiCommon\Generator\ExceptionGenerator;
use Jane\OpenApiCommon\Generator\OperationGenerator;
use Jane\OpenApiCommon\Naming\ChainOperationNaming;
use Jane\OpenApiCommon\Naming\OperationIdNaming;
use Jane\OpenApiCommon\Naming\OperationUrlNaming;
use PhpParser\ParserFactory;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class GeneratorFactory
{
    public static function build(DenormalizerInterface $serializer, string $endpointGeneratorClass): GeneratorInterface
    {
        $parserFactory = new ParserFactory();
        $parser = $parserFactory->create(ParserFactory::PREFER_PHP7);

        $bodyParameter = new BodyParameterGenerator($parser, $serializer);
        $nonBodyParameter = new NonBodyParameterGenerator($parser);
        $exceptionGenerator = new ExceptionGenerator();
        $operationNaming = new ChainOperationNaming([
            new OperationIdNaming(),
            new OperationUrlNaming(),
        ]);

        if (!class_exists($endpointGeneratorClass)) {
            throw new InvalidArgumentException(sprintf('Unknown generator class %s', $endpointGeneratorClass));
        }

        $endpointGenerator = new $endpointGeneratorClass($operationNaming, $bodyParameter, $nonBodyParameter, $serializer, $exceptionGenerator);
        $operationGenerator = new OperationGenerator($endpointGenerator);

        return new ClientGenerator($operationGenerator, $operationNaming);
    }
}

<?php

namespace Github\Normalizer;

use Jane\JsonSchemaRuntime\Reference;
use Jane\JsonSchemaRuntime\Normalizer\CheckArray;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
class GitCommitVerificationNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === 'Github\\Model\\GitCommitVerification';
    }
    public function supportsNormalization($data, $format = null)
    {
        return is_object($data) && get_class($data) === 'Github\\Model\\GitCommitVerification';
    }
    public function denormalize($data, $class, $format = null, array $context = array())
    {
        if (isset($data['$ref'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        $object = new \Github\Model\GitCommitVerification();
        if (\array_key_exists('verified', $data)) {
            $object->setVerified($data['verified']);
        }
        if (\array_key_exists('reason', $data)) {
            $object->setReason($data['reason']);
        }
        if (\array_key_exists('signature', $data) && $data['signature'] !== null) {
            $object->setSignature($data['signature']);
        }
        elseif (\array_key_exists('signature', $data) && $data['signature'] === null) {
            $object->setSignature(null);
        }
        if (\array_key_exists('payload', $data) && $data['payload'] !== null) {
            $object->setPayload($data['payload']);
        }
        elseif (\array_key_exists('payload', $data) && $data['payload'] === null) {
            $object->setPayload(null);
        }
        return $object;
    }
    public function normalize($object, $format = null, array $context = array())
    {
        $data = array();
        if (null !== $object->getVerified()) {
            $data['verified'] = $object->getVerified();
        }
        if (null !== $object->getReason()) {
            $data['reason'] = $object->getReason();
        }
        $data['signature'] = $object->getSignature();
        $data['payload'] = $object->getPayload();
        return $data;
    }
}
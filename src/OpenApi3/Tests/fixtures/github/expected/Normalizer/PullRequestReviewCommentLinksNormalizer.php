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
class PullRequestReviewCommentLinksNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === 'Github\\Model\\PullRequestReviewCommentLinks';
    }
    public function supportsNormalization($data, $format = null)
    {
        return is_object($data) && get_class($data) === 'Github\\Model\\PullRequestReviewCommentLinks';
    }
    public function denormalize($data, $class, $format = null, array $context = array())
    {
        if (isset($data['$ref'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        $object = new \Github\Model\PullRequestReviewCommentLinks();
        if (\array_key_exists('self', $data)) {
            $object->setSelf($this->denormalizer->denormalize($data['self'], 'Github\\Model\\PullRequestReviewCommentLinksSelf', 'json', $context));
        }
        if (\array_key_exists('html', $data)) {
            $object->setHtml($this->denormalizer->denormalize($data['html'], 'Github\\Model\\PullRequestReviewCommentLinksHtml', 'json', $context));
        }
        if (\array_key_exists('pull_request', $data)) {
            $object->setPullRequest($this->denormalizer->denormalize($data['pull_request'], 'Github\\Model\\PullRequestReviewCommentLinksPullRequest', 'json', $context));
        }
        return $object;
    }
    public function normalize($object, $format = null, array $context = array())
    {
        $data = array();
        if (null !== $object->getSelf()) {
            $data['self'] = $this->normalizer->normalize($object->getSelf(), 'json', $context);
        }
        if (null !== $object->getHtml()) {
            $data['html'] = $this->normalizer->normalize($object->getHtml(), 'json', $context);
        }
        if (null !== $object->getPullRequest()) {
            $data['pull_request'] = $this->normalizer->normalize($object->getPullRequest(), 'json', $context);
        }
        return $data;
    }
}
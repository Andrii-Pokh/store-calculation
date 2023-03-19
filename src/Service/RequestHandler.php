<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\HeaderBag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RequestHandler
{
    private ValidatorInterface $validator;

    private SerializerInterface $serializer;

    /**
     * RequestHandler constructor.
     */
    public function __construct(ValidatorInterface $validator, SerializerInterface $serializer)
    {
        $this->validator = $validator;
        $this->serializer = $serializer;
    }

    public function handle(Request $request, string $class)
    {
        $format = $this->getFormat($request->headers);
        $entity = $this->serializer->deserialize($request->getContent(), $class, $format);
        $errors = $this->validator->validate($entity);
        if ($errors->count() > 0) {
            throw new BadRequestHttpException('Validation failed!');
        }

        return $entity;
    }

    private function getFormat(HeaderBag $headers)
    {
        $type = $headers->get('content-type');
        switch ($type) {
            case 'application/json':
            default:
                return 'json';
        }
    }
}

<?php


namespace GeekBrains\LevelTwo\Blog\Container;

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use ReflectionClass;

class DIContainer implements ContainerInterface
{
    private array $resolvers = [];

    /**
     * @param string $type
     * @param $resolver
     */
    public function bind(string $type, $resolver): void
    {
        $this->resolvers[$type] = $resolver;
    }


    /**
     * @throws NotFoundExceptionInterface
     * @throws ContainerExceptionInterface
     * @throws NotFoundException
     */
    public function get($type): mixed
    {
        if (array_key_exists($type, $this->resolvers)) {
            $typeToCreate = $this->resolvers[$type];
            if (is_object($typeToCreate)) {
                return $typeToCreate;
            }
            return $this->get($typeToCreate);
        }
        if (!class_exists($type)) {
            throw new NotFoundException("Cannot resolve type: $type");
        }
        $reflectionClass = new ReflectionClass($type);
        $constructor = $reflectionClass->getConstructor();
        if (null === $constructor) {
            return new $type();
        }
        $parameters = [];
        foreach ($constructor->getParameters() as $parameter) {
            $parameterType = $parameter->getType()->getName();
            $parameters[] = $this->get($parameterType);
        }
        return new $type(...$parameters);
    }


    public function has($type)
    {
        try {
            $this->get($type);
        } catch (NotFoundException $e) {
            return false;
        }
        return true;

    }
}
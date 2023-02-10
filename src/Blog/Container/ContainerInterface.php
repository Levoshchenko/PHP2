<?php


namespace GeekBrains\LevelTwo\Blog\Container;


use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

interface ContainerInterface
{
    /**
     * Находит объект по его идентификатору и возвращает его.
     *
     * @param string $id Идентификатор искомого объекта.
     *
     * @return mixed Объект.
     * @throws ContainerExceptionInterface Ошибка получения объекта
     *
     * @throws NotFoundExceptionInterface Объект не найден.
     */
    public function get($type);

    /**
     * Возвращает true, если контейнер может вернуть объект
     * по этому идентификатору, false – в противном случае
     *
     * Если `has($id)` возвращает true, это не значит,
     * что `get($id)` не выбросит исключения.
     * Это значит, однако, что `get($id)`
     * не выбросит исключения `NotFoundExceptionInterface`.
     *
     * @param $type
     * @return bool
     */
    public function has($type);
}

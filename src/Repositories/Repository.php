<?php

namespace AlexLathwell\Jetpack\Repositories;


use AlexLathwell\Jetpack\Facades\Jetpack;
use \Request;
use Prettus\Repository\Contracts\CacheableInterface;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Traits\CacheableRepository;

class Repository extends BaseRepository implements CacheableInterface
{
    use CacheableRepository;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        $fullName = get_called_class();
        $className = class_basename($fullName);
        $class = str_replace('Repository', '', $className);
        $module = isset($this->module) ? $this->module : $class;
        $namespace = Jetpack::getModuleNamespace() . $module . '\\Api\\Models\\' . $class;

        return $namespace;
    }

    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function paginate($limit = null, $columns = ['*'], $method = "paginate")
    {
        $limit = $limit ? : Request::get('limit');

        return parent::paginate($limit, $columns, $method);
    }
}
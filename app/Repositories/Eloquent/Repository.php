<?php


namespace App\Repositories\Eloquent;


use App\Contracts\DTO\DTOContract;
use App\Contracts\Models\ModelContract;
use App\Contracts\Repositories\RepositoryContract;
use Exception;
use Illuminate\Container\Container as App;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Spatie\DataTransferObject\DataTransferObject;

abstract class Repository implements RepositoryContract
{
    /**
     * Query builder for repository's model
     */
    protected Builder $builder;

    /**
     * App Container
     */
    private App $app;

    /**
     * @param App $app
     *
     * @throws BindingResolutionException
     */
    public function __construct(App $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    /**
     * Instant eloquent model by class name
     *
     * @throws BindingResolutionException
     * @throws Exception
     */
    private function makeModel(): Builder
    {
        $model = $this->app->make($this->modelClass());

        if (!$model instanceof Model) {
            throw new Exception(
                "Class {$this->modelClass()} must be an instance of Illuminate\\Database\\Eloquent\\Model"
            );
        }

        if (!$model instanceof ModelContract) {
            throw new Exception("Class {$this->modelClass()} must implement " . ModelContract::class);
        }

        return $this->builder = $model->newQuery();
    }

    /**
     * Return class name for eloquent model
     *
     * @return string
     */
    abstract function modelClass(): string;

    /**
     * {@inheritDoc}
     *
     * @param string[] $columns
     *
     * @return Collection
     */
    public function all(array $columns = ['*']): Collection
    {
        return $this->builder->get($columns);
    }

    /**
     * {@inheritDoc}
     *
     * @param int            $perPage
     * @param array|string[] $columns
     *
     * @return LengthAwarePaginator
     */
    public function paginate(int $perPage = 15, array $columns = ['*']): LengthAwarePaginator
    {
        return $this->builder->paginate($perPage, $columns);
    }

    /**
     * {@inheritDoc}
     *
     * @param DTOContract $data
     *
     * @return ModelContract
     */
    public function create(DTOContract $data): ModelContract
    {
        /** @var Model|ModelContract $model */
        $model = $this->builder->create($data->all());
        return $model;
    }

    /**
     * {@inheritDoc}
     *
     * @param DTOContract  $data
     * @param int    $id
     * @param string $attribute
     *
     * @return int
     */
    public function update(DTOContract $data, int $id, $attribute = "id"): int
    {
        return $this->builder->where($attribute, '=', $id)->update($data->all());
    }

    /**
     * {@inheritDoc}
     *
     * @param int $id
     *
     * @return bool
     * @throws Exception
     */
    public function delete(int $id): bool
    {
        return $this->builder->findOrFail($id)->delete();
    }

    /**
     * {@inheritDoc}
     *
     * @param int      $id
     * @param string[] $columns
     *
     * @return ModelContract|null
     */
    public function find(int $id, array $columns = ['*']): ?ModelContract
    {
        /** @var Model|ModelContract $model */
        $model = $this->builder->find($id, $columns);
        return $model;
    }

    /**
     * @param array|string[] $columns
     *
     * @return Model|ModelContract|Builder|null
     */
    public function first(array $columns = ['*']): Model|ModelContract|Builder|null
    {
        return $this->builder->first($columns);
    }

    /**
     * {@inheritDoc}
     *
     * @param string   $filed
     * @param          $value
     * @param string[] $columns
     *
     * @return ModelContract|null
     */
    public function findBy(string $filed, $value, array $columns = ['*']): ?ModelContract
    {
        /** @var Model|ModelContract $model */
        $model = $this->builder->where($filed, '=', $value)->first($columns);
        return $model;
    }

    /**
     * {@inheritDoc}
     *
     * @return $this|RepositoryContract
     *
     * @throws BindingResolutionException
     */
    public function reset(): RepositoryContract
    {
        $this->makeModel();
        return $this;
    }
}

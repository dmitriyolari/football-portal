<?php


namespace App\Contracts\Repositories;


use App\Contracts\DTO\DTOContract;
use App\Contracts\Models\ModelContract;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Interface BaseRepository must be implemented by all repositories
 *
 * @package App\Contracts\Repositories
 */
interface RepositoryContract
{
    /**
     * Store new row to DB
     *
     * @param DTOContract $data
     *
     * @return ModelContract
     */
    public function create(DTOContract $data): ModelContract;

    /**
     * Retrieve all rows
     *
     * @param array $columns
     *
     * @return Collection
     */
    public function all(array $columns = ['*']): Collection;

    /**
     * Paginate rows
     *
     * @param int      $perPage
     * @param string[] $columns
     *
     * @return LengthAwarePaginator
     */
    public function paginate(int $perPage = 15, array $columns = ['*']): LengthAwarePaginator;

    /**
     * Update row by ID
     *
     * @param DTOContract  $data
     * @param int    $id
     *
     * @param string $attribute
     *
     * @return int Count of models was updated
     */
    public function update(DTOContract $data, int $id, $attribute = "id"): int;

    /**
     * Delete row in DB
     *
     * @param int $id
     *
     * @return bool
     */
    public function delete(int $id): bool;


    /**
     * Retrieve models by applied criteria
     *
     * @param int   $id
     * @param array $columns
     *
     * @return ModelContract|null
     */
    public function find(int $id, array $columns = ['*']): ?ModelContract;

    /**
     * Retrieve first models by applied criteria
     *
     * @param array $columns
     *
     * @return Model|ModelContract|Builder|null
     */
    public function first(array $columns = ['*']): Model|ModelContract|Builder|null;

    /**
     * Retrieve first model by field
     *
     * @param string $filed
     * @param        $value
     * @param array  $columns
     *
     * @return ModelContract|null
     */
    public function findBy(string $filed, $value, array $columns = ['*']): ?ModelContract;

    /**
     * Reset builder condition to default
     *
     * @return RepositoryContract
     */
    public function reset(): RepositoryContract;
}

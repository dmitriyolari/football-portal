<?php


namespace App\Repositories\Eloquent\Domain;


use App\Collections\User\UserCollection;
use App\Contracts\DTO\DTOContract;
use App\Contracts\Models\ModelContract;
use App\Contracts\Repositories\RepositoryContract;
use App\DTO\Domain\UserDTO;
use App\Models\User;
use App\Repositories\Eloquent\Repository;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class UserRepository extends Repository implements RepositoryContract
{
    /**
     * {@inheritDoc}
     *
     * @return string
     */
    function modelClass(): string
    {
        return User::class;
    }

    /**
     * {@inheritDoc}
     *
     * @param array|string[] $columns
     *
     * @return UserCollection|Collection
     */
    public function all(array $columns = ['*']): UserCollection
    {
        return parent::all($columns);
    }

    /**
     * {@inheritDoc}
     *
     * @param int            $id
     * @param array|string[] $columns
     *
     * @return User|null|ModelContract
     */
    public function find(int $id, array $columns = ['*']): ?User
    {
        return parent::find($id, $columns);
    }

    /**
     * {@inheritDoc}
     *
     * @param string         $filed
     * @param                $value
     * @param array|string[] $columns
     *
     * @return User|null|ModelContract
     */
    public function findBy(string $filed, $value, array $columns = ['*']): ?User
    {
        return parent::findBy($filed, $value, $columns);
    }

    /**
     * {@inheritDoc}
     *
     * @param UserDTO $data
     *
     * @return User
     */
    public function create(DTOContract $data): User
    {
        /** @var User $model */
        $model = $this->builder->newModelInstance();

        $data->password = bcrypt($data->password);

        $model->fill($data->all());
        $model->save();

        return $model->fresh();
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
        return parent::paginate($perPage, $columns);
    }

    /**
     * {@inheritDoc}
     *
     * @return UserRepository
     *
     * @throws BindingResolutionException
     */
    public function reset(): UserRepository
    {
        return parent::reset();
    }

    /**
     * @param $id
     * @return int
     */
    public function restore($id):int
    {
        User::withTrashed()->find($id)->restore();

        return true;
    }

    /**
     * @param $id
     * @return bool
     */
    public function makeAdmin($id): bool
    {
        $user = User::find($id);
        $user->is_admin = 1;
        $user->save();

        return true;
    }

    /**
     * @return bool
     */
    public function returnSubscription(): bool
    {
        $user = Auth::user();
        $user->is_subscribed = 1;
        $user->save();

        return true;
    }

    /**
     * @return bool
     */
    public function cancelSubscription(): bool
    {
        $user = Auth::user();
        $user->is_subscribed = 0;
        $user->save();

        return true;
    }
}

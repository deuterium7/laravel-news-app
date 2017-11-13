<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\UserSocialAccountRepository;
use App\Entities\UserSocialAccount;
use App\Validators\UserSocialAccountValidator;

/**
 * Class UserSocialAccountRepositoryEloquent
 * @package namespace App\Repositories;
 */
class UserSocialAccountRepositoryEloquent extends BaseRepository implements UserSocialAccountRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return UserSocialAccount::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}

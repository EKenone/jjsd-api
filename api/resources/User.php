<?php


namespace api\resources;


use api\modules\admin\models\Admin;
use Lcobucci\JWT\Token;
use yii\web\IdentityInterface;
use yii\web\UnauthorizedHttpException;

class User extends Admin implements IdentityInterface
{
    /**
     * @param int|string $id
     * @return User|IdentityInterface|null
     */
    public static function findIdentity($id)
    {
        // TODO: Implement findIdentity() method.

        return static::findOne($id);
    }

    /**
     * @param Token $token
     * @param null $type
     * @return IdentityInterface|null
     * @throws UnauthorizedHttpException
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO: Implement findIdentityByAccessToken() method.

        $id = $token->getClaim('uid');

        $user = static::findIdentity($id);
        if ($user->is_del) {
            throw new UnauthorizedHttpException('账号已失效');
        }

        if ($user->status == self::STATUS_FREEZE ) {
            throw new UnauthorizedHttpException('账号已冻结');
        }

        return $user;
    }

    /**
     * @return int|string
     */
    public function getId()
    {
        // TODO: Implement getId() method.

        return $this->id;
    }

    public function getAuthKey()
    {
        // TODO: Implement getAuthKey() method.
    }

    public function validateAuthKey($authKey)
    {
        // TODO: Implement validateAuthKey() method.
    }
}
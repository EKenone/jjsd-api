<?php


namespace api\modules\admin\logic;


use api\modules\admin\forms\AdminForm;
use api\logic\LogicAbstract;
use api\modules\admin\resources\AdminResource;
use Lcobucci\JWT\Token;
use Yii;
use yii\base\UserException;
use yii\helpers\ArrayHelper;

class AdminLoginLogic extends LogicAbstract
{
    /**
     * @var AdminForm;
     */
    public $form;

    /**
     * @var AdminResource
     */
    protected $user;

    /**
     * @return $this|mixed
     */
    public function exec()
    {
        try {
            $this->checkUsername();
            $this->result = ['user' => $this->user, 'token' => 'Bearer ' . (string)$this->getToken(), 'expires_day' => 30];
        } catch (\Exception $e) {
            $this->err($e->getMessage());
        }

        return $this;
    }

    /**
     * 验证用户
     * @throws UserException
     */
    private function checkUsername()
    {
        $user = AdminResource::find()->notDelete()->andWhere(['username' => $this->form->username])->one();

        if (!$user) {
            throw new UserException('账号不存在');
        }

        if ($user->password != $this->form->password) {
            throw new UserException('密码错误');
        }

        if ($user->status == AdminResource::STATUS_FREEZE) {
            throw new UserException('账号被冻结');
        }

        $this->user = $user->setFieldType(AdminResource::FIELD_SHOW);
    }

    /**
     * 获取jwt token
     * @return Token
     * @throws \Exception
     */
    private function getToken()
    {
        $jwt = Yii::$app->jwt;
        $signer = $jwt->getSigner('HS256');
        $key = $jwt->getKey();
        $time = time();
        $expires = $time + 86400 * 30;

        return $jwt->getBuilder()
            ->issuedBy(ArrayHelper::getValue(Yii::$app->params, 'api_jwt_config.iss'))// Configures the issuer (iss claim)
            ->permittedFor(ArrayHelper::getValue(Yii::$app->params, 'api_jwt_config.aud'))// Configures the audience (aud claim)
            ->identifiedBy(ArrayHelper::getValue(Yii::$app->params, 'api_jwt_config.jit'), true)// Configures the id (jti claim), replicating as a header item
            ->issuedAt($time)// Configures the time that the token was issue (iat claim)
            ->expiresAt($expires)// Configures the expiration time of the token (exp claim)
            ->withClaim('uid', $this->user->id)// Configures a new claim, called "uid"
            ->getToken($signer, $key); // Retrieves the generated token
    }

}
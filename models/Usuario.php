<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuario".
 *
 * @property int $idUsuario
 * @property string $nombre
 * @property string $clave
 * @property string $telegram
 * @property int $idRol
 *
 * @property Tiempo[] $tiempos
 * @property Rol $idRol0
 * @property UsuarioEvento[] $usuarioEventos
 */
class Usuario extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    private $username;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuario';
    }

    public function getUsername(){
        return $this->nombre;
    }




    public static function findByUsername($username) {
        return self::findOne(['nombre' => $username]);
    }

    public function validatePassword($password) {
        return $this->clave=== $password;
    }

    public static function findIdentity($id) {
        return static::findOne($id);
    }

    /**
     * Finds an identity by the given token.
     *
     * @param string $token the token to be looked for
     * @return IdentityInterface|null the identity object that matches the given token.
     */
    public static function findIdentityByAccessToken($token, $type = null) {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * @return int|string current user ID
     */
    public function getId() {
        return $this->idUsuario;
    }

    /**
     * @return string current user auth key
     */
    public function getAuthKey() {
        return $this->idUsuario;
    }

    /**
     * @param string $authKey
     * @return bool if auth key is valid for current user
     */
    public function validateAuthKey($authKey) {
        return $this->getAuthKey() === $authKey;
    }




    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'clave', 'telegram', 'idRol'], 'required'],
            [['idRol'], 'integer'],
            [['nombre', 'clave', 'telegram'], 'string', 'max' => 100],
            [['idRol'], 'exist', 'skipOnError' => true, 'targetClass' => Rol::className(), 'targetAttribute' => ['idRol' => 'idRol']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idUsuario' => 'Id Usuario',
            'nombre' => 'Nombre',
            'clave' => 'Clave',
            'telegram' => 'Telegram',
            'idRol' => 'Id Rol',
        ];
    }

    /**
     * Gets query for [[Tiempos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTiempos()
    {
        return $this->hasMany(Tiempo::className(), ['idUsuario' => 'idUsuario']);
    }

    /**
     * Gets query for [[IdRol0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdRol0()
    {
        return $this->hasOne(Rol::className(), ['idRol' => 'idRol']);
    }

    /**
     * Gets query for [[UsuarioEventos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioEventos()
    {
        return $this->hasMany(UsuarioEvento::className(), ['idUsuario' => 'idUsuario']);
    }
}

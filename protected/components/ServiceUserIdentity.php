<?php
class ServiceUserIdentity extends UserIdentity {
    const ERROR_NOT_AUTHENTICATED = 3;

    /**
     * @var EAuthServiceBase the authorization service instance.
     */
    protected $service;

    /**
     * Constructor.
     * @param EAuthServiceBase $service the authorization service instance.
     */
    public function __construct($service) {
        $this->service = $service;
    }

    /**
     * Authenticates a user based on {@link username}.
     * This method is required by {@link IUserIdentity}.
     * @return boolean whether authentication succeeds.
     */
    public function authenticate() {
        if ($this->service->isAuthenticated) {

            $userService = new UserService();
            $criteria =new CDbCriteria();
            $criteria->compare("authService",$this->service->serviceName);
            $criteria->compare("authId",$this->service->id);
            if(($user = $userService->getByAuth($this->service->serviceName,$this->service->id))==null)
            {

                $user =new User();
                $gender =  $this->service->getAttribute('gender');
                if($gender)$user->sex = $gender==="F" ? 1  : 0;
                if(!$userService->
                    create($user,$this->service->serviceName,$this->service->id,$this->service->getAttribute('name'),$gender)
                )return false;
            }
            $this->username = $user->name;
            $this->setState('id', $user->id);
            $this->setState('name', $user->name);
            $this->errorCode = self::ERROR_NONE;
        }
        else {
            $this->errorCode = self::ERROR_NOT_AUTHENTICATED;
        }
        return !$this->errorCode;
    }

}

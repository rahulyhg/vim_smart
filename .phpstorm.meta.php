<?php
	namespace PHPSTORM_META {
	/** @noinspection PhpUnusedLocalVariableInspection */
	/** @noinspection PhpIllegalArrayKeyTypeInspection */
	$STATIC_METHOD_TYPES = [

		\D('') => [
			'Mongo' instanceof Think\Model\MongoModel,
			'Role' instanceof Admin\Model\RoleModel,
			'Express' instanceof Common\Model\ExpressModel,
			'Base' instanceof Home\Model\BaseModel,
			'Payrecord' instanceof Home\Model\PayrecordModel,
			'YuekaBill' instanceof Common\Model\YuekaBillModel,
			'Relation' instanceof Think\Model\RelationModel,
			'ParkBill' instanceof Common\Model\ParkBillModel,
			'User' instanceof Home\Model\UserModel,
			'Admin' instanceof Admin\Model\AdminModel,
			'Acttype' instanceof Admin\Model\ActtypeModel,
			'Car' instanceof Home\Model\CarModel,
			'View' instanceof Think\Model\ViewModel,
			'Config' instanceof Admin\Model\ConfigModel,
			'Coupon' instanceof Home\Model\CouponModel,
			'Servicerecord' instanceof Home\Model\ServicerecordModel,
			'Duty' instanceof Admin\Model\DutyModel,
			'BillMode' instanceof Common\Model\BillModel.cla,
			'Activity' instanceof Admin\Model\ActivityModel,
			'Adv' instanceof Think\Model\AdvModel,
			'Auth' instanceof Admin\Model\AuthModel,
			'Check' instanceof Admin\Model\CheckModel,
			'Garage' instanceof Admin\Model\GarageModel,
			'Zone' instanceof Admin\Model\ZoneModel,
			'Bill' instanceof Common\Model\BillModel,
			'Wxcallback' instanceof Wxorg\Model\WxcallbackModel,
			'Merge' instanceof Think\Model\MergeModel,
			'Wechat' instanceof Common\Model\WechatModel,
		],
		\DL('') => [
			'RbacLogic' instanceof Admin\Logic\RbacLogic,
			'UserLogic' instanceof Home\Logic\UserLogic,
			'IndexLogic' instanceof Admin\Logic\IndexLogic,
		],
	];
}
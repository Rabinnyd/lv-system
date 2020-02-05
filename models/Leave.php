<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lv_leave".
 *
 * @property int $lv_leave_id
 * @property int $leave_user_id
 * @property string $leave_subject
 * @property string $lv_date_raised
 * @property string $lv_start_date
 * @property string $lv_end_date
 * @property int $lv_status
 *
 * @property LvApproval[] $lvApprovals
 * @property LvUsers $leaveUser
 */
class Leave extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lv_leave';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['leave_user_id', 'leave_subject', 'lv_status'], 'required'],
            [['leave_user_id', 'lv_status'], 'integer'],
            [['leave_subject'], 'string'],
            [['lv_date_raised', 'lv_start_date', 'lv_end_date'], 'safe'],
            [['leave_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['leave_user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'lv_leave_id' => 'Lv Leave ID',
            'leave_user_id' => 'Leave User ID',
            'leave_subject' => 'Leave Subject',
            'lv_date_raised' => 'Lv Date Raised',
            'lv_start_date' => 'Lv Start Date',
            'lv_end_date' => 'Lv End Date',
            'lv_status' => 'Lv Status',
        ];
    }

    /**
     * Gets query for [[LvApprovals]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLvApprovals()
    {
        return $this->hasMany(LvApproval::className(), ['approval_leave_id' => 'lv_leave_id']);
    }

    /**
     * Gets query for [[LeaveUser]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLeaveUser()
    {
        return $this->hasOne(LvUsers::className(), ['id' => 'leave_user_id']);
    }
}

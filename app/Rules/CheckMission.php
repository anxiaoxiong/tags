<?php

namespace App\Rules;

use App\Models\Mission;
use Illuminate\Contracts\Validation\Rule;

class CheckMission implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public $p_id;
    public $uid;
    public function __construct($p_id,$uid)
    {
        $this->p_id = $p_id;
        $this->uid = $uid;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $where = [];
        $where[] = ['project_id',$this->p_id];
        $where[] = ['manager',$this->uid];
        $where[] = ['status',2];
        $ids = explode(',',$value);
        $pm = Mission::where($where)->whereIn('id',$ids)->get()->toArray();
        if($pm){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '任务IDS错误';
    }
}

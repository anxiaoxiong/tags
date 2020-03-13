<?php

namespace App\Rules;

use App\Models\Staff;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class CheckAuditor implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public $p_id;
    public $uid;
    public function __construct()
    {
    
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
        $uid = Auth::id();
        $did = Staff::where('uid',$uid)->pluck('department_id')->toArray();
        if(!$value){
            return false;
        }
        $ids = explode(',',$value);
        $uids = Staff::where('department_id',$did)->whereIn('uid',$ids)->pluck('department_id')->toArray();
    
        if(array_diff($did,$uids) || array_diff($uids,$did) ){
            return false;
        }else{
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '审核人出错';
    }
}

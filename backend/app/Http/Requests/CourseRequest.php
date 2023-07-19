<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class CourseRequest extends BaseRequest
{
    /**
     * Define rules for store function
     *
     * @return array
     */
    public function rulesPost()
    {
        return [

        ];
    }

    /**
     * Define rules for update function
     *
     * @return array
     */
    public function rulesPut()
    {
        return [

        ];
    }

    // /**
    //  * Bind attributes into message
    //  *
    //  * @return array
    //  */
    // public function attributes()
    // {
    //     return [
    //         'name' => __('field.account.name'),
    //         'email' => __('field.account.email'),
    //         'status' => __('field.account.status'),
    //     ];
    // }
}

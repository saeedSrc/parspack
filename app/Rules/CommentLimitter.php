<?php

namespace App\Rules;

use App\Models\Comment;
use App\Models\Product;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class CommentLimitter implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value) : bool
    {
        $product = Product::where('name', '=', $value)->first();
        if ($product == null) {
            return true;
        }
        $pID = $product->id;
        $comments = Comment::where(['product_id' => $pID, 'user_id' => Auth::id()])->get();
        (count($comments) > config('custom.comment_limit_count')) ? $result = false : $result = true;
        return $result;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'you can not register more than 2 comments';
    }
}
